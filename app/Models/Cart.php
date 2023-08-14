<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [  
        'user_id',  
        'id',
    ];


    public function Products() {
        return $this->hasMany(Product::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }


}
