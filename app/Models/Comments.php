<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

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
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }

    public function User() 
    {
     return $this->belongsTo(User::class); 
    }

    public function Product() 
    {
     return $this->belongsTo(Product::class);
    }

}
