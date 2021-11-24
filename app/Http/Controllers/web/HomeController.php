<?php

namespace App\Http\Controllers\web;

use App\Events\StatusLiked;
use App\Events\TestNewEvent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;
use App\Models\TapNew;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{


    public function home(){

        $slides = Slide::latest()->get();

        $new_products = Product::with('cats')->latest('id')
            ->take(10)
            ->get();

        $premium_products = Product::with('cats')->premium()
            ->take(10)
            ->get();

        $offer_products = Product::with('cats')->discount()
            ->take(10)
            ->get();


        return view('web.pages.home.index')->with([
            'slides' => $slides,
            'new_products' => $new_products,
            'premium_products' => $premium_products,
            'offer_products' => $offer_products,
            'newProductDate' => $this->newProductDate(),
        ]);
    }

    public function newProductDate(){

        return Carbon::now()->addMonth();
    }


}
