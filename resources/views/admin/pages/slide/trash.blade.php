@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.slide.index')}}">شرائح العرض</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')
    {!! myDataTable_button([
        'اضافة شريحة عرض جديد' => route('admin.slide.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"          => 'id',
        "img"         => 'الصوره',
        "description" => 'وصغ الشريحة',
        "link"        => 'الرابط',
        "textLink"    => 'عنوان الرابط',
        "updated_at"  => "اخر تعديل",
        "created_at"  => "تاريخ الاضافة",
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>
        myDataTableColumns({
            name:  ['id', 'img'  , 'description' , 'link', 'textLink' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'img':'notExport'},
            file:{'img':'image->{{asset('assets/web/images/colors/min/small_{img}')}}'},
            btn :  {
                'edit': '{{url('admin/slide/{id}')}}',
                'restore': '{{url('admin/trash/slide/{id}')}}',
                'delete': '{{url('admin/trash/slide/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
