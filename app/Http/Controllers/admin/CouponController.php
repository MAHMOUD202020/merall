<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{

    use methodAction;

    public function __construct()
    {
        $this->middleware('haveRole:coupon.index')->only('index');
        $this->middleware('haveRole:coupon.create')->only(['create' , 'store']);
        $this->middleware('haveRole:coupon.destroy')->only('destroy');

    }

    public function index()
    {

        return myDataTable_query(
            Coupon::class ,
            'admin.pages.coupon.index',
            false,
        );
    }


    public function create()
    {


        return  view('admin.pages.coupon.create');
    }


    public function store(CouponRequest $request)
    {
        Coupon::create([
            'name'        => $request->name,
            'end_at'      => $request->end_at,
//            'serial'      => '00'.rand(101 , 999).strtoupper(Str::random()),
            'serial'      => $request->name,
            'type'        => $request->type,
            'discount'    => $request->discount,
            'min_price'   => $request->min_price,
            'limit'       => $request->limit,
            'limit_user'  => $request->limit_user,
            'admin_id'    => auth()->id(),
        ]);



        return  back()->with('success' , 'تم اضافة القسيمة بنجاح');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {

        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'name'        => $request->name,
            'end_at'      => $request->end_at,
            'status'      => $request->status,
            'type'        => $request->type,
            'discount'    => $request->discount,
            'min_price'   => $request->min_price,
            'limit'       => $request->limit,
            'limit_user'  => $request->limit_user,
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل القسيمة بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Coupon::class , $id);
    }


}
