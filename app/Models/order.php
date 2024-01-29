<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [               
        'id',
        'location', 
        'trans_date',     
        'Cancellation_date',     
        'price',
        'user_id',
        'store_id',
        'shipping_company_id',
        'product_id', 
        'offer_id', 
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }

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
    
    public function offer() 
    {
        return $this->belongsTo(Offer::class);
    }
    
    public function shippingCompany()
    {
     return $this->belongsTo(ShippingCompany::class);
    }

}
