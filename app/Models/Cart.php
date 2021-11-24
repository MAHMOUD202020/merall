<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function orderCart(){

        return $this->hasMany(OrderCart::class );
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
