@php($title_page      = 'منتجات مميزة')
@php($title_seo       = 'منتجات مميزة')
@php($description_seo = 'في ميرال نرشج اليكي مجموعة من افضل المتجات التي تهمك للحفاظ علي جمالك')

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>منتجات مميزة</li>
@endsection
@section('content')

    <div class="container-indent">
            <div class="container-fluid container-fluid-custom-mobile-padding">
                <div class="pt-block-title">
                    <h1 class="pt-title">المنتجات المميزة<span class="pt-title-total"></span></h1>
                </div>
                <div class="row flex-sm-row-reverse">
                    <div class="col-md-12">
                        <div class="content-indent container-fluid-custom-mobile-padding-02">

                            @include('web.inc.pr-filter')

                            <div class="pt-product-listing row">
                                @foreach($products as $product)

                                    @php($is_new= $product->created_at->addMonth() >= now())
                                    @php($is_discount = $product->discount > 0)
                                    @php($is_premium = true)

                                    <div class="col-6 col-md-4 col-lg-2 pt-col-item">
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
                                                    <div class="pt-content">
                                                        {{$product->shortDescription}}
                                                    </div>
                                                </div>
                                                @include('web.inc.pr-price')
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @include('web.inc.pr-btnMoro')
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @include('web.inc.banners')

@endsection

@section('js')
    <script>

        let url = new URL(location.href),
            currentPage = url.searchParams.get("page");

        currentPage == null ? currentPage = 2 : '';

        $('#load-products').on('click' , function (e){

            e.preventDefault();

            $(this).addClass('d-active')

            $.ajax({


                data:{'page':currentPage},

                success: (response) =>{


                    $('.pt-product-listing').append(response.data);

                    if (response.lastPage === false){

                        $('#load-products').remove();
                        $('.not-load-products').removeClass('d-none');

                    }else {

                        $(this).removeClass('d-active')
                    }

                    currentPage++;
                },



            })

        })
    </script>
@endsection
