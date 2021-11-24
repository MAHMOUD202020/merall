@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>شريط الاخبار</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة خبر جديد' => route('admin.news.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "value"      => 'محتوي الخبر',
        "link"       => 'الرابط',
        "type"       => 'نوع الخبر',
        "updated_at" => "اخر تعديل",
        "created_at" => "تاريخ الاضافة",
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>
        td{
            max-width: 400px;
            overflow: auto;
        }
    </style>
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let type = '@json(['0' => 'خبر عادي'  , '1' => 'خبر رئيسي'])';

        myDataTableColumns({
            name:  ['id', 'value' , 'link' ,'type' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            select: {type},
            alias: {type},
            btn :  {
                'edit': '{{url('admin/news/{id}')}}',
                'delete': '{{url('admin/news/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
