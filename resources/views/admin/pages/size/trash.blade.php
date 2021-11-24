@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.size.index')}}">المقاسات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة مقاس جديد' => route('admin.size.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "sort"       => 'الترتيب',
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        myDataTableColumns({
            name:  ['id', 'name', 'sort'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            btn :  {
                'edit': '{{url('admin/size/{id}')}}',
                'restore': '{{url('admin/trash/size/{id}')}}',
                'delete': '{{url('admin/trash/size/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
