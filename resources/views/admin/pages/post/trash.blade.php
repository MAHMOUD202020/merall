@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.post.index')}}">المقالات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة مقالة جديد' => route('admin.post.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "title"      => 'عنوان المقالة الرئيسي',
        "slug"       => 'slug',
        "img"        => 'الصورة',
        "catBlog_id" => 'التصنيف',
        "visits"     => 'عدد المشاهدات',
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
            name:  ['id' , 'title' , 'slug' , 'img' , 'catBlog_id' ,'visits' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'img':'notExport'},
            file:{'img':'image->{{asset('assets/web/images/posts/min/small_{img}')}}'},
            btn :  {
                'edit': '{{url('admin/post/{id}')}}',
                'restore': '{{url('admin/trash/post/{id}')}}',
                'delete': '{{url('admin/trash/post/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
