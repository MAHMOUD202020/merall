@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li><a href="{{route('profile.index')}}">الملف الشخصي</a></li>
    <li>المفضلة</li>

@endsection

@section('content')

    @if($like_products->count() > 0)

        <div class="container-indent">
            <div class="container">
                <h1 class="pt-title-subpages noborder">المنتجات المفضلة</h1>
                <div class="js-init-carousel row arrow-location-center-02 pt-layout-product-item js-align-arrow">

                    @foreach($like_products as $product)

                        @php($is_new= $product->created_at->addMonth() >= now())
                        @php($is_discount = $product->discount > 0)
                        @php($is_premium = $product->premium == 1)

                        <div class="col-6 col-md-4 col-lg-3">
                        <div class="pt-product">

                            <div class="pt-image-box">

                                <div class="pt-app-btn">
                                    <a href="{{route('web.like.create' , $product->id)}}" class="pt-btn-wishlist" data-tooltip="المفضلة" data-tposition="left">
                                        <svg><use xlink:href="#icon-wishlist-add"></use></svg>
                                        <svg><use xlink:href="#icon-wishlist"></use></svg>
                                    </a>
                                    <a href="{{route('web.compare.create' , $product->id)}}"  class="pt-btn-compare" data-tooltip="المقارنة" data-tposition="left">
                                        <svg><use xlink:href="#icon-compare"></use></svg>
                                        <svg><use xlink:href="#icon-compare-add"></use></svg>
                                    </a>
                                </div>

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

    @else

        <div class="container-indent">
            <div class="container">
                <div class="pt-empty-layout">
				<span class="pt-icon">
					<svg width="94" height="83" viewBox="0 0 94 83" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M77.9355 9.49519C76.9221 9.49519 76.0996 10.3184 76.0996 11.3328C76.0996 12.3472 76.9221 13.1704 77.9355 13.1704C78.949 13.1704 79.7715 12.3472 79.7715 11.3328C79.7715 10.3183 78.949 9.49519 77.9355 9.49519Z" fill="currentColor"/>
<path d="M87.4747 7.64378C83.0932 2.71472 77.0159 0.000183662 70.3623 0.000183662C63.0867 0.000183662 56.4476 2.82296 51.1632 8.16346C49.3256 10.0204 47.9521 11.8757 47 13.348C46.0479 11.8758 44.6744 10.0208 42.8368 8.16346C37.5524 2.82277 30.9135 0 23.6377 0C9.71101 0 0 11.6618 0 25.5266C0 44.2553 19.8289 60.0249 45.7976 82.5511C46.1426 82.8504 46.5713 83 47 83C47.4287 83 47.8574 82.8504 48.2024 82.5511C74.233 59.9711 94 44.2292 94 25.5266C94 18.7283 91.6827 12.3775 87.4747 7.64378ZM47 78.7316C22.4776 57.4916 3.67188 42.2363 3.67188 25.5266C3.67188 13.0694 12.2552 3.67543 23.6377 3.67543C29.9577 3.67543 35.5091 6.02502 40.1375 10.6586C43.6636 14.1887 45.3087 17.7913 45.3249 17.8274C45.6203 18.4865 46.2752 18.9099 46.9972 18.9114C46.9983 18.9114 46.9996 18.9114 47.0007 18.9114C47.7226 18.9114 48.3784 18.4863 48.6753 17.8274C48.6914 17.7913 50.3366 14.1889 53.8627 10.6586C58.491 6.02484 64.0423 3.67543 70.3625 3.67543C81.7449 3.67543 90.3283 13.0694 90.3283 25.5266C90.3281 42.6136 70.2815 58.5664 47 78.7316Z" fill="currentColor"/>
<path d="M84.3569 16.0417C83.886 15.1428 82.7762 14.7966 81.8784 15.2677C80.9805 15.7391 80.6342 16.8497 81.1051 17.7485C82.317 20.0615 82.9844 22.8239 82.9844 25.5266C82.9844 30.8366 80.4594 36.4724 75.0381 43.2628C74.405 44.0556 74.5341 45.212 75.3261 45.8456C76.1233 46.4833 77.2775 46.3451 77.9065 45.5573C83.8759 38.0804 86.6562 31.7154 86.6562 25.5266C86.6562 22.1924 85.8611 18.9127 84.3569 16.0417Z" fill="currentColor"/>
</svg>

				</span>
                    <h1 class="pt-title">المفضلة</h1>
                    <p>لا توجد اي منتجات تمت اضافتها الي المفضلة</p>
                    <div class="row-btn">
                        <a href="{{url('/')}}" class="btn btn-border">الذهاب الي الي التسوق</a>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection

