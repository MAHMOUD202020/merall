<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TapNewRequest;
use App\Models\TapNew;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    use methodAction;

    public function index()
    {

        return myDataTable_query(
            TapNew::class ,
            'admin.pages.tabNew.index');
    }


    public function create()
    {


        return  view('admin.pages.tabNew.create');
    }


    public function store(TapNewRequest $request)
    {
        TapNew::create([
            'value' => $request->value,
            'link' => $request->link,
            'type' => $request->type,
        ]);



        return  back()->with('success' , 'تم اضافة الخبر بنجاح');
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
    public function update(TapNewRequest $request, $id)
    {

        $tabNew = TapNew::findOrFail($id);

        $tabNew->update([
            'value' => $request->value,
            'link' => $request->link,
            'type' => $request->type,
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل الخبر بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(TapNew::class , $id);
    }

}
