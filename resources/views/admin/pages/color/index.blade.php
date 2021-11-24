@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>الالوان</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة لون جديد' => route('admin.color.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "slug"       => 'slug',
        "img"        => 'الصورة',
        "alt"        => 'alt text',
        "custom"     => 'نوع اللون',
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

        let custom = '@json(['1'=>'مخصص' , '0' =>'عام'])';

        myDataTableColumns({
            name:  ['id', 'name', 'slug', 'img'  , 'alt'  , 'custom' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'img':'notExport'},
            file:{'img':'image->{{asset('assets/web/images/colors/min/small_{img}')}}'},
            alias: {custom},
            btn :  {
                'edit': '{{url('admin/color/{id}')}}',
                'delete': '{{url('admin/color/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
