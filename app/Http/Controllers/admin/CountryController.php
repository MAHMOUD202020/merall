<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    use methodAction;

    public function index()
    {

        return myDataTable_query(
            Country::class ,
            'admin.pages.country.index',
            false
          );
    }


    public function create()
    {

        $country  = Country::latest('id')->get(['name' , 'id']);

        return  view('admin.pages.country.create')->with('countries' , $country);
    }


    public function store(CountryRequest $request)
    {
        Country::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);



        return  back()->with('success' , 'تم اضافة الدولة بنجاح');
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
    public function update(CountryRequest $request, $id)
    {

        $country = Country::withTrashed()->findOrFail($id);

        $country->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل الدولة بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Country::class , $id);
    }

    public function trash()
    {

        return myDataTable_query(
            Country::class ,
            'admin.pages.country.trash',
            true,
          );
    }

    public function restore($id)
    {

        return $this->MDT_restore(Country::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Country::class , $id);
    }
}
