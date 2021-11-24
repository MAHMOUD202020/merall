<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta  http-equiv="content-type" content="text/html; charset=UTF8">

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Merall</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>

    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <style>
        *{
            font-family: Arial;
            word-wrap:normal !important;
        }
        body {
            background-color: #efefef;
            margin-bottom: 0px !important;
        }

        .cover-content , .invoice , .logo  , .data , .card{
            background-image: linear-gradient(to right, #f2e2e0, #e5dad9);
        }

        .logo {

            text-align: center !important;
        }

        .logo img{
            width: 200px;
            /*position: relative;*/
            /*right: -72px;*/
        }

        .data-content{

            color: #9e1d22;

            font-weight: bold;
        }
        .card {
            border: none;
            padding: 0 22px;
        }

        .thead{
            background-color: #9e1d22;
            color: #d59f28;
        }

        table tbody tr{
            border-bottom: 1px solid #b25154;
        }

        .totals tr td {
            font-size: 13px
        }

        .footer{
            position: relative;
            display: block;
            background-image: url("/assets/web/images/footer.png");
            height: 218px;
            padding-top: 24px;
            padding-right: 20px;
            background-size: 100% 100%;
        }

        .footer-title{
            background-color: #dca726;
            width: 150px;
            text-align: center;
            border-radius: 7px;
            border: 1px solid #d5ad33;
            color: #9e1d22;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .img-footer {

            width: 323px;
            position: absolute;
            left: 0;
            bottom: 0;
        }



        .product-qty span {
            font-size: 12px;
            color: #dedbdb
        }


        @media print {

            body{
                background-image: linear-gradient(to right, #f2e2e0, #e5dad9);
            }

        }


        .data-content{

            color: #9e1d22;

            font-weight: bold;
        }
        .card {
            border: none
        }

        table thead{
            background-color: #9e1d22;
            color: #d59f28;
        }

        table tbody tr{
            border-bottom: 1px solid #b25154;
        }

        .totals tr td {
            font-size: 13px
        }

        .img-footer {

            width: 323px;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        /*.footer span {*/
        /*    font-size: 12px*/
        /*}*/

        .product-qty span {
            font-size: 12px;
            color: #dedbdb
        }

        .str-left{
            text-align: center;
            position: relative;
            left: -48px;
        }

        .str-right{
            text-align: center;
            position: relative;
            right: -45px;
        }

        .table>:not(caption)>*>* {
            padding: 3px 3px !important;
        }
        p {
            margin-top: 0;
            margin-bottom: 5px;
        }
    </style>

</head>
<body class='snippet-body'>
<div class="container" style="direction: rtl">
    <div class="row d-flex justify-content-center cover-content">
        <div class="col-md-8 print-cover">
            <div class="card">
                <div class="text-left logo p-3 px-10"> <img src="{{asset('assets/web/images/logo.png')}}" width="150"> </div>

                <div class="data">
                    <div class="counter">
                        <div class="row">
                            <div class="col-6 str-right">
                                <p>رقم الطلب: <span class="data-content">#{{$order->id}}</span> </p>
                                <p>الدفع: <span class="data-content">{{str_replace('الدفع', ' ' , $order->payment)}}</span></p>
                                <p> التاريخ: <span class="data-content">{{$order->created_at->format("Y-m-d")}}</span></p>
                            </div>
                            <div class="col-6 str-left">
                                <p> <span class="data-content">حي المنصورة - الرياض </span></p>
                                <p><span class="data-content"> المملكة العربية السعودية</span> </p>
                                <p>  الرقم الضريبي: <span class="data-content">300399482100003 </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice ">

                    <table class="table">
                        <tr class="thead">
                            <th>المنتج</th>
                            <th>المقاس</th>
                            <th>اللون</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th style="white-space: nowrap">اجمالي السعر</th>
                            <th>الصورة</th>
                        </tr>
                        <tbody>

                        @foreach($order->orderCarts as $product)
                            <tr>
                                <td>{{substr(trim($product->name) , 0 , 85)}}</td>
                                <td>{{$product->size_name ? $product->size_name : 'لا يوجد'}}</td>
                                <td>
                                    @if ($product->color_name)
                                        <img  class="border-img" src="{{asset("assets/web/images/colors/min/$product->color_img")}}" alt="{{$product->color_name}}" width="30" height="30"> - {{$product->color_name}}
                                    @else
                                        لا يوجد
                                    @endif
                                </td>
                                <td>{{$product->price}} ريال</td>
                                <td>{{$product->count}} منتج</td>
                                <td>{{$product->total}} ريال</td>
                                <td><img width="30" height="30" src="{{asset("assets/web/images/products/min/small_$product->img")}}" alt=""></td>
                            </tr>
                        @endforeach
                        @php($tax = round(($order->price * 15)/100  , 2))
                        <tr>
                            <td colspan="3"><strong>اجمالي المنتجات</strong></td>
                            <td colspan="2"><strong>{{$order->price - $tax}} ريال </strong></td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>اجمالي الضريبة (15%)</strong></td>
                            <td colspan="2"><strong>{{$tax}} ريال </strong></td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>خصم</strong></td>
                            <td colspan="2"><strong>{{$order->coupon_discount}} ريال </strong></td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>صافي المنتجات</strong></td>
                            <td colspan="2"><strong>{{round($order->price - $order->coupon_discount , 2)}} ريال </strong></td>
                        </tr>

                        <tr>
                            <td colspan="3"><strong>سعر الشحن</strong></td>
                            <td colspan="2">
                                @if($order->country_id == 2)
                                    <span class="d-block" style="font-size: 14px">
                                            @lang('customString.otherShippingCountryBill')
                                    </span>
                                @else
                                    <strong>{{$order->shipping_price}} ريال </strong>
                                    <span class="text-info">
                                        {{$order->shipping_price > 0 ? '' : 'شحن مجاني'}}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>اجمالي الطلب</strong></td>
                            <td colspan="2"><strong>{{$order->total}} ريال </strong></td>
                        </tr>

                        </tbody>
                    </table>


                    <diiv class="footer">
                        {{--                        <img src="{{asset('assets/web/images/footer.png')}}" alt="" class="img-footer">--}}
                        <span class="d-block footer-title">بيانات الشحن</span>
                        <p>الاسم: <span class="data-content">{{$order->name}}</span> </p>
                        <p>العنوان: <span class="data-content">{{$order->address}}</span> </p>
                        <p>رقم الهاتف: <span class="data-content">{{$order->phone}}</span> </p>
                        <p>البريد الالكتروني: <span class="data-content">{{$order->email}}</span> </p>

                        <p>{{strlen($order->not) > 0 ? $order->not : "لاتوجد اي ملاحظات متعلقة بالطلب او الشحن"}}</p>
                    </diiv>
                </div>
            </div>
        </div>
    </div>
    <p class="mt-2">
        شكركم على ثقتكم بنا و نسعى جاهدين على ان نكون دوما  عند حسن ظنكم <span class="d-block"></span>موقع ميرال هو موقع يختص في كل ما يتعلق بالجمال والمرأة و منتجات و أدوات التجميل و العناية بالشعر والبشرة والجسم و يحتوي على افضل الماركات العالمية المشهورة اضافة الى تميزنا بوجود خبراء تجميل لأي استشارة ومصممات ازياء سعوديات ومنتجات أصلية مئة بالمئة
    </p>
</div>

{{--<div id="canvas-export"></div>--}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
{{--<!--<script src="{{asset('assets/admin/js/html2canvas.min.js')}}"></script>-->--}}
{{--<!--<script src="{{asset('assets/admin/js/canvas2image.js')}}"></script>-->--}}

<script !src="">
    $(function (){




        // function screenshot(){
        //     html2canvas($('.print-cover')[0]).then(function(canvas) {
        //         $('#canvas-export')[0].appendChild(canvas)

        //     });

        // }

        // screenshot()


        print()

        // setTimeout(function (){

        //     Canvas2Image.saveAsPNG(document.getElementsByTagName('canvas')[0])

        // }, 1000)

    })


</script>


</body>
</html>
