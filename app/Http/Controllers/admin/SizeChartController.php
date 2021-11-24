<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SizeChart;
use App\myDataTable\methodAction;
use App\myDataTable\uploadImag;
use App\Http\Requests\SizeChartRequest;

class SizeChartController extends Controller
{
    use uploadImag;
    use methodAction;

    public $path_img = "assets/web/images/sizeCharts";


    public function index()
    {
        return myDataTable_query(
            sizeChart::class ,
            'admin.pages.sizeChart.index',
            false);
    }


    public function create()
    {

        return  view('admin.pages.sizeChart.create');

    }

    public function store(SizeChartRequest $request)
    {
        $img = $this->MDT_saveImage($request->file('img'), 'meral_'.rand(10000 , 1000000));

        sizeChart::create([
            'name' => $request->name,
            'img' => $img,
        ]);

        return  back()->with('success' , 'تم اضافة جدول المقاسات بنجاح');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(SizeChartRequest $request, $id)
    {
        $sizeChart = SizeChart::findOrFail($id);

        $img = $sizeChart->img;

        if ($request->has('img')) {

            $this->MDT_deleteImage(false , $img);

            $img = $this->MDT_saveImage($request->file('img') , 'meral_'.rand(10000 , 1000000));
        }

        $sizeChart->update([
            'name' => $request->name,
            'img' => $img,
        ]);


        return response([
            'status' => 'success' ,
            'message' => 'تم تعديل جدول المقاسات بنجاح' ,
            'url' => ['img' => asset("$this->path_img/min/small_$sizeChart->img")]
        ]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(SizeChart::class , $id);
    }

    public function trash()
    {

        return myDataTable_query(

            SizeChart::class ,
            'admin.pages.sizeChart.trash',
            true
        );
    }

    public function restore($id)
    {

        return $this->MDT_restore(SizeChart::class , $id);
    }

    public function finalDelete($id)
    {

        return $this->MDT_finalDelete(SizeChart::class , $id , "$this->path_img/min" , 'img');
    }
}
