@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.section.index')}}">الاقسام</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة قسم جديد' => route('admin.section.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "slug"       => 'slug',
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
            name:  ['id', 'name', 'slug', 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            btn :  {
                'edit': '{{url('admin/section/{id}')}}',
                'restore': '{{url('admin/trash/section/{id}')}}',
                'delete': '{{url('admin/trash/section/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
