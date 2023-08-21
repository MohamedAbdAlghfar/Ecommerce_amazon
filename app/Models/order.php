<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [               
        'id',
        'location', 
        'trans_date',     
        'price',
        'user_id',
        'store_id',
        'shipping_company_id',
        'product_id', 
        'status',
    ];


    
    // order comment on new 
    public function User()
    {
     return $this->belongsTo(User::class);
    }

    public function store()
    {
     return $this->belongsTo(Store::class);
    }
    
    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
    
    public function ShippingCompany()
    {
     return $this->belongsTo(ShippingCompany::class);
    }

}
