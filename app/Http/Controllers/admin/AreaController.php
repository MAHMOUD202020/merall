<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\Country;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    use methodAction;

    public function index()
    {

        $countries = Country::all();
        return myDataTable_query(
            Area::class ,
            'admin.pages.area.index',
            false,
            [
                'with-view' => ['countries' => $countries->pluck('name' , 'id')]
            ]);
    }


    public function create()
    {

        $area  = Country::latest('id')->get(['name' , 'id']);

        return  view('admin.pages.area.create')->with('countries' , $area);
    }


    public function store(AreaRequest $request)
    {
        Area::create([
            'name'           => $request->name,
            'slug'           => $request->slug,
            'shipping_price' => $request->shipping_price,
            'cache'          => $request->cache,
            'country_id'     => $request->country_id,
        ]);



        return  back()->with('success' , 'تم اضافة المدينة بنجاح');
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
    public function update(AreaRequest $request, $id)
    {

        $area = Area::withTrashed()->findOrFail($id);

        $area->update([
            'name'           => $request->name,
            'slug'           => $request->slug,
            'shipping_price' => $request->shipping_price,
            'cache'          => $request->cache,
            'country_id'     => $request->country_id,
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل المدينة بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Area::class , $id);
    }

    public function trash()
    {

        $countries = Country::all();
        return myDataTable_query(
            Area::class ,
            'admin.pages.area.index',
            true,
            [

                'with-view' => ['countries' => $countries->pluck('name' , 'id')]
            ]);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Area::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Area::class , $id);
    }
}
