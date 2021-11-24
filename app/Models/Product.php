<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;

class Product extends Model
{
    use HasFactory , Commentable , SoftDeletes;


    protected $guarded = [
        '_token',
    ];


    protected $casts = [

        'discount' => 'double',
        'price' => 'double',
        'percentage' => 'double',
    ];

    public  function orders(){

        return $this->belongsToMany(Order::class , 'order_product');
    }

    public function carts(){

        return $this->hasMany(Cart::class);
    }

    public function images(){

        return $this->hasMany(Image::class);
    }

    public function colors(){

        return $this->belongsToMany(Color::class , 'product_color');
    }

    public function sizeChart(){

        return $this->belongsTo(SizeChart::class , 'sizeChart_id' , 'id');
    }

    public function sizes(){

        return $this->belongsToMany(Size::class , 'product_size');
    }

    public function cats(){

        return $this->belongsToMany(Cat::class , 'product_cat');
    }


    public function likes(){

        return $this->hasMany(Like::class);
    }

    public function compares(){

        return $this->hasMany(Compare::class);
    }

    public function scopeDiscount($q){

        return $q->where('discount' , '>'  , 0);
    }

    public function scopeOrderDiscount($q){

        return $q->orderBy('percentage' , 'desc');
    }

    public function scopePremium($q){

        return $q->where('premium' , '='  , 1)->orderBy('updated_at' , 'desc');
    }

    public function scopeCustomSelect($q){

        return $q->select([ 'id' , 'name' , 'slug'  , 'img', 'shortDescription' , 'price' , 'discount' , 'percentage' , 'available' , 'premium' , 'created_at' , 'alt']);
    }



}
