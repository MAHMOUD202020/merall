<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['_token' , 'status'];

    public function orderCarts(){

        return $this->hasMany(OrderCart::class );
    }

    public function country(){

        return $this->belongsTo(Country::class);
    }

    public function area(){

        return $this->belongsTo(Area::class);
    }


    public function orderStatus($value)
    {
        $status = [0 => ' تم اتمام الطلب بنجاح وجاري تجهيزه والتواصل معكم'  , 1 => ' تم اتمام الطلب بنجاح وجاري تجهيزه والتواصل معكم' , 2 => 'تم التسليم'   , 3 => 'تم استرجاع الطلب' , 4 => 'تم رفض الطلب'];
//        $status = [0 => 'تم الطلب'  , 1 => 'تمت الموافقة' , 2 => 'تم التسليم'   , 3 => 'تم استرجاع الطلب' , 4 => 'تم رفض الطلب'];
        return $status[$value];
    }

    public function getPaymentAttribute($value)
    {
        $status = ['cache' => 'الدفع عند الاستلام'  , 'bank' => 'التحويل البنكي'];
        return $status[$value];
    }


}
