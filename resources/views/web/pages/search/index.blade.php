@php($title_page      = 'البحث')
@php($title_seo       = 'البحث')

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>البحث</li>
@endsection
@section('content')
    @if ($products->count() > 0)

        <div class="container-indent">
            <div class="container-fluid container-fluid-custom-mobile-padding">
                <div class="pt-block-title">
                    <h1 class="pt-title">نتائج البحث عن {{$value}}<span class="pt-title-total"></span></h1>
                </div>
                <div class="row flex-sm-row-reverse">
                    <div class="col-md-12">
                        <div class="content-indent container-fluid-custom-mobile-padding-02">

                            @include('web.inc.pr-filter')

                            <div class="pt-product-listing row">
                                @foreach($products as $product)

                                    @php($is_new= $product->created_at->addMonth() >= now())
                                    @php($is_discount = $product->discount > 0)
                                    @php($is_premium =  $product->premium = 1)

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

    @else

        <div class="container-indent">
            <div class="container">
                <div class="pt-block-title">
                    <h1 class="pt-title">نتائج البحث عن {{$value}}<span class="pt-title-total"></span></h1>
                </div>
                <div class="pt-empty-layout">
				<span class="pt-icon">
					<svg width="119" height="119" viewBox="0 0 119 119" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M59.1752 21.3817C58.0674 20.7081 56.6231 21.0599 55.9495 22.1678C55.2759 23.2756 55.6277 24.7199 56.7355 25.3935C58.2866 26.3367 59.7302 27.4723 61.0271 28.7692C61.4854 29.2278 62.0864 29.4569 62.6871 29.4569C63.2878 29.4569 63.8888 29.2278 64.3471 28.7692C65.2639 27.8523 65.2639 26.3661 64.3471 25.4492C62.786 23.8878 61.0459 22.5193 59.1752 21.3817Z" fill="currentColor"/>
<path d="M27.1088 29.4569C27.7095 29.4569 28.3105 29.2278 28.7688 28.7692C33.8993 23.6387 41.2491 21.2434 48.4281 22.3615C49.7099 22.5612 50.9095 21.6841 51.1092 20.4029C51.3086 19.1217 50.4318 17.9215 49.1509 17.7218C40.4954 16.3742 31.6352 19.2629 25.4488 25.4492C24.532 26.3661 24.532 27.8523 25.4488 28.7692C25.9071 29.2278 26.5081 29.4569 27.1088 29.4569Z" fill="currentColor"/>
<path d="M116.15 102.368L87.737 73.9547C86.8202 73.0379 85.3336 73.0379 84.4171 73.9547L83.2805 75.0913L80.4923 72.3032C94.0642 54.701 92.7877 29.2625 76.6609 13.1357C59.1471 -4.37855 30.6494 -4.37855 13.1356 13.1357C-4.37854 30.6495 -4.37854 59.1473 13.1356 76.6611C21.8925 85.4181 33.3956 89.7967 44.8984 89.7967C54.5788 89.7967 64.2591 86.6949 72.3029 80.4926L75.0911 83.2807L73.9545 84.4174C73.514 84.8575 73.2668 85.4547 73.2668 86.0773C73.2668 86.6999 73.514 87.2972 73.9545 87.7373L102.367 116.15C104.267 118.05 106.763 119 109.259 119C111.754 119 114.25 118.05 116.15 116.15C119.95 112.351 119.95 106.168 116.15 102.368ZM16.4553 73.3412C8.85779 65.7437 4.67388 55.6426 4.67388 44.8986C4.67388 34.1545 8.8581 24.0531 16.4553 16.4559C24.0527 8.85876 34.1538 4.67452 44.8978 4.67452C55.6418 4.67452 65.7435 8.85876 73.3406 16.4559C80.9381 24.0534 85.122 34.1545 85.122 44.8986C85.122 55.6426 80.9381 65.744 73.3406 73.3412C65.7432 80.9384 55.6421 85.1226 44.8981 85.1226C34.1541 85.1226 24.0527 80.9387 16.4553 73.3412ZM75.8761 77.4262C76.14 77.1748 76.4017 76.9203 76.6606 76.6611C76.9195 76.402 77.1743 76.1403 77.4256 75.8767L79.9602 78.4113L78.4107 79.9608L75.8761 77.4262ZM112.83 112.831C110.86 114.8 107.656 114.799 105.687 112.831L78.9344 86.0777L86.077 78.935L112.83 105.688C114.799 107.657 114.799 110.861 112.83 112.831Z" fill="currentColor"/>
</svg>

				</span>
                    <h1 class="pt-title">للاسف لا توجد اي نتائج في عملية البحث</h1>
                </div>
            </div>
        </div>

    @endif

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
