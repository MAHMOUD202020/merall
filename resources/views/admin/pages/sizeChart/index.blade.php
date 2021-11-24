@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>جداول المقاسات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة جدول مقاسات جديد' => route('admin.sizeChart.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "img"        => 'الصورة',
        "updated_at" => "اخر تعديل",
        "created_at" => "تاريخ الاضافة",
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>


        myDataTableColumns({
            name:  ['id', 'name', 'img'  , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'img':'notExport'},
            file:{'img':'image->{{asset('assets/web/images/sizeCharts/min/small_{img}')}}'},
            btn :  {
                'edit': '{{url('admin/sizeChart/{id}')}}',
                'delete': '{{url('admin/sizeChart/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
