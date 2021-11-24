<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatRequest;
use App\Models\Cat;
use App\Models\Section;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class CatController extends Controller
{

    use methodAction;

    public function index()
    {
        $sections  = Section::latest()->get(['name' , 'id']);

        return myDataTable_query(
            Cat::class ,
            'admin.pages.cat.index',
            false,
            [
                'with-view' => ['sections' => $sections->pluck('name' , 'id' )]
            ]);
    }


    public function create()
    {

        $sections  = Section::latest()->get(['name' , 'id']);

        return  view('admin.pages.cat.create')->with('sections' , $sections);
    }


    public function store(CatRequest $request)
    {
        Cat::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'section_id' => $request->section_id,
        ]);



        return  back()->with('success' , 'تم اضافة الفئة بنجاح');
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
    public function update(CatRequest $request, $id)
    {

        $cat = Cat::withTrashed()->findOrFail($id);

        $cat->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'section_id' => $request->section_id,
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل الفئة بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Cat::class , $id);
    }

    public function trash()
    {
        $sections  = Section::latest()->get(['name' , 'id']);

        return myDataTable_query(
            Cat::class ,
            'admin.pages.cat.trash',
            true,
            [
                'with-view' => ['sections' => $sections->pluck('name' , 'id' )]
            ]);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Cat::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Cat::class , $id);
    }
}
