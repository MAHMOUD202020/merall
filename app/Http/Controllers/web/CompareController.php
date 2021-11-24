<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{

    public function start(){

        $compares  = Compare::where('user_id' , auth()->id())->count();

        return response(['count' => $compares]);
    }

    public function index(){

        $compare_products = Product::with('cats')->whereHas('compares' , function ($q){

            $q->where('user_id' , auth()->id());

        })->customSelect()->get();


        return view('web.pages.profile.compare' , compact('compare_products'));

    }


    public function create ($id){

        $product = Product::findOrFail($id);

        $user_id = auth()->id();

        $like = $product->compares()->where('user_id' , $user_id)->first();

        if ($like) {

            $like->delete();

        }else{ //else not like


            $product->compares()->create([

                'user_id' => $user_id

            ]) ;

        } // end if like


        $comparesCount  = Compare::where('user_id' , auth()->id())->count();

        return response(['count' => $comparesCount]);
    }
}
