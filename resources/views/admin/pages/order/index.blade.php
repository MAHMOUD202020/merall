@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>الطلبات</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button() !!}

    {!! myDataTable_table([
        "id"              => 'id',
        "print"           => 'الفاتورة',
        "status"          => 'الحالة',
        "product_count"   => 'عدد المنتجات',
        "price"           => 'سعر الطلب',
        "coupon_discount" => 'خصم',
        "coupon_id"       => 'رقم الكوبون',
        "shipping_price"  => 'سعر الشحن',
        "total"           => 'الاجمالي',
        "updated_at"      => "اخر تعديل",
        "created_at"      => "تاريخ الاضافة",
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

        '@php($status = (object) ['0' => 'في انتظار المراجعة'  , '1' => 'تمت الموافقة' , '2' => 'تم التسليم'   , '3' => 'تم استرجاع الطلب' , '4' => 'تم رفض الطلب'])';
        '@php($print = (object) ['0' => 'لم يتم الطباعة'  ,'1' => 'تمت الطباعة'])';

        myDataTableColumns({

            name:  ['id', 'print' , 'status'  , 'product_count' ,'price', 'coupon_discount', 'coupon_id',  'shipping_price' , 'total' , 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            select:{'status':'@json($status)' , 'print':'@json($print)'},
            alias:{'status':'@json($status)' , 'print':'@json($print)'},
{{--            link: {'coupon_id':'{{url('admin/coupon/{coupon_id}')}}'},--}}
            btn :  {
                'edit': '{{url('admin/order/{id}')}}',
                'show': '{{url('admin/order/{id}')}}',
                'invoice': ['{{url('admin/invoice/order/{id}')}}' , 'طباعة فاتورة'],
                'print': '#',
            }
        })
    </script>
@endsection
