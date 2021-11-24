<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\Size;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    use methodAction;

    public function index()
    {
        return myDataTable_query(
            size::class ,
            'admin.pages.size.index',
            false);
    }


    public function create()
    {

        return  view('admin.pages.size.create');

    }

    public function store(SizeRequest $request)
    {

        size::create([
            'name' => $request->name,
            'sort' => $request->sort,
        ]);

        return  back()->with('success' , 'تم اضافة المقاس بنجاح');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(SizeRequest $request, $id)
    {
        $size = Size::findOrFail($id);

        $size->update([
            'name' => $request->name,
            'sort' => $request->sort,
        ]);


        return response([
            'status' => 'success' ,
            'message' => 'تم تعديل المقاس بنجاح' ,
        ]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(Size::class , $id);
    }

    public function trash()
    {

        return myDataTable_query(

            Size::class ,
            'admin.pages.size.trash',
            true
        );
    }

    public function restore($id)
    {

        return $this->MDT_restore(Size::class , $id);
    }

    public function finalDelete($id)
    {

        return $this->MDT_finalDelete(Size::class , $id);
    }
}
