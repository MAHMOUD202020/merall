@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>المقالات</span></li>
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

        let catBlog_id = '@json($cats->all())';

        myDataTableColumns({
            name:  ['id' , 'title' , 'slug' , 'img' , 'catBlog_id' ,'visits' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'img':'notExport'},
            select: {catBlog_id},
            alias: {catBlog_id},
            file:{'img':'image->{{asset('assets/web/images/posts/min/small_{img}')}}'},
            btn :  {
                'edit': '{{url('admin/post/{id}')}}',
                'show': '{{url('admin/post/{id}')}}',
                'open': ['{{url('blog/post/{slug}')}}' , 'فتح الرابط'],
                'delete': '{{url('admin/post/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
