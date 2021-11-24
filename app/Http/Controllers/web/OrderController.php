<?php

namespace App\Http\Controllers\web;

use App\Events\LogInUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Area;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderCart;
use App\Notifications\OrderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{


    public function index()
    {

        return back();
    }



    public function store(OrderRequest $request){


        $country = Country::findOrFail($request->country);
        $area    = Area::where('id' , $request->area)->where('country_id' , $country->id);
        $request->payment == 'cache' ? $area->where('cache'  , 1) : '';
        $area = $area->firstOrFail();

        if (!auth()->check()) { // check is not auth

            $user = User::where('email' , $request->email)->first();

            if ($user) { // if found user email in data base


                $login = Auth::attempt(['email' => $request->email, 'password' => $request->password], true);

                if (!$login) { // if password false

                    $btnResetPassword = "<a href='".url('password/reset')."' class='btn btn-info'> استعادة كلمة المرور </a>";

                    return back()
                        ->withInput($request->all())
                        ->with('error' , " هناك حساب بالفعل مسجل لدينا بنفس البريد لاكن كلمة المرور المدخلة مختلفة اذا كنت لا تتذكر كلمة المرور الحالية يمكنك تغيرها $btnResetPassword");
                }

            } else { // if not found email

                $user = $this->createAccount($request);

                \auth()->login($user);
            }


            Cart::where('guest_ip' , $request->ip())->update([

                'guest_ip' => null,
                'user_id' => auth()->id()
            ]);

        }else{ // if is user login

            $user = \auth()->user();
        }


        // get all products in cart
        $products = $user->carts()->doesntHave('orderCart')->get();

        if ($products->count() <= 0 ) {

            return redirect()->back();
        }

        $product_count  = $products->map->quantity->sum();
        $product_price  = $products->map->price->sum();

        // check in coupon number
        $coupon_discount = 0;
        $coupon = '';


        if ($request->serial) {

            $coupon = Coupon::withCount('authActive')->where('serial', $request->serial)->first();

            if ($coupon) {

                if ($coupon->end_at < Carbon::now() || $coupon->status == 0) {

                    return back()->with('error', "يبدو ان قسيمة المشتريات المدخلة قد انتهت")
                        ->withInput($request->all());

                } elseif ($coupon->auth_active_count >= $coupon->limit_user) {

                    return back()->with('error', "لقد انتهي عدد استخدام القسيمة المحدد لهاذا الحساب ")
                        ->withInput($request->all());

                } elseif ($coupon->min_price > $product_price) {

                    return back()->with('error', "يجب ان يكون اجمالي الطلب اكبر من او يساوي $coupon->min_price ريال لكي يمكنك استخدام هاذه القسيمة ")
                        ->withInput($request->all());

                } elseif ($coupon->use >= $coupon->limit) {

                    return back()->with('error', "القسمية المدخلة انتهي عدد مرات الاستخدام المسوح بها")
                        ->withInput($request->all());

                }

                if ($coupon->type == 0):

                    $coupon_discount = ( $product_price * $coupon->discount) / 100;

                elseif ($coupon->type == 1):


                    $coupon_discount =   $coupon->discount;

                endif;

            } else { // not found coupon

                return back()->with('error', "كود قسيمة المشتريات غير صحيح")
                    ->withInput($request->all());
            }


        }


        DB::transaction(function () use ($request  , $product_count , $product_price , $coupon_discount   , $user , $area , $country , $coupon , $products , &$order){

            $shipping_price = ($product_price - $coupon_discount) > 300 ? 0 : $area->shipping_price ;

            $img_name = null;
            if($request->has('img_payment')){

                $img = $request->file('img_payment');
                $img_name = rand(100000, 8000000).'.jpg';
                $img->move(public_path('assets/web/images/payment/') , $img_name);
            }

            $order = Order::create([

                'name' => $request->get('name'),
                'email' => $request->get('email' , \auth()->user() ? \auth()->user()->email: now().rand(100000 , 9000000).'@test.com' ),
                'phone' => $request->get('phone'),
                'not' => $request->get('not'),
                'address' => $request->get('address'),
                'shipping_price' => $shipping_price,
                'product_count' => $product_count,
                'payment' => $request->get('payment'),
                'img_payment' => $img_name,
                'price' => $product_price,
                'coupon_discount' => $coupon_discount,
                'total' => round(($product_price + $shipping_price) - $coupon_discount , 2),
                'user_id' => $user->id,
                'country_id' => $country->id,
                'area_id' => $area->id,
                'coupon_id' => $coupon ? $coupon->id : null,

            ]);


            $orderCartData = $this->createCartsOrder($products, $order->id);

            OrderCart::insert($orderCartData);

            if ($coupon){

                $coupon->update([

                    'use' => $coupon->use+1
                ]);


                DB::table('coupon_user')->insert([
                    'user_id' => \auth()->id(),
                    'coupon_id' => $coupon->id,
                    'order_id' => $order->id
                ]);

            }


        });

        $admins = User::where('admin' , 1)->get();


        Notification::send($admins , $notify =  new OrderNotification(\auth()->user() , $order));

        event(new  \App\Events\OrderNotifyEvent($order));

        return redirect("profile/show/order/$order->id")->with('message' , 'تم تسجيل الاودر بنجاح');
    }


    public function destroy($id)
    {

        auth()->check()
            ? Cart::where('id' , $id)->where( 'user_id' , auth()->id())->delete()
            : Cart::where('id' , $id)->where( 'guest_ip' , \request()->ip())->delete();


        return  response(['status' => 'success']);
    }


    private function createAccount($request){

        $rules = [

            'name'       => ['required' , 'string' , 'max:20'],
//            'email'      => ['required' , 'string' , 'max:255'],
            'phone'      => ['required', 'string', 'max:20' , Rule::phone() ->country(['EG', 'SA' , 'YE' , 'QA' , 'BH'  , 'KW' , 'AE' , 'JO'])],
//            'password'   => ['required' , 'string' , 'min:8' , 'max:255'],
            'country'    => ['integer'],
            'area'       => ['integer'],
        ];

        $this->validate($request , $rules);

       return User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'  , \auth()->user() ? \auth()->user()->email: now().rand(100000 , 9000000).'@test.com' ),
            'phone' => $request->get('phone'),
            'country_id' => $request->get('country'),
            'area_id' => $request->get('area'),
            'password' => Hash::make($request->get('password' , rand(100000 , 9000000))),
        ]);
    }

    private function createCartsOrder($products , $order_id){

        $orderCartData = [];

        $i = 0;

        foreach ($products as $cart){

            File::copy(public_path("assets/web/images/products/min/$cart->img") , public_path("assets/web/images/carts/$cart->img"));

            $orderCartData[$i]['name'] = $cart->name;
            $orderCartData[$i]['count'] = $cart->quantity;
            $orderCartData[$i]['price'] = $cart->min_price;
            $orderCartData[$i]['img'] = $cart->img;
            $orderCartData[$i]['total'] = $cart->price;
            $orderCartData[$i]['size_name'] = $cart->size_name;
            $orderCartData[$i]['color_name'] = $cart->color_name;
            $orderCartData[$i]['color_img'] = $cart->color_img;
            $orderCartData[$i]['total'] = $cart->price;
            $orderCartData[$i]['order_id'] = $order_id;
            $orderCartData[$i]['cart_id'] = $cart->id;
            $i++;
        }

        return $orderCartData;
    }

}


