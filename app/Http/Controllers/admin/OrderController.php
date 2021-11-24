<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    use methodAction;

    public function index()
    {

        return myDataTable_query(
            Order::class ,
            'admin.pages.order.index');
    }


    public function create()
    {


    }


    public function store(Request $request)
    {




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order =  Order::where('id' , $id)->firstOrFail();

        return view('admin.pages.order.show' , compact('order'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status  = $request->status;
        $order->product_count  = $request->product_count;
        $order->print  = $request->print;
        $order->coupon_discount  = $request->coupon_discount;
        $order->price  = $request->price;
        $order->shipping_price  = $request->shipping_price;
        $order->total  = ($request->price + $request->shipping_price) - $request->coupon_discount;

        $order->save();

        return response(['status' => 'success' , 'message' => 'تم تعديل الطلب بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Order::class , $id);
    }

    public function replaceStatus($status , $order_id)
    {
       Order::where('id' , $order_id)->update([

           'status' => $status
       ]);

        return back()->with('success' , 'تم تعديل الطلب بنجاح');

    }


}
