@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>اختيار المسئول</span></li>
@endsection
@section('content')



    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button() !!}


        {!! myDataTable_table([
            "id"          => 'id',
            "name"        => 'الاسم',
            "email"        => 'الاسم',
            "phone"       => 'رقم الهاتف',
        ] , 4, true , false) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>
        .td_id{

            right:0;
        }
    </style>
@endsection

@section('js')

    <script src="{{asset("assets/myDataTable/data.js")}}"></script>

    <script>
        myDataTableColumns({
            name : ['id', 'name' , 'email' , 'phone'],
            tdOne:'none',
            btn : {
                'roles': ['{{url('admin/roles/{id}')}}'  , 'توزيع الصلاحيات'],
            }
        })
    </script>
@endsection
