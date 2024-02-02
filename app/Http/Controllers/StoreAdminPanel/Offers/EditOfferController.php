<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Offer, Photo , OfferProduct};
use App\Http\Middleware\Is_Store_Admin;

class EditOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function editOffer(Request $request, $offerId)
    {
        $user = auth()->user();
        $userId = $user->id;
        $storeId = $user->store->id;

        $validatedData = $request->validate([
            'price' => 'required|integer',
            'product_id' => 'integer|required_without:no_pices',
            'custom' => 'required|integer|in:0,1',
            'name' => 'required|string',
            'about' => 'required|string',
            'offer_image' => 'nullable|image|size:300|mimes:jpg,bmp,png',
            'no_pices' => 'integer|required_without:product_id',
            'del_product_id' => 'nullable|integer|exists:products,id'
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        // Begin a transaction
        DB::beginTransaction();

        try {
            $offer = Offer::find($offerId);

            if (!$offer) {
                throw new \Exception('Offer Not Found.');
            }

            $offer->update([
                'price' => $request->price,
                'name' => $request->name,
                'about' => $request->about,
                'custom' => $request->custom,
            ]);

            if ($request->no_pices) // .. that means that offer have a number of one product ..
            {
                $offer->update(['no_pices', $request->no_pices]);
            }

            if ($request->product_id)
            {
                OfferProduct::create([
                    'offer_id '  => $offer->id ,
                    'product_id' => $request->product_id ,
                    'store_id '  => $storeId ,
                ]);
            }
             
            if ($request->del_product_id) // .. that if admin want to delete an products from offer ..
            {
                $delProduct = $request->del_product_id;

                foreach ($delProduct as $deletedProduct) {
                    $deleted = OfferProduct::where('product_id', $deletedProduct)
                    ->where('offer_id', $offer->id)
                    ->where('store_id', $storeId)
                    ->delete();

                    if (!$deleted) {
                        // If offer pivot creation fails, throw an exception
                        throw new \Exception('Offer pivot creation failed.');
                    }
                }
            }

            if ($request->hasFile('offer_image')) // if admin update the offer image
            {
                $image = $request->file('offer_image');
                $imageName = uniqid() . '.' . $image->extension();
                $image->move(storage_path('images/'), $imageName);

                $oldOfferImage = $Offer->photo()->first([
                    'photoable_id' => $offer->id,
                    'photoable_type' => Offer::class,
                ]);
    
                if (!$image->isValid()) { // this isValid() ensures that file uploaded successfully , it Provided by Laravel
                    throw new \Exception('Invalid image provided.');
                }

                // Delete the old store cover file from the storage folder, if it exists
                if ($oldOfferImage->exists) {
                    Storage::delete('images/' . $oldOfferImage->filename);
                }

                $oldOfferImage->fill([
                    'filename' => $imageName,
                ])->save();
            }

            // If everything is successful, commit the transaction
            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Offer updated successfully.',
            ]);

        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
