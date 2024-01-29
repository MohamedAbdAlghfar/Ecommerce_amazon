<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [               
        'id',   
        'price',
        'store_id',
        'name',
        'about',
        'no_pices',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }

    public function product() {
        return $this->hasMany(Product::class);
    }

    public function orders() 
    {
        return $this->hasMany(Order::class);
    }
}
