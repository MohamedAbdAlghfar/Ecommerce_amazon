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
        'parent_id', 
        'deleted_by',
    ];

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
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
