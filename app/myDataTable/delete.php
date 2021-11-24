<?php

use App\Models\Section;

if (!function_exists('myDataTable_delete')){

    function myDataTable_delete($model , $id){

        if ( !\request()->has( 'tdSelected' ) ) { // is Delete one row

            $row = $model::findOrFail($id);

            $row->delete();

            return response( [ 'status' => 'success' , 'message' => 'تم الحذف بنجاح' ] );

        }else{  // is Delete multi row


            $model::whereIn('id' , \request('tdSelected'))->firstOrFail();

            $model::destroy(\request('tdSelected'));

            return response( [ 'status' => 'success' , 'message' => 'تم حذف العناصر المحدة بنجاح' ] );

        }
    }
}
