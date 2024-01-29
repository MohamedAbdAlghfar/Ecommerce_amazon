<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

public function Stores()
{
    return $this->belongsToMany(Store::class);
}


public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }



}
