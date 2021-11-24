@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>الفئات</span></li>
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
        "section"    => 'القسم التابع إلية',
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
            name:  ['id', 'name', 'slug', 'section_id'  , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            select: {section_id},
            alias: {section_id},
            btn :  {
                'edit': '{{url('admin/cat/{id}')}}',
                'delete': '{{url('admin/cat/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
