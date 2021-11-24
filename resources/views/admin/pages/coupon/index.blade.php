@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>قسائم الشراء</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة قسيمة جديده' => route('admin.coupon.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"           => 'id',
        "name"         => 'الاسم',
        "status"       => 'الحالة',
        "end_at"       => 'تاريخ الانتهاء',
        "serial"       => 'السريال',
        "type"         => 'نوع الخصم',
        "discount"     => 'قيمة الخصم',
        "min_price"    => 'اقل مبلغ للاوردر',
        "limit"        => 'اقصي عدد للاستخدام',
        "use"          => 'عدد مرات الاستخدام حتي الان',
        "limit_user"   => 'اقصي ْحد للمستخدم الواحد',
        "updated_at"   => "اخر تعديل",
        "created_at"   => "تاريخ الاضافة",
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let status = '@json([ '0' => 'غير متاحة للاستخدام' , '1' => 'متاحة للاستخدام'  ])';
        let type   = '@json([ '0' => 'نسبة مئوية' , '1' => 'خصم مالي'  ])';

        myDataTableColumns({
            name:  ['id', 'name', 'status', 'end_at', 'serial',  'type', 'discount', 'min_price', 'limit', 'use', 'limit_user', 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'serial':'notEdit' , 'use':'notEdit'},
            select: {status , type},
            alias: {status , type},
            date:{'end_at':'date'},
            btn :  {
                'edit': '{{url('admin/coupon/{id}')}}',
                'delete': '{{url('admin/coupon/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
