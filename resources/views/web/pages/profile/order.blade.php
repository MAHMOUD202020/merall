@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li><a href="{{route('profile.index')}}">الملف الشخصي</a></li>
    <li>تفاصيل الطلب</li>

@endsection
@section('content')
    <div class="container-indent">
        <div class="container">
            <h1 class="pt-title-subpages noborder">الملف الشخصي</h1>
            <div class="pt-account-layout">
                <h2 class="pt-title-page">تفاصيل الطلب رقم #{{$order->id}}</h2>
                <div class="alert alert-success font-weight-bold text-center"
                     style="background-color: #25D366; font-size: 30px; color: white">
                    {{$order->orderStatus($order->status)}}
                </div>
                <div class="pt-wrapper">
                    <a href="{{route('profile.index')}}" class="btn-link btn-lg pt-link-back">
                        <div class="pt-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <use xlink:href="#icon-arrow_large_left"></use>
                            </svg>
                        </div>
                        <span class="pt-text">العودة الي الملف الشخصي</span>
                    </a>
                </div>
                <div class="pt-data">التاريخ : {{$order->created_at}}</div>
                <div class="pt-wrapper">
                    <div class="pt-table-responsive">
                        <table class="pt-table-shop-03">
                            <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>المقاس</th>
                                <th>اللون</th>
                                <th>السعر</th>
                                <th>الضريبة</th>
                                <th>الكمية</th>
                                <th style="white-space: nowrap">اجمالي السعر</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($order->orderCarts as $product)
                                @php($tax = round(($product->price * 15)/100  , 2))
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->size_name ? $product->size_name : 'لا يوجد'}}</td>
                                    <td>
                                        @if ($product->color_name)
                                            <img  class="border-img" src="{{asset("assets/web/images/colors/min/$product->color_img")}}" alt="{{$product->color_name}}" width="30" height="30"> - {{$product->color_name}}
                                        @else
                                            لا يوجد
                                        @endif
                                    </td>
                                    <td>{{$product->price - $tax}} ريال</td>
                                    <td>{{$tax}} ريال</td>
                                    <td>{{$product->count}} منتج</td>
                                    <td>{{$product->total}} ريال</td>
                                </tr>
                            @endforeach
                            @if ($order->orderCarts->count() > 1)
                                <tr>
                                    <td colspan="4"><strong>اجمالي المنتجات</strong></td>
                                    <td><strong>{{$order->price}} ريال </strong></td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="4"><strong>خصم</strong></td>
                                <td><strong>{{$order->coupon_discount}} ريال </strong></td>
                            </tr>
                            @if ($order->coupon_discount > 0)
                                <tr>
                                    <td colspan="4"><strong>صافي المنتجات</strong></td>
                                    <td><strong>{{round($order->price - $order->coupon_discount , 2)}} ريال </strong></td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="4"><strong>سعر الشحن</strong></td>
                                <td>
                                    @if($order->country_id == 2)
                                        <span class="d-block text-danger">
                                            @lang('customString.otherShippingCountryBill')
                                        </span>
                                    @else
                                        <strong>{{$order->shipping_price}} ريال </strong>
                                        <span class="d-block">
                                            {{$order->shipping_price > 0 ? '' : 'شحن مجاني'}}
                                        </span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4"><strong>اجمالي الطلب</strong></td>
                                <td><strong>{{$order->total}} ريال </strong></td>
                            </tr>
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

                    <div class="bg-light p-1 pt-title-page">بيانات الشحن</div>
                    <table class="table-shipping pt-table-03">
                        <thead>
                        <tr>
                            <th scope="col">الدولة:</th>
                            <th scope="col">{{$order->country->name}}</th>
                        </tr>
                        <tr>
                            <th scope="col">المحافظة:</th>
                            <th scope="col">{{$order->area->name}}</th>
                        </tr>
                        <tr>
                            <th scope="col">العنوان:</th>
                            <th scope="col">{{$order->address}}</th>
                        </tr>
                        <tr>
                            <th scope="col">رقم الهاتف:</th>
                            <th scope="col">{{$order->phone}}</th>
                        </tr>
{{--                        <tr>--}}
{{--                            <th scope="col">البريد:</th>--}}
{{--                            <th scope="col">{{$order->email}}</th>--}}
{{--                        </tr>--}}

                        </thead>
                        <tbody>
                    </table>
                    <div class="bg-light p-1 pt-title-page mb-4 mt-4">تفاصيل اخرى</div>
                    <div class="pt-shop-info mb-5">
                        <div class="pt-item">
                            <strong><a>حالة الطلب: {{$order->orderStatus($order->status)}}</a></strong>
                            <strong class="mt-3 d-block"><a>ملاحظات: {{strlen($order->not) > 0 ? $order->not : "لاتوحد اي ملاحظات"}}</a></strong>
                            <nl class="mt-3 d-block"> </nl>
                            <strong><a>نوع الدفع: {{$order->payment}} </a></strong>
                            @if ($order->img_payment)
                                <nl class="mt-3 d-block"> </nl>
                                <strong>الايصال</strong>
                                <img class="img-fluid d-block" style="  max-width:600px ; max-height: 400px" src="{{asset("assets/web/images/payment/$order->img_payment")}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('css')
    <style>
        .table-shipping th {

            color: white;
            padding: 10px;
        }
        .table-shipping tr:nth-child(odd) {
            background-color: #00968875;
        }
        .table-shipping tr:nth-child(even) {
            background-color: #607d8b;
        }

        @media (max-width: 789px) {
            .pt-table-responsive table {
                width: 100% !important;
            }
        }
    </style>
@endsection

@section('js')

    <script>

        let tableScroll= $('.pt-table-responsive')

        $('.touch-left').on('click' , function (e){

            e.preventDefault();

            tableScroll.animate({
                'scrollLeft' : '-=80'
            });
        })

        $('.touch-right').on('click' , function (e){

            e.preventDefault();

            tableScroll.animate({
                'scrollLeft' : '+=80'
            });
        })

    </script>

@endsection
