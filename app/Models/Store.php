<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
        'user_id',
        'deleted_by',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }


    

    public function Products() {
        return $this->hasMany(Product::class);
    }



    protected static function boot()
    {
        parent::boot();
    
        static::deleting(function ($store) {
            $store->deleted_by = auth()->user()->id; 
            $store->save();
        });
    }

}
