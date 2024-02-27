<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShippingCompany extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'name', 
        'email',
        'id',
        'location', 
        'phone',
        'website',
        'address',
      //  'cover_image',
    ];

    public function Orders() 
    {
        return $this->hasMany(order::class);
    }

    public function Stores() : BelongsToMany
    {
        return $this->belongsToMany(Store::class , 'shipping_company_store');
    }


    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

}
