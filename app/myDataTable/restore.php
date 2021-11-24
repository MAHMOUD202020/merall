<?php

use App\Models\Section;

if (!function_exists('myDataTable_restore')){

    function myDataTable_restore($model , $id){

        if ( !\request()->has( 'tdSelected' ) ) { // is restore one row


            $row = $model::onlyTrashed()->findOrFail($id);

            $row->restore();

            return response( [ 'status' => 'success' , 'message' => 'تم الاسترجاع بنجاح' ] );


        }else { // is restore multi row


            $row = $model::onlyTrashed()->whereIn('id' , request('tdSelected'));

            if($row->count() > 0){

                $row->restore();

            }else{

                abort(404);
            }

            return response( [ 'status' => 'success' , 'message' => 'تم استرجاع العناصر المحددة بنجاح' ] );


        }
    }
}
