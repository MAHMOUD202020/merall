<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class CatController extends Controller
{

    public function index($slug){


        $orderBy = $this->order();
        $orderSort =  \request()->has('orderSort') ? \request('orderSort') : 'desc';


        $cat = Cat::where('slug' , $slug)->firstOrFail();

        $products = $cat->products()
            ->orderBy($orderBy , $orderSort)
            ->whereBetween('price' , $this->price())
            ->simplePaginate(15);

        $lastPage = $products->hasMorePages();

        if (\request()->ajax()) {

            $productsRender = view('web.pages.cat.render')->with([
                'products' => $products,
            ])->render();

            return response(['data' => $productsRender , 'lastPage' => $lastPage]);
        }

        $offersRandom_products = Product::discount()
            ->orderDiscount()
            ->inRandomOrder()
            ->limit(10)
            ->get(['updated_at' , 'price' , 'name' , 'slug' , 'percentage' , 'discount' , 'img' , 'alt']);


        return view('web.pages.cat.index')->with([
            'offersRandom_products' => $offersRandom_products,
            'cat' => $cat,
            'products' => $products,
        ]);
    }

    public function order(){

        $order = 'id';

        if (\request()->has('orderBy')) {

            if (\request('orderBy') == "date") {

                $order = 'id';

            }elseif (\request('orderBy') == "price"){

                $order = 'price';

            }elseif (\request('orderBy') == "featured"){

                $order = 'premium';

            }elseif (\request('orderBy') == "sale"){

                $order = "percentage";
            }
        }

        return $order;
    }
    public function price(){


        if (\request()->has('price-rang')) {

            $text_price = explode('-' , \request()->get('price-rang'));
            $price = [$text_price[0], $text_price[1]];

        }else{

            $price = [0, 10000];
        }

        return $price;
    }
}
