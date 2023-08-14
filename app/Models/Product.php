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
    ];
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

    public function category()
    {
     return $this->belongsTo(Category::class);
    }

    public function orders() 
    {
        return $this->belongsToMany(Order::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

}
