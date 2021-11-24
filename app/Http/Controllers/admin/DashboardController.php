<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cat;
use App\Models\Click;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $orders =[];

        Order::latest('id')->where('created_at' ,  '>'  , Carbon::now()->subWeek())

            ->get(['id' , 'created_at'])->groupBy(function($item) {

            return $item->created_at->format('Y-m-d');

        })->each(function ($value) use (&$orders){

                $orders [] = $value->count();
        });

        $topCatsProduct = Cat::withCount('products')
            ->latest('products_count')
            ->limit(10)
            ->get(['id' , 'name' , 'slug']);

        $lessCatsProduct = Cat::withCount('products')
            ->oldest('products_count')
            ->limit(10)
            ->get(['id' , 'name' , 'slug']);

        $topProducts = Product::withCount('carts')
            ->latest('carts_count')
            ->latest('id')
            ->limit(10)
            ->get(['id' , 'name' , 'slug' , 'price' , 'discount']);

        $lessProducts = Product::withCount('carts')
            ->oldest('carts_count')
            ->oldest('id')
            ->limit(10)
            ->get(['id' , 'name' , 'slug' , 'price' , 'discount']);



        $salesCount = Click::where('type' , 'sales')->count();

        $abayasCount = Click::where('type' , 'abayas')->count();


        $cartUserCount = Cart::where('user_id' , '!=' , null)
            ->groupBy('user_id')
            ->get('id')->count();

        $cartGuestCount = Cart::where('guest_ip' , '!=' , null)
            ->groupBy('guest_ip')
            ->get('id')->count();

        return view('admin.pages.dashboard.index')->with([

            'orders' => array_reverse($orders),
            'topCatsProduct' => $topCatsProduct,
            'lessCatsProduct' => $lessCatsProduct,
            'topProducts' => $topProducts,
            'lessProducts' => $lessProducts,
            'salesCount' => $salesCount,
            'abayasCount' => $abayasCount,
            'cartUserCount' => $cartUserCount,
            'cartGuestCount' => $cartGuestCount,
        ]);
    }


    public function show($name){

        if ($name == 'sales') {

            $data = Click::where('type' , 'sales')->paginate(10);

            return view('admin.pages.dashboard.infoClick'  , compact('data'));

        }
        elseif ($name == 'abayas') {

            $data = Click::where('type' , 'abayas')->paginate(10);

            return view('admin.pages.dashboard.infoClick'  , compact('data'));

        }
        elseif ($name == 'cartUser') {

            $data = Cart::with('user')->where('user_id' , '!=' , null)
                ->orderBy('created_at' , 'desc')
                ->select([\DB::raw('count(*) as num') , 'user_id' , 'created_at'])
                ->groupBy('user_id')
                ->paginate();

            return view('admin.pages.dashboard.infoCart'  , compact('data'));

        }
        elseif ($name == 'cartGuest') {

            $data = Cart::where('guest_ip' , '!=' , null)
                ->orderBy('created_at' ,'desc')
                ->select([\DB::raw('count(*) as num') , 'guest_ip' , 'created_at'])
                ->groupBy('guest_ip')
                ->paginate(10);

            return view('admin.pages.dashboard.infoCart'  , compact('data'));

        }else{

             abort(404);

            return false;
        }

    }
}
