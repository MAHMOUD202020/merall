@php($title_page      = 'الصفحة الرئيسية')
@php($title_seo       = 'الصفحة الرئيسية')

@extends('web.master')

@section('content')

    @include('web.pages.home.slider')
{{--    @include('web.pages.home.banners')--}}
    @include('web.pages.home.new_product')
    @include('web.inc.banners')
    @include('web.pages.home.premium_product')
    <div class="container">
        <div class="row">
            <div class="col-12" style="max-height: 400px">
                <a href="#" class="pt-promo-box">
                    <div class="image-box">
                        <img src="{{asset('assets/web/images/banners/custome.jpg')}}" alt="banner">
                    </div>
                    <div class="pt-description pr-promo-type2 pt-point-h-l">
                    </div>
                </a>
            </div>
        </div>
    </div>

    @include('web.pages.home.Offers_product')

    <div class="container">
        <div class="row">
            <div class="col-12" style="max-height: 400px; overflow: hidden; margin-bottom: 25px">
                <a href="#" class="pt-promo-box">
                    <div class="image-box">
                        <img src="{{asset('assets/web/images/banners/custom2.png')}}" alt="banner">
                    </div>
                    <div class="pt-description pr-promo-type2 pt-point-h-l">
                    </div>
                </a>
            </div>
        </div>
    </div>

    @include('web.inc.customer-opinion')
    @include('web.layouts.banner_pop_up')

@endsection


@section('css')
    <style>

        .card-body{
            direction: rtl;
        }
        .btn-like.active .pt-icon{
            color: #dc3545;
        }

        .testimonial1 {
            font-family: "Montserrat", sans-serif;
            color: #8d97ad;
            font-weight: 300;
        }

        .testimonial1 h1,
        .testimonial1 h2,
        .testimonial1 h3,
        .testimonial1 h4,
        .testimonial1 h5,
        .testimonial1 h6 {
            color: #3e4555;
        }

        .testimonial1 .bg-light {
            background-color: #f4f8fa !important;
        }

        .testimonial1 .subtitle {
            color: #8d97ad;
            line-height: 24px;
        }

        .testimonial1 .testi1 .card-body {
            padding: 35px;
        }

        .testimonial1 .testi1 .thumb {
            padding: 10px 20px 10px;
            padding-left: 90px;
            margin-left: -35px;
        }

        .testimonial1 .testi1 .thumb .thumb-img {
            width: 60px;
            left: 20px;
            top: -10px;
        }

        .testimonial1 .testi1 h5 {
            line-height: 30px;
            font-size: 18px;
        }

        .testimonial1 .testi1 .devider {
            height: 1px;
            background: rgba(120, 130, 140, 0.13);
            width: 100px;
        }

        .testimonial1 .bg-success-gradiant {
            background: #FFC0CB;
            background: -webkit-linear-gradient(legacy-direction(to right), #C12267  0%, #C12267 100%);
            background: -webkit-gradient(linear, left top, right top, from(#C12267), to(#C12267));
            background: -webkit-linear-gradient(left, #C12267  0%, #C12267 100%);
            background: -o-linear-gradient(left, #C12267  0%, #C12267 100%);
            background: linear-gradient(to right, #C12267  0%, #C12267 100%);
        }

        .testimonial1 .card.card-shadow {
            -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
            box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
        }

        .testimonial1 .owl-theme .owl-dots .owl-dot.active span,
        .testimonial1 .owl-theme .owl-dots .owl-dot:hover span {
            background: #316ce8;
        }

        .item h5{
            font-weight: bold !important;
        }

        .text-white{
            color: white !important;
        }
    </style>
    {{--    <link rel="stylesheet" href="{{asset('assets/web/css/owl.carousel.min.css')}}">--}}
@endsection
