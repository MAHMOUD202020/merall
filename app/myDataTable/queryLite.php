<?php

if (!function_exists('myDataTableQuery')){

    function myDataTableQueryLite($model , $pathRender , $pathView , $withRelationship = '' ,$softDelete = false , $sendDataWithView = [] , $sendDataWithRender = [] , $columnsGet = '*' , $startCount = 10 , $orderBy = "desc" , $orderColumn = 'id'){

        $modelDB = $model;
        $withRelationship = empty($withRelationship) ? [] : $withRelationship;

        $columnsGet = $columnsGet == false ? $columnsGet ='*' : $columnsGet;

        if (\request()->ajax() && \request()->has('myDataTableAjax')) {

            if (request('search') == null):

                $modelDB = $softDelete == false ? $modelDB::with($withRelationship)->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ) ): $modelDB::with($withRelationship)->onlyTrashed()->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ) );
                $dataTable = $modelDB->paginate( \request( 'count' )  , $columnsGet);

            else:

                $modelDB = $softDelete == false ? $modelDB::with($withRelationship)->where( \request( 'searchColumn' ) , "LIKE" , "%" . \request( 'search' ) . "%" ) :  $modelDB::with($withRelationship)->onlyTrashed()->where( \request( 'searchColumn' ) , "LIKE" , "%" . \request( 'search' ) . "%" );
                $dataTable = $modelDB->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ) )
                ->paginate( \request( 'count' ) , $columnsGet );

            endif;


            $data = view($pathRender, compact('dataTable'))->with($sendDataWithRender)->render();
            $btn = $dataTable->links()->render();

            return response(['data' => $data, 'btn' => $btn]);
        }

        $dataTable = $softDelete === false ? $modelDB::with($withRelationship)->orderby($orderColumn , $orderBy)->paginate($startCount , $columnsGet) :  $modelDB::with($withRelationship)->onlyTrashed()->orderby($orderColumn , $orderBy)->paginate($startCount , $columnsGet);
        $data = view($pathRender, compact('dataTable'))->with($sendDataWithRender)->render();
        $btn = $dataTable->links()->render();
        session()->flash('data-session' , ['count' => $startCount ,'orderBy' => $orderBy , 'orderColumn' => $orderColumn]);

        return view($pathView , compact('data' , 'btn'))->with($sendDataWithView);

    }
}
