<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatBlogRequest;
use App\Models\CatBlog;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class CatBlogController extends Controller
{
    use methodAction;

    public function index()
    {
        return myDataTable_query(
            CatBlog::class ,
            'admin.pages.catBlog.index',
            false);
    }


    public function create()
    {

        return  view('admin.pages.catBlog.create');
    }


    public function store(CatBlogRequest $request)
    {
        CatBlog::create([
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
    public function update(CatBlogRequest $request, $id)
    {

        $catBlog = CatBlog::withTrashed()->findOrFail($id);

        $catBlog->update([
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
        return $this->MDT_delete(CatBlog::class , $id);
    }

    public function trash()
    {

        return myDataTable_query(
            CatBlog::class ,
            'admin.pages.catBlog.trash',
            true);
    }

    public function restore($id)
    {

        return $this->MDT_restore(CatBlog::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(CatBlog::class , $id);
    }
}
