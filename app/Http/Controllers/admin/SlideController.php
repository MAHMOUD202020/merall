<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\myDataTable\methodAction;
use App\myDataTable\uploadImag;
use Illuminate\Http\Request;

class SlideController extends Controller
{

    use uploadImag;
    use methodAction;

    public function index()
    {

        return myDataTable_query(
            Slide::class ,
            'admin.pages.slide.index',
            false
        );
    }


    public function create()
    {
        return  view('admin.pages.slide.create');
    }


    public function store(Request $request)
    {
        $img = $request->file('img');
        $imgName = time().'.'.$img->getClientOriginalExtension();

        $img->move(public_path("assets/web/images/slider/slide") , $imgName);

        Slide::create([
            'img' => $imgName,
            'description' => $request->description,
            'link' => $request->link,
            'textLink' => $request->textLink,
        ]);

        return back()->with(['success' => 'تم اضافة الشريحة بنجاح']);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        \File::delete(public_path( "assets/web/images/slider/slide/$slide->img"));

        $slide->delete();

        return response( [ 'status' => 'success' , 'message' => 'تم الحذف بنجاح' ] );

    }
}
