<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    use HasFactory;

    protected $table = 'cart_product';

    protected $fillable = [
        'product_id',
        'cart_id',
    ];
}
