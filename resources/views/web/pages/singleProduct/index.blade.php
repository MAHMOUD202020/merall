@php($product_id      = $product->id)
@php($title_page      = $product->name)
@php($title_seo       = $product->seo_title)
@php($description_seo = $product->meta_description)
@php($keywords_seo    = $product->keyword_tag)
@php($img_seo         = asset("assets/web/images/products/min/medium_$product->img"))

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>المنتجات</li>
    <li>{{$product->name}}</li>
@endsection

@section('content')


      <div id="pt-pageContent">
        <div class="container-indent pt-offset-md-productsingle">
            <!-- mobile product slider  -->
            @include('web.pages.singleProduct.galleryMobile')
            <!-- /mobile product slider  -->
            <div class="container container-fluid-mobile">
                <div class="row">
                    <div class="col-6 hidden-xs">
                        @include('web.pages.singleProduct.img')
                        @include('web.pages.singleProduct.gallery')
                    </div>
                        @include('web.pages.singleProduct.info')
                </div>
            </div>
        </div>
        <hr>
          <div class="container bg-light" style="padding: 20px; direction: rtl">

              <h4 class="text-center">التعيلقات حول هاذا المنتج</h4>
              @comments(['model' => $product  ,'maxIndentationLevel' => 1  , 'approved' => true ])

          </div>
          <hr>
        <div class="container-indent">
            <div class="container container-fluid-custom-mobile-padding">
                <div class="pt-block-title">
                    <h4 class="pt-title">منتجات قد تعجبك</h4>
                </div>
                <div class="js-init-carousel js-align-arrow row arrow-location-center-02 pt-layout-product-item">
                    @foreach($moro_products as $product)

                        @php($is_new= $product->created_at->addMonth() >= now())
                        @php($is_discount = $product->discount > 0)
                        @php($is_premium = $product->premium == 1)

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="pt-product">
                                <div class="pt-image-box">

                                    @include('web.inc.pr-btn-app')
                                    @include('web.inc.pr-img')
                                    @include('web.inc.pr-label')
                                </div>
                                <div class="pt-description">
                                    <div class="pt-col">
                                        @include('web.inc.pr-cat')
                                        @include('web.inc.pr-name')
                                    </div>
                                    @include('web.inc.pr-price')
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@include('web.inc.customer-opinion')
@include('web.pages.singleProduct.modelAddCart_singlePage')
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
@section('js')
{{--    <script src="{{asset('assets/web/js/owl.carousel.js')}}"></script>--}}
    <script>

        $('.product-color-img').on('click' , function (){

            $('.zoom-product').attr('src' , $(this).attr('data-color-image'))
        })

        let
            coverCart = $('.render-cart'),
            cartProductsCount = $('.cart_products_count');

        $('.btn.btn-lg').on('click' , function (e){

            e.preventDefault();

            $.ajax({
                url:$(this).attr('href'),
                method:'post',
                type:'html',
                data:{'color' : $('.select-color .active a').attr('href') , 'size': $('.select-size .active a').attr('href') , 'quantity': $('#quantity-products').val()},
                success(response){

                    coverCart.html(response.data)

                    cartProductsCount.text(response.count)
                },
            })



            $('#modalAddToCart_singlePage').modal('toggle');
        })

        $('.btn-like').on('click' ,  function (e){

            e.preventDefault();

            $(this).toggleClass('active');

            if ($(this).hasClass('active')){

                $(this).children('.pt-text').text('ازالة من المفضلة')

            }else{

                $(this).children('.pt-text').text('اضافة الي المفضلة')

            }


            $.ajax({

                'url':$(this).attr('href'),

                method:'post',

                success(response){

                    $('#likes-count').text(response.count)
                },
            })

            $('.testi1').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                dots: true,
                autoplay: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    1024: {
                        items: 2
                    }
                }
            });
        })

    </script>
@endsection
