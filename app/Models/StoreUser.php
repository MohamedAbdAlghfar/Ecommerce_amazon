<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreUser extends Pivot
{
    use HasFactory;

    protected $table = 'store_user';
    
    protected $fillable = [
        'user_id',
        'store_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
