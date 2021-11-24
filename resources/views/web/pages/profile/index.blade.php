@php($title_page      = 'الملف الشخصي')
@php($title_seo       = 'الملف الشخصي')

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>الملف الشخصي</li>
@endsection
@section('content')
    <div class="container-indent">
        @if (session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="container">
            <h1 class="pt-title-subpages noborder">الملف الشخصي</h1>
            <div class="pt-account-layout">
                <h2 class="pt-title-page">بيانات الحساب</h2>
                <div class="pt-wrapper">
                    <h3 class="pt-title">سجل الطلبات</h3>
                    @if($orders->count() > 0)
                        <div class="alert alert-info">يمكنك حذف الطلبات التي ما زالت في المراجعة فقط</div>
                    @endif
                    <div class="pt-table-responsive table-order">
                        <table class="pt-table-shop-01">
                            <thead>
                            <tr>
                                <th>رقم الطلب</th>
                                <th>التاريخ</th>
                                <th>حالة الطلب</th>
                                <th>عدد المنتجات</th>
                                <th>الاجمالي</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders->all() as $order)
                                <tr>
                                    <td><a href="{{route('profile.deleteOrder' , $order->id)}}">{{$order->id}}</a></td>
                                    <td>{{$order->created_at->format('Y-m-d')}}</td>
                                    <td>{{$order->orderStatus($order->status)}}</td>
                                    <td>{{$order->product_count}}  منتج </td>
                                    <td>{{$order->total}} ريال سعودي</td>
                                    <td>
                                        <a href="{{route('profile.order.show' , $order->id)}}" class="btn btn-info d-block  text-white text-center mb-2" style="line-height: 35px">عرض جميع التفاصيل</a>
                                        @if ($order->status == 0)
                                            <a href="{{route('profile.deleteOrder' , $order->id)}}" class="btn btn-danger text-white d-block " style="line-height: 35px; background-color: #4b0218">حذف الطلب</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if($orders->count() <= 0)
                                <tr>
                                    <td colspan="3">
                                        لا توجد اي طلبات قمت بتنفيذها حتي الان
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center d-block  d-md-none mt-3">
                        <span class="d-block text-sm">لعرض التفاصيل مرر الشاشة الي اليمين واليسار او استخدم الازرار التالية</span>
                        <a class="ml-5 touch-right"><img src="{{asset('assets/web/images/touch-right.svg')}}" alt="" width="60px"></a>
                        <a class="touch-left"><img src="{{asset('assets/web/images/touch-left.svg')}}" alt="" width="60px"></a>
                    </div>
                </div>
                <div class="pt-wrapper">
                    <h3 class="pt-title">البيانات الشخصية</h3>
                    <div class="">
                        <table class="pt-table-shop-02">
                            <tbody>
                            <tr>
                                <td>الاسم:</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>البريد الالكتروني:</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>رقم الهاتف:</td>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <td>الدولة:</td>
                                <td>{{$user->country->name}}</td>
                            </tr>
                            <tr>
                                <td>المحافظة:</td>
                                <td>{{$user->area->name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('profile.edit')}}" class="btn btn-border">تعديل البيانات</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script>

        let tableScroll= $('.table-order')

        $('.touch-left').on('click' , function (e){

            e.preventDefault();

            tableScroll.animate({
                'scrollLeft' : '-=100'
            });
        })

        $('.touch-right').on('click' , function (e){

            e.preventDefault();

            tableScroll.animate({
                'scrollLeft' : '+=100'
            });
        })

    </script>

@endsection
