<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [ 
        'id',
        'price', 
        'discount', 
        'available_pieces',
        'weight', 
        'color', 
        'col_1', 
        'sold', 
        'description',   
        'col_2', 
        'col_3', 
        'col_4', 
        'about', 
        'name', 
        'brand', 
        'store_id', 
        'category_id',  
        'deleted_by',
        'added_by',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

   public function store()
    {
     return $this->belongsTo(Store::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function offers() : BelongsToMany
    {
        return $this->belongsToMany(Offer::class, 'offer_product');
    }

    public function category()
    {
     return $this->belongsTo(Category::class);
    }

    public function orders() 
    {
        return $this->hasMany(Order::class);
    }

    public function carts() : BelongsToMany
    {
        return $this->belongsToMany(Cart::class,'cart_product');
    }



    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    

    // .. Soft Deletes Part ..
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->deleted_by = auth()->user()->id; 
            $product->save();
        });

    }


}
