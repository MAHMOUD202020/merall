<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Area;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(){

        $user = auth()->user();
        $orders = $user->orders()->latest()->get();

        return view('web.pages.profile.index' , compact('orders' , 'user'));
    }

    public function deleteOrder($id){

      $order =  auth()->user()->orders()
          ->where('id' , $id)
          ->where('status' , 0)
          ->firstOrFail();

      $order->orderCarts()->delete();

      if ($order->coupon_id){

          $coupon = Coupon::where('id' , $order->coupon_id)->first();

          $coupon->update([

              'use' => $coupon->use - 1
          ]);

          DB::table('coupon_user')
              ->where('user_id' , auth()->id())
              ->where('coupon_id' , $coupon->id)
              ->where('order_id' , $order->id)
              ->delete();
      }

      $order->delete();

        return back()->with('message' , 'تم حذف الطلب بنجاح');
    }


    public function showOrder($id){

        $order =  auth()->user()->orders()->where('id' , $id)->firstOrFail();

        return view('web.pages.profile.order' , compact('order'));

    }

    public function edit(){

        $countries  = Country::with('areas')->get(['name' , 'id']);

        return view('web.pages.profile.edit')->with('countries' , $countries);
    }


       public function update(UserRequest $request){


           $country = Country::findOrFail($request->country);
           $area    = Area::where('id' , $request->area)->where('country_id' , $country->id)->firstOrFail();

           auth()->user()->update([
               'name'       => $request->name,
               'email'      => $request->email,
               'phone'      => $request->phone,
               'address'    => $request->address,
               'country_id' => $country->id,
               'area_id'    => $area->id,
           ]);

           return back()->with('message' , 'تم تعديل البيانات بنجاح');
    }


}
