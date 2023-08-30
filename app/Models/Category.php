<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes; 
    use HasFactory;
    protected $dates = ['deleted_at']; 
    protected $fillable = [  
        'name',
        'id', 
     //   'image',
        'parent_id', 
        'deleted_by',
    ];
    // again fjahlfalhdajkl
    // look if it was changed
     // try again 
    //here the second change test

    

    


public function Products()
{
    return $this->hasMany(Product::class);
}

public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }




protected static function boot()
{
    parent::boot();

    static::deleting(function ($category) {
        $category->deleted_by = auth()->user()->id; 
        $category->save();
    });
}




}
