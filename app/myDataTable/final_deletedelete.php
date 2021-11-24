<?php

use App\Models\Section;

if (!function_exists('myDataTable_finalDelete')){

    function myDataTable_finalDelete($model , $id , $path = '' , $img = false){

        if ( !\request()->has( 'tdSelected' ) ) { // is restore one row


            $row = $model::onlyTrashed()->findOrFail($id);


            $row->forceDelete();


            if ($img !== false) {

                \Illuminate\Support\Facades\File::delete($path.$row->$img);
                \Illuminate\Support\Facades\File::delete($path.'small_'.$row->$img);
                \Illuminate\Support\Facades\File::delete($path.'medium_'.$row->$img);
            }

            return response( [ 'status' => 'success' , 'message' => 'تم الحذف  بشكل نهائي' ] );


        }else { // is restore multi row


            $rows = $model::onlyTrashed()->whereIn('id' , request('tdSelected'));

            if ($rows->count() > 0) {

                if ($img !== false) {

                    $rowsClone = $rows->clone();

                    foreach ($rowsClone->get() as $row) {

                        \Illuminate\Support\Facades\File::delete($path . $row->$img);
                        \Illuminate\Support\Facades\File::delete($path . 'small_' . $row->$img);
                        \Illuminate\Support\Facades\File::delete($path . 'medium_' . $row->$img);
                    }

                }

                $rows->forceDelete();

            }else{

                abort(404);
            }

            return response( [ 'status' => 'success' , 'message' => 'تم حذف  العناصر المحددة  بشكل نهائي' ] );


        }
    }

}
