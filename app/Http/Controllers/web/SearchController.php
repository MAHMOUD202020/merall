<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index(){

        $value = \request('value');
        $products = Product::with('cats')
            ->where('id' , $value)
            ->orWhere('name' , 'like' , "%$value%")
            ->customSelect()
            ->simplePaginate();

        $lastPage = $products->hasMorePages();

        if (\request()->ajax()) {

            $productsRender = view('web.pages.search.render')->with([
                'products' => $products,
            ])->render();

            return response(['data' => $productsRender , 'lastPage' => $lastPage]);
        }

        return view('web.pages.search.index' , compact('products' , 'value'));
    }
}
