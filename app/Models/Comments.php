<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'body', 
        'parent_id', 
        'type',
        'rate',
        'product_id',
        'user_id',        
        'id',
        
    ];

    public function User() 
    {
     return $this->belongsTo(User::class); 
    }

    public function Product() 
    {
     return $this->belongsTo(Product::class);
    }

}
