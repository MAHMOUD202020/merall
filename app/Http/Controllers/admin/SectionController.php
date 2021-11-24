<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\myDataTable\methodAction;

class SectionController extends Controller
{

    use methodAction;

    public function index()
    {
        return myDataTable_query(
            Section::class ,
            'admin.pages.section.index'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.section.create');
    }


    public function store(SectionRequest $request)
    {
        Section::create([

            'name' => $request->name,
            'slug' => $request->slug,

        ]);

        return  back()->with('success' , 'تم اضافة القسم بنجاح');
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
    public function update(SectionRequest $request, $id)
    {

        $section = Section::withTrashed()->findOrFail($id);

        $section->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل القسم بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Section::class , $id);
    }

    public function trash()
    {
        return myDataTable_query(
            Section::class ,
            'admin.pages.section.trash',
            true
        );
    }

    public function restore($id)
    {

        return $this->MDT_restore(Section::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Section::class , $id);
    }
}
