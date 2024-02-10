<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'f_name',
        'email',         
        'id',
        'gender',
        'age',
        'address',  
        'role',
        'phone',
        'l_name',
        'password', 
    ];

    protected $hidden = [
        'Password',
        'remember_token', 
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function requests() {
        return $this->hasMany(_Request::class);
    }


    public function store()
    {
        return $this->belongsToMany(Store::class, 'store_user');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class , 'offer_user');
    }

    public function cart() {
        return $this->hasOne(Cart::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

}
