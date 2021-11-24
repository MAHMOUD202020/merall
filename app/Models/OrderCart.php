<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    use HasFactory;

    protected $table = 'order_carts';

    protected $guarded = [
        '_token',
    ];
}
