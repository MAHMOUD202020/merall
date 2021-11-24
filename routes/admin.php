<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\SectionController;
use \App\Http\Controllers\admin\CatController;
use \App\Http\Controllers\admin\ProductController;
use \App\Http\Controllers\admin\ColorController;
use \App\Http\Controllers\admin\SizeChartController;
use \App\Http\Controllers\admin\SizeController;
use \App\Http\Controllers\admin\UserController;
use \App\Http\Controllers\admin\CountryController;
use \App\Http\Controllers\admin\AreaController;
use \App\Http\Controllers\admin\NewsController;
use \App\Http\Controllers\admin\OrderController;
use \App\Http\Controllers\admin\PostController;
use \App\Http\Controllers\admin\CatBlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard', [App\Http\Controllers\admin\DashboardController::class , 'index'])->name('dashboard.index');
Route::get('dashboard/show/{name}', [App\Http\Controllers\admin\DashboardController::class , 'show'])->name('dashboard.show');
Route::get('/', [App\Http\Controllers\admin\DashboardController::class , 'index'])->name('dashboard.index');

Route::resource('roles', App\Http\Controllers\admin\roleController::class);

Route::resource('coupon', App\Http\Controllers\admin\CouponController::class);

Route::resource('section' , SectionController::class );
Route::get('trash/section/{id?}' , [SectionController::class , 'trash'])->name('section.trash');
Route::post('trash/section/{id}' , [SectionController::class , 'restore'])->name('section.restore');
Route::delete('trash/section/{id}' , [SectionController::class , 'finalDelete'])->name('section.finalDelete');


Route::resource('cat' , CatController::class );
Route::get('trash/cat/{id?}' , [CatController::class , 'trash'])->name('cat.trash');
Route::post('trash/cat/{id}' , [CatController::class , 'restore'])->name('cat.restore');
Route::delete('trash/cat/{id}' , [CatController::class , 'finalDelete'])->name('cat.finalDelete');

Route::resource('product' , ProductController::class );
Route::post('product/fullUpdate/{id}' , [ProductController::class , 'fullUpdate'])->name('product.fullUpdate');
Route::get('trash/product/{id?}' , [ProductController::class , 'trash'])->name('product.trash');
Route::post('trash/product/{id}' , [ProductController::class , 'restore'])->name('product.restore');
Route::delete('trash/product/{id}' , [ProductController::class , 'finalDelete'])->name('product.finalDelete');

Route::resource('color' , ColorController::class );
Route::get('trash/color/{id?}' , [ColorController::class , 'trash'])->name('color.trash');
Route::post('trash/color/{id}' , [ColorController::class , 'restore'])->name('color.restore');
Route::delete('trash/color/{id}' , [ColorController::class , 'finalDelete'])->name('color.finalDelete');

Route::resource('sizeChart' , SizeChartController::class );
Route::get('trash/sizeChart/{id?}' , [SizeChartController::class , 'trash'])->name('sizeChart.trash');
Route::post('trash/sizeChart/{id}' , [SizeChartController::class , 'restore'])->name('sizeChart.restore');
Route::delete('trash/sizeChart/{id}' , [SizeChartController::class , 'finalDelete'])->name('sizeChart.finalDelete');

Route::resource('size' , SizeController::class );
Route::get('trash/size/{id?}' , [SizeController::class , 'trash'])->name('size.trash');
Route::post('trash/size/{id}' , [SizeController::class , 'restore'])->name('size.restore');
Route::delete('trash/size/{id}' , [SizeController::class , 'finalDelete'])->name('size.finalDelete');

Route::resource('user' , UserController::class );
Route::get('trash/user/{id?}' , [UserController::class , 'trash'])->name('user.trash');
Route::post('trash/user/{id}' , [UserController::class , 'restore'])->name('user.restore');
Route::delete('trash/user/{id}' , [UserController::class , 'finalDelete'])->name('user.finalDelete');

Route::resource('admin' , UserController::class );
Route::get('trash/admin/{id?}' , [UserController::class , 'trash'])->name('admin.trash');
Route::post('trash/admin/{id}' , [UserController::class , 'restore'])->name('admin.restore');
Route::delete('trash/admin/{id}' , [UserController::class , 'finalDelete'])->name('admin.finalDelete');

Route::resource('country' , CountryController::class );
Route::get('trash/country/{id?}' , [CountryController::class , 'trash'])->name('country.trash');
Route::post('trash/country/{id}' , [CountryController::class , 'restore'])->name('country.restore');
Route::delete('trash/country/{id}' , [CountryController::class , 'finalDelete'])->name('country.finalDelete');

Route::resource('area' , AreaController::class );
Route::get('trash/area/{id?}' , [AreaController::class , 'trash'])->name('area.trash');
Route::post('trash/area/{id}' , [AreaController::class , 'restore'])->name('area.restore');
Route::delete('trash/area/{id}' , [AreaController::class , 'finalDelete'])->name('country.finalDelete');

Route::resource('news' , NewsController::class );

Route::resource('order' , OrderController::class );
Route::post('replace/status/order/{status}/{id}' , [OrderController::class, 'replaceStatus'])->name('order.replaceStatus');
Route::get('invoice/order/{id}' , [\App\Http\Controllers\admin\InvoiceController::class , 'index'] );

Route::post('removeNotify/{id}' , [\App\Http\Controllers\admin\NotifyController::class , 'remove'])->name('notify.remove');


Route::resource('post' , PostController::class );
Route::get('trash/post/{id?}' , [PostController::class , 'trash'])->name('post.trash');
Route::post('trash/post/{id}' , [PostController::class , 'restore'])->name('post.restore');
Route::delete('trash/post/{id}' , [PostController::class , 'finalDelete'])->name('post.finalDelete');

Route::resource('catBlog' , CatBlogController::class );
Route::get('trash/catBlog/{id?}' , [CatBlogController::class , 'trash'])->name('catBlog.trash');
Route::post('trash/catBlog/{id}' , [CatBlogController::class , 'restore'])->name('catBlog.restore');
Route::delete('trash/catBlog/{id}' , [CatBlogController::class , 'finalDelete'])->name('post.finalDelete');

Route::resource('slide'  , \App\Http\Controllers\admin\SlideController::class);



Route::get('migrate' , function (){

    \Illuminate\Support\Facades\Artisan::call('migrate');

    return 'migrate success';

});

Route::get('cache' , function (){

    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:cache');

    return 'cache success';

});

