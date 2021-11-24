@php($title_page      = $cat->name)
@php($title_seo       = $cat->name)
@if($cat->section_id != 6)
    @php($section = $sections->where('id' , $cat->section_id)->first())
@else
    @php($section = \App\Models\Section::findOrFail(6))
@endif
@php($description_seo = $section->meta_description)

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li><a href="{{route('web.section.show' , $section->slug)}}">{{$section->name}}</a></li>
    <li>{{$cat->name}}</li>
@endsection
@section('content')

    <div class="container-indent">
            <div class="container container-fluid-custom-mobile-padding">
                <div class="pt-block-title">
                    <h1 class="pt-title">{{$cat->name}}</h1>
                </div>
                <div class="row flex-sm-row-reverse">
                    @include('web.pages.cat.aside')
                    <div class="col-md-12 col-lg-9 col-xl-9">
                        <div class="content-indent container-fluid-custom-mobile-padding-02">

                            @include('web.inc.pr-filter')

                            <div class="pt-product-listing row">
                                @foreach($products as $product)

                                    @php($is_new= $product->created_at->addMonth() >= now())
                                    @php($is_discount = $product->discount > 0)
                                    @php($is_premium = $product->premium == 1)

                                    <div class="col-6 col-md-4 pt-col-item">
                                        <div class="pt-product">
                                            <div class="pt-image-box">
                                                @include('web.inc.pr-btn-app')
                                                @include('web.inc.pr-img')
                                                @include('web.inc.pr-label')
                                            </div>

                                            <div class="pt-description">
                                                <div class="pt-col">

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
