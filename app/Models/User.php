<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{

    use HasFactory, Notifiable , SoftDeletes , Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country_id',
        'area_id',
        'admin',
        'password',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function country(){

        return $this->belongsTo(Country::class);
    }

    public function area(){

        return $this->belongsTo(Area::class);
    }

    public function carts(){

        return $this->hasMany(Cart::class);
    }

    public function orders(){

        return $this->hasMany(Order::class);
    }



    public function roles(){

        return $this->belongsToMany(Role::class , 'user_role');
    }

}
