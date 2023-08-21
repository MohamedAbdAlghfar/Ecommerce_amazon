<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
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





protected static function boot()
{
    parent::boot();

    static::deleting(function ($product) {
        $product->deleted_by = auth()->user()->id; 
        $product->save();
    });

}



    public function orders() 
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

}
