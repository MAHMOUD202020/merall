<?php

if (!function_exists('myDataTable_query')){

    function myDataTable_query($model , $pathView  , $softDelete = false  , $data = []){


        $withRelationship = array_key_exists('with-RS' , $data) ? $data['with-RS'] : [];
        $withCount = array_key_exists('with-count' , $data) ? $data['with-count'] : [];
        $sendDataWithView = array_key_exists('with-view' , $data) ? $data['with-view'] : [];
        $columnsGet       = array_key_exists('columns' , $data) ? $data['columns'] : '*';
        $startCount       = array_key_exists('count' , $data) ? $data['count'] : 10;
        $orderByType      = array_key_exists('orderBy-type' , $data) ? $data['orderBy-type'] : 'desc';
        $orderColumn      = array_key_exists('orderBy-column' , $data) ? $data['orderBy-column'] : 'id';
        $typeWhere        = array_key_exists('typeWhere' , $data) ? $data['typeWhere'] : ['where' , 'id' , '>' , 0];

        $modelDB = $model;

        if ($typeWhere[0] == 'whereIn'){ // create query where

            $WhereName = $typeWhere[0];
            unset($typeWhere[0]);

        }else{

            $WhereName = $typeWhere[0];
            unset($typeWhere[0]);
        }


        $filter = request('filter');
        if (is_array($filter)) {

            $whereName = $filter[0];
            unset($filter[0]);
            $typeWhere = $filter;
        }

        if (\request()->ajax() && \request()->has('myDataTableAjax')) {

            if (request('search') == null):

                $modelDB = $softDelete == false
                    ? $modelDB::with($withRelationship)
                        ->withCount($withCount)
                        ->$WhereName(...$typeWhere)
                        ->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ) )
                        ->orderby( 'id'  , 'desc' )
                    : $modelDB::with($withRelationship)
                        ->withCount($withCount)
                        ->onlyTrashed()
                        ->$WhereName(...$typeWhere)
                        ->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ) )
                        ->orderby( 'id'  , 'desc' );

                $dataTable = $modelDB->paginate( \request( 'count' )  , $columnsGet);

            else:

                $modelDB = $softDelete == false
                    ? $modelDB::with($withRelationship)
                        ->withCount($withCount)
                        ->$WhereName(...$typeWhere)
                        ->where( \request( 'searchColumn' ) , "LIKE" , "%" . \request( 'search' ) . "%" )
                    :  $modelDB::with($withRelationship)
                        ->withCount($withCount)
                        ->onlyTrashed()
                        ->$WhereName(...$typeWhere)
                        ->where( \request( 'searchColumn' ) , "LIKE" , "%" . \request( 'search' ) . "%" );
                $dataTable = $modelDB->orderby( \request( 'orderColumn' ) , \request( 'orderBy' ) )->orderby( 'id'  , 'desc' )
                    ->paginate( \request( 'count' ) , $columnsGet );

            endif;


            $btn = $dataTable->links()->render();
            return response(['dataDB' => $dataTable, 'btn' => $btn]);
        }



        session()->flash('data-session' , ['count' => $startCount ,'orderBy' => $orderByType , 'orderColumn' => $orderColumn]);

        return view($pathView)->with($sendDataWithView);

    }
}
