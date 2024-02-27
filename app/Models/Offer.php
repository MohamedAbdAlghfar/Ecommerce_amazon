<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 



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
        'custom', // this to know if offer for public = 0 or for customers = 1
        'no_pieces',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function products() : BelongsToMany 
    {
        return $this->belongsToMany(Product::class, 'offer_product');
    }

    public function orders() 
    {
        return $this->hasMany(Order::class); 
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'offer_user');
    }
}
