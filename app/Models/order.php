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
        'discount', 
        'user_id',
        'shipping_company_id',
        'product_id', 


    ];


    
    // order comment on new 
    public function User()
    {
     return $this->belongsTo(User::class);
    }
    
   
   
    public function Product()
    {
     return $this->belongsTo(Product::class);
    }
    
    
    
    public function ShippingCompany()
    {
     return $this->belongsTo(ShippingCompany::class);
    }

}
