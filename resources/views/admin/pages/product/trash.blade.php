@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">المنتجت</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة منتج جديد' => route('admin.product.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"       => 'الاسم',
        "slug"       => 'slug',
        "img"        => 'الصورة',
        "price"      => 'السعر',
        "discount"   => 'الخصم',
        "premium"    => 'نوع المنتج',
        "available"  => 'حالة المنتج',
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

        let available = '@json(['1'=>'متاح في المخزن' , '0' =>'غير متاح في المخزن'])';
        let premium   = '@json(['0'=>'منتج عادي' , '1' =>'منتج مميز'])';

        myDataTableColumns({

            name:  ['id', 'name', 'slug', 'img', 'price', 'discount', 'available', 'premium'  , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'img':'notExport'},
            file:{'img':'image->{{asset('assets/web/images/products/min/small_{img}')}}'},
            select: {available , premium},
            alias: {available , premium},
            btn :  {
                'edit': '{{url('admin/product/{id}')}}',
                'restore': '{{url('admin/trash/product/{id}')}}',
                'delete': '{{url('admin/trash/product/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
