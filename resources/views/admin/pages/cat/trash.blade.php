@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.cat.index')}}">الفئات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة فئه جديد' => route('admin.cat.create'),
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

        let section_id = '@json($sections)';
        myDataTableColumns({
            name:  ['id', 'name', 'slug', 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            select: {section_id},
            alias: {section_id:@json($sections)},
            btn :  {
                'edit': '{{url('admin/cat/{id}')}}',
                'restore': '{{url('admin/trash/cat/{id}')}}',
                'delete': '{{url('admin/trash/cat/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
