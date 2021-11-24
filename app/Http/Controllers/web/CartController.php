<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Country;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function start(){

        $carts = auth()->check()
            ?  Cart::doesntHave('orderCart')->where('user_id' , auth()->id())->latest('id')->get()
            : Cart::doesntHave('orderCart')->where('guest_ip' , request()->ip())->latest('id')->get();


        $newCart = view('web.pages.cart.render')->with('carts'  , $carts)->render();

        return response(['status' => 'success' , 'data' => $newCart , 'count' => $carts->count()]);

    }

    public function index()
    {
        $countries         = Country::with('areas')->get(['name' , 'id']);
        $areasFirstCountry = $countries->first()->areas;

        $carts = auth()->check()
            ?  Cart::doesntHave('orderCart')->where('user_id' , auth()->id())->latest('id')->get()
            : Cart::doesntHave('orderCart')->where('guest_ip' , request()->ip())->latest('id')->get();

        return  view('web.pages.cart.index')->with(['countries' => $countries , 'carts' => $carts , 'areasFirstCountry' , $areasFirstCountry]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request){


        $product = Product::findOrFail($request->product);

        $size  = $this->sizeRequest($product->sizes());

        $color = $this->colorRequest($product->colors());



        $data = [];
        $data['color'] = $color;
        $data['size'] = $size;
        $data['end price'] = $product->discount > 0 ? $product->discount : $product->price ;;
        $data['new quantity'] = $request->quantity > 1 ? $request->quantity : 1;

        if (auth()->check()) {

            $this->add_to_cart_is_auth($product , $data);

        }else {


            $this->add_to_cart_is_guest($product  , $data);
        }

        $carts = auth()->check()
            ?  Cart::doesntHave('orderCart')->where('user_id' , auth()->id())->latest('id')->get()
            : Cart::doesntHave('orderCart')->where('guest_ip' , request()->ip())->latest('id')->get();


        $newCart = view('web.pages.cart.render')->with('carts'  , $carts)->render();

        return response(['status' => 'success' , 'data' => $newCart , 'count' => $carts->count()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

        foreach ($request->card as $card){

            $newQu = (int)$card['quantity'] > 0  ? (int)$card['quantity'] : 1;

            $cart = auth()->check()
                ? Cart::where('id' , (int)$card['id'])
                ->where('user_id' , auth()->id())
                ->first()

                :Cart::where('id' , (int)$card['id'])
                ->where('guest_ip' , $request->ip())
                ->first();

            $newQu = $newQu > 20 ? 20 : $newQu;

            $cart->update([

                'quantity' => $newQu,
                'price' => $newQu * $cart->min_price,

                 ]);
        }

        return back()->with('message' , 'تم تحديث السلة');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        auth()->check()
            ? Cart::doesntHave('orderCart')->where('id' , $id)->where( 'user_id' , auth()->id())->delete()
            : Cart::doesntHave('orderCart')->where('id' , $id)->where( 'guest_ip' , \request()->ip())->delete();


        if (\request()->ajax()) {

            return  response(['status' => 'success']);
        }

        return back()->with('message' , 'تم حذف المنتج من السلة');
    }


    public function cart_delete_all(){

        auth()->check()
            ? Cart::where( 'user_id' , auth()->id())->delete()
            : Cart::where( 'guest_ip' , \request()->ip())->delete();

        return back();
    }


    public function cart_update_count($id){

        $cart = auth()->check()
            ? Cart::where( 'user_id' , auth()->id())->where('id' , $id)->first()
            : Cart::where( 'guest_ip' , \request()->ip())->where('id' , $id)->first();

        if (\request('quantity') <= 0){
            $quantity = 1;
        }elseif (\request('quantity') > 20){
            $quantity = 20;
        }else{
            $quantity = \request('quantity');
        }

        $cart->update([
            'quantity' => \request('quantity'),
            'price' => \request('quantity')  * $cart->min_price
        ]);

    }
    private function add_to_cart_is_auth($product , $data=[]){



        $endPrice = $data['end price'];
        $newQuantity = $data['new quantity'];
        $color = $data['color'];
        $size = $data['size'];

        $oldCart = auth()->user()
            ->carts()
            ->doesntHave('orderCart')
            ->where('product_id' , $product->id);
        $size ? $oldCart->where('size_name' , $size->name) : '';
        $color ? $oldCart ->where('color_name' , $color->name)->where('color_img' , $color->img) : '';
        $oldCart = $oldCart->first();

        if ($oldCart) {

            $endQuantity = $oldCart->quantity + $newQuantity;

            $oldCart->update([

                'name' => $product->name,
                'quantity' => $endQuantity > 20 ? 20 : $endQuantity,
                'img' => $product->img,
                'slug' => $product->slug,
                'min_price' => $endPrice,
                'price' => $endPrice * $endQuantity,
                'size_name' => $size ? $size->name : null,
                'color_name' => $color ? $color->name : null,
                'color_img' => $color ? $color->img : null,

            ]);

        }else{

            auth()->user()->carts()->create([

                'name' => $product->name,
                'quantity' => $newQuantity,
                'img' => $product->img,
                'slug' => $product->slug,
                'min_price' => $endPrice,
                'price' => $endPrice,
                'size_name' => $size ? $size->name : null,
                'color_name' => $color ? $color->name : null,
                'color_img' => $color ? $color->img : null,
                'product_id' => $product->id,
            ]);

        }
    }
    private function add_to_cart_is_guest($product , $data=[]){

        $endPrice = $data['end price'];
        $newQuantity = $data['new quantity'];
        $color = $data['color'];
        $size = $data['size'];

        $ip = \request()->ip();

        $oldCart = Cart::where('product_id' , $product->id)
            ->where('guest_ip' , $ip);
        $size ? $oldCart->where('size_name' , $size->name) : '';
        $color ? $oldCart ->where('color_name' , $color->name)->where('color_img' , $color->img) : '';
        $oldCart = $oldCart->first();

        if ($oldCart) {

            $endQuantity = $oldCart->quantity + $newQuantity;

            $oldCart->update([
                'name' => $product->name,
                'quantity' => $endQuantity > 20 ? 20 : $endQuantity,
                'img' => $product->img,
                'slug' => $product->slug,
                'min_price' => $endPrice,
                'price' => $endPrice * $endQuantity,
                'size_name' => $size ? $size->name : null,
                'color_name' => $color ? $color->name : null,
                'color_img' => $color ? $color->img : null,
            ]);

        }
        else{

            Cart::create([

                'name' => $product->name,
                'quantity' => $newQuantity,
                'img' => $product->img,
                'slug' => $product->slug,
                'min_price' => $endPrice,
                'price' => $endPrice,
                'size_name' => $size ? $size->name : null,
                'color_name' => $color ? $color->name : null,
                'color_img' => $color ? $color->img : null,
                'product_id' => $product->id,
                'guest_ip' => $ip,
            ]);
        }
    }


    public function sizeRequest($sizesOfThisProducts){

        $size = null;

        if($sizesOfThisProducts->count() > 0) {

            if (\request('size')):

                $size = $sizesOfThisProducts->where('size_id', \request('size'))->first();

            endif;

            $size = $this->checkIsNotErrorInAttr($size ,  $sizesOfThisProducts); // check is not hake

        } // end if sizes  > 0

        return $size;
    }

    private function colorRequest($colorsOfThisProducts){

        $color = null;

        if($colorsOfThisProducts->count() > 0) {

            if (\request('color')):

                $color = $colorsOfThisProducts->where('color_id', \request('color'))->first();

            endif;

            $color = $this->checkIsNotErrorInAttr($color ,  $colorsOfThisProducts); // check is not hake

        } // end if colors  > 0

        return $color;
    }

    private function checkIsNotErrorInAttr($attr , $attrsOfThisProducts){


        if (!$attr): // if not found Color get first color of this product

            return $attrsOfThisProducts->first();

        endif;

        return $attr;
    }


}
