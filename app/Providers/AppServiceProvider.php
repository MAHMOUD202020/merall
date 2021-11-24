<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Section;
use App\Models\TapNew;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $sections = Section::with(['cats' => function($q){
            $q->withCount('products')
                ->has('products')
                ->latest('products_count');

        }])->where('id' , '!=' , 6)
            ->get(['id' ,'name' , 'slug' , 'meta_description']);

        $news = TapNew::latest('id')
            ->where('type' , 0)
            ->take(10)
            ->get(['value' , 'link']);

        $minNews = TapNew::where('type' , 1)
            ->inRandomOrder()
            ->first(['value' , 'link']);

//        // المنتجات الي عليها خصم
//        $offersRandom_products = Product::discount()
//            ->orderDiscount()
//            ->inRandomOrder()
//            ->limit(10)
//            ->get(['updated_at' , 'price' , 'name' , 'slug' , 'percentage' , 'discount' , 'img' , 'alt']);


        View::share([
            'sections' => $sections ,
            'news' => $news ,
            'minNews' => $minNews,
//            'offersRandom_products' => $offersRandom_products,
        ]);
    }
}
