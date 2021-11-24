<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index(){

        $products = Product::with('cats')
            ->where('discount' , '>' , 0)
            ->customSelect()
            ->simplePaginate(30);

        $lastPage = $products->hasMorePages();

        if (\request()->ajax()) {

            $productsRender = view('web.pages.offer.render')->with([
                'products' => $products,
            ])->render();

            return response(['data' => $productsRender , 'lastPage' => $lastPage]);
        }

        return view('web.pages.offer.index')->with([

            'products' => $products,
        ]);
    }
}
