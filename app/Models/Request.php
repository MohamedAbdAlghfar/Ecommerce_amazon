<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory; 

    protected $fillable = [ 
        'store_id',
        'user_id',
        'store_name',
        'message',
        'response',
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function stores()
    {
        return $this->belongsTo(Store::class);
    }
}
