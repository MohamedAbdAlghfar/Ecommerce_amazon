<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
    	'price', 
    	'discount', 
        'available_pieces',
        'weight', 
        'color', 
        'col_1', 
        'buy', 
        'description',   
        'col_2', 
        'col_3', 
        'col_4', 
        'about', 
        'name', 
        'brand', 
        'store_id', 
        'category_id',  
    ];
    public function Comments() 
{
    return $this->hasMany(Comments::class);
}

   public function Store()
    {
     return $this->belongsTo(Store::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function Category()
    {
     return $this->belongsTo(Category::class);
    }

    public function Orders() 
{
    return $this->hasMany(order::class);
}

public function Carts()
{
    return $this->belongsToMany(Cart::class);
}




}
