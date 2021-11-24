<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['_token'];

    public function products(){

        return $this->belongsToMany(Product::class , 'product_cat');
    }

    public function section(){

        return $this->belongsTo(Section::class);
    }
}
