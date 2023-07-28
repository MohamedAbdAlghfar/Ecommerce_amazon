<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',  
        'email',
        'id',
        'location',
        'services', 
        'phone',
        'link_website',  
        'about_store',
        'store_cover',
        'store_image',
        'user_id'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }


    

    public function Products() {
        return $this->hasMany(Product::class);
    }


}
