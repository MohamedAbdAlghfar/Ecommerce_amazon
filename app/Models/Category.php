<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [  
        'name',
        'id', 
        'image',
        'parent_id', 
    ];
    // again fjahlfalhdajkl
    // look if it was changed
     // try again 
    //here the second change test

    

    


public function Products()
{
    return $this->hasMany(Product::class);
}




}
