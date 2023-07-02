<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [        
        'Order_Date',        
        'id',
        'Location',
        'Trans_Date',    
        'Price',
        'Discount',

    ];


    
    // order comment on new 
    public function User()
    {
     return $this->belongsTo('App\Models\User');
    }
    
   
   
    public function Category()
    {
     return $this->belongsTo('App\Models\Category');
    }
    
    
    
    public function ShippingCompany()
    {
     return $this->belongsTo('App\Models\ShippingCompany');
    }

}
