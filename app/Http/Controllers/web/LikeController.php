<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function start(){

        $likes  = Like::where('user_id' , auth()->id())->count();

        return response(['count' => $likes]);
    }

    public function index(){

        $like_products = Product::with('cats')->whereHas('likes' , function ($q){

            $q->where('user_id' , auth()->id());

        })->customSelect()->get();


        return view('web.pages.profile.like' , compact('like_products'));

    }


    public function create ($id){

        $product = Product::findOrFail($id);

        $user_id = auth()->id();

        $like = $product->likes()->where('user_id' , $user_id)->first();

        if ($like) {

            $like->delete();

        }else{ //else not like


            $product->likes()->create([

                'user_id' => $user_id

            ]) ;

        } // end if like


        $likesCount  = Like::where('user_id' , auth()->id())->count();

        return response(['count' => $likesCount]);
    }
}
