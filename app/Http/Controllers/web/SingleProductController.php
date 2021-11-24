<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SingleProductController extends Controller
{


    public function index($slug){

        $product = Product::where('slug'  , $slug)
            ->with(['images'  , 'colors' , 'cats' => function($q){

                $q->with('section');

            }])->firstOrFail();

        $moro_products = Product::with('cats')
            ->inRandomOrder()
            ->take(8)
            ->get();

        $like = false;

        if (auth()->check()) {

            $like = Like::where('product_id' , $product->id)->where('user_id' , auth()->id())->first('id');
        }

        $sizes  = $product->sizes()->latest('sort')->get()->all();

        $colors = $product->colors;


        return view('web.pages.singleProduct.index' , compact(
            'product' ,
            'moro_products',
            'like',
            'sizes',
            'colors',
        ));
    }


}
