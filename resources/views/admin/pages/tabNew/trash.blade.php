@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.area.index')}}">المدن</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة مدينة جديد' => route('admin.area.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "slug"       => 'slug',
        "country_id" => 'الدولة',
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

        let country_id = '@json($countries)';

        myDataTableColumns({
            name:  ['id', 'name' , 'slug' ,'country_id' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            select: {country_id},
            alias: {country_id},
            btn :  {
                'edit': '{{url('admin/area/{id}')}}',
                'restore': '{{url('admin/trash/area/{id}')}}',
                'delete': '{{url('admin/trash/area/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
