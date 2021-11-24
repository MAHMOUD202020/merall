@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>الدول</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة دولة جديد' => route('admin.country.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "slug"       => 'slug',
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        myDataTableColumns({
            name:  ['id', 'name', 'slug'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            btn :  {
                'edit': '{{url('admin/country/{id}')}}',
                'delete': '{{url('admin/country/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
