<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\SectionController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\SingleProductController;
use App\Http\Controllers\web\OfferController;
use App\Http\Controllers\web\PremiumController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\OrderController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SearchController;
use App\Http\Controllers\web\LikeController;
use App\Http\Controllers\web\CompareController;
use App\Http\Controllers\web\FashionController;



Auth::routes();

Route::middleware('auth')->group(function (){

    Route::get('logout' , [\App\Http\Controllers\Auth\LogoutController::class , 'logout'])->name('logout');

    Route::get('profile' , [ProfileController::class , 'index'])->name('profile.index');

    Route::get('profile/delete/order/{id}' , [ProfileController::class , 'deleteOrder'])->name('profile.deleteOrder');
    Route::get('profile/show/order/{id}' , [ProfileController::class , 'showOrder'])->name('profile.order.show');

    Route::get('profile/edit' , [ProfileController::class , 'edit'])->name('profile.edit');

    Route::post('profile/update/{id}' , [ProfileController::class , 'update'])->name('profile.update');

    Route::get('profile/likes' , [LikeController::class , 'index'])->name('web.like.index');
    Route::post('like/start' , [LikeController::class , 'start'])->name('web.like.start');
    Route::post('like/{id}' , [LikeController::class , 'create'])->name('web.like.create');

    Route::get('profile/compare' , [CompareController::class , 'index'])->name('web.compare.index');
    Route::post('compare/start' , [CompareController::class , 'start'])->name('web.compare.start');
    Route::post('compare/{id}' , [CompareController::class , 'create'])->name('web.compare.create');

});

Route::as('web.')->group(function () {

    Route::get('section/{slug}', [SectionController::class, 'index'])->name('section.show');

    Route::get('fashion-and-style', [FashionController::class, 'index'])->name('fashion-and-style');

    Route::get('category/{slug}', [CatController::class, 'index'])->name('cat.show');

    Route::get('product/{slug}', [SingleProductController::class, 'index'])->name('product.show');

    Route::resource('cart', CartController::class);

    Route::post('cart_start' , [CartController::class , 'start'])->name('cart.start');

    Route::get('cart_delete_all' , [CartController::class , 'cart_delete_all'])->name('cart.cart_delete_all');

    Route::post('cart_update_count/{id}' , [CartController::class , 'cart_update_count'])->name('cart.cart_update_count');


    Route::resource('order', OrderController::class);

    Route::get('offers', [OfferController::class, 'index'])->name('offer.show');

    Route::get('premium', [PremiumController::class, 'index'])->name('premium.show');

    Route::get('about', [AboutController::class, 'index'])->name('about.show');

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('search', [SearchController::class, 'index'])->name('search.index');

    Route::view('privacy-policy' ,'web.pages.privacy.index')->name('privacyPolicy');

    Route::post('create/count-clicks/{type}' ,[\App\Http\Controllers\web\ClickController::class , 'create'])->name('countClicks.create');


    Route::get('blog' , [\App\Http\Controllers\web\PostController::class ,  'blog'])->name('blog');
    Route::get('blog/post/{slug}' , [\App\Http\Controllers\web\PostController::class ,  'showPost'])->name('post.show');
    Route::get('blog/category/{slug}' , [\App\Http\Controllers\web\PostController::class ,  'cat'])->name('post.cat');
    Route::get('blog/tag/{name}' , [\App\Http\Controllers\web\PostController::class ,  'tag'])->name('post.tag');
    Route::post('blog/post/visits' , [\App\Http\Controllers\web\PostController::class ,  'visits'])->name('post.visits');
});


