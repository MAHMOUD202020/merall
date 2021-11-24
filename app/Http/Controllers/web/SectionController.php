<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index($slug){

        $orderBy = $this->order();
        $orderSort =  \request()->has('orderSort') ? \request('orderSort') : 'desc';


        $section = Section::with('cats')
            ->where('slug' , $slug)
            ->firstOrFail(['id', 'name' , 'slug' , 'meta_description']);

        $cats_id = $section->cats->map->id->all();

        $products = Product::with('cats')
            ->whereHas('cats', function ($q) use ($cats_id){
                $q->whereIn('cats.id' , $cats_id);
            })
            ->orderBy($orderBy , $orderSort)
            ->whereBetween('price' , $this->price())
            ->customSelect()
            ->simplePaginate(15);

        $lastPage = $products->hasMorePages();

        if (\request()->ajax()) {

            $productsRender = view('web.pages.section.render')->with([
                'products' => $products,
            ])->render();

            return response(['data' => $productsRender , 'lastPage' => $lastPage]);
        }

        $offersRandom_products = Product::discount()
            ->orderDiscount()
            ->inRandomOrder()
            ->limit(10)
            ->get(['updated_at' , 'price' , 'name' , 'slug' , 'percentage' , 'discount' , 'img' , 'alt']);

        return view('web.pages.section.index') ->with([

            'section' => $section,
            'products' => $products,
            'offersRandom_products' => $offersRandom_products,
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
