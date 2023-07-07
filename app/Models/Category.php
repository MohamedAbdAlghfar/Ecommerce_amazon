<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'Name',
        'Col_1',
        'Col_2',  
        'Col_3',
        'Col_4',
        'Description',
        'id',
        'About',
        'Color',
        'Buy',
     //   'Ordering',
        'Brand',
        'Parent_id',
        'Price',
        'Available_Bices',
        'Discount',
        'Weight',
    ];
    // again fjahlfalhdajkl
    // look if it was changed
     // try again 
    //here the second change test
    public function Orders()
{
    return $this->hasMany('App\Models\Order');
}
    
public function Stores() {
    return $this->belongsToMany('App\Models\Store');
}
    
public function Photos()
{
    return $this->morphMany('App\Models\Photo', 'photoable');
}   

public function Comments()
{
    return $this->hasMany('App\Models\Comments');
}

public function Users() {
    return $this->belongsToMany('App\Models\User');
}

public function Carts() {
    return $this->belongsToMany('App\Models\Cart');
}


}
