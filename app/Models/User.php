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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'profile_image',
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
        'remember_token', 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function requests() {
        return $this->hasMany(Request::class);
    }


    public function stores()
    {
        return $this->belongsToMany(Store::class);
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
