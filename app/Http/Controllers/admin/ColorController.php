<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\myDataTable\methodAction;
use App\myDataTable\uploadImag;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    use uploadImag;
    use methodAction;

    public $path_img = "assets/web/images/colors";

    public function index()
    {

        return myDataTable_query(
            Color::class ,
            'admin.pages.color.index',
            false,
        [
            'orderBy-column' => 'custom',
            'orderBy-type' => 'asc',
        ]);
    }


    public function create()
    {


        return  view('admin.pages.color.create');
    }


    public function store(ColorRequest $request)
    {

        $img = "none.jpg";

        if ($request->has('img')) {

            $img = $this->MDT_saveImage($request->file('img'), $request->slug);

        }

        $color = Color::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'img' => $img,
            'alt' => $request->alt,
            'custom' => $request->has('custom') ? 1 : 0,
        ]);

        if ($request->ajax()) {

            return  response(['status' => 'success' , 'message' => 'تم اضافة اللون بنجاح' , 'data' => $color]);

        }
        return  back()->with('success' , 'تم اضافة اللون بنجاح');
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
    public function update(ColorRequest $request, $id)
    {


        $color = Color::withTrashed()->findOrFail($id);

        $img = $color->img;

        if ($request->has('img')) {

            $this->MDT_deleteImage(false , $color->img);

            $img = $this->MDT_saveImage($request->file('img'), $request->slug);
        }



        $color->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'img' => $img,
            'alt' => $request->alt,
            'custom' => $request->has('custom') ? 1 : 0,

        ]);


        return response([
            'status' => 'success' ,
            'message' => 'تم تعديل اللون بنجاح' ,
            'url' => ['img' => asset("$this->path_img/min/small_$color->img")]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Color::class , $id);
    }

    public function trash()
    {

        return myDataTable_query(

            Color::class ,
            'admin.pages.color.trash',
            true
        );
    }

    public function restore($id)
    {

        return $this->MDT_restore(Color::class , $id);
    }

    public function finalDelete($id)
    {

        return $this->MDT_finalDelete(Color::class , $id);
    }
}
