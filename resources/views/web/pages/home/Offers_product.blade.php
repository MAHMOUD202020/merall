<div class="container-indent">
    <div class="container container-fluid-custom-mobile-padding">
        <div class="pt-block-title">
            <h4 class="pt-title">عروض باكدج</h4>
        </div>
        <div class="js-init-carousel slicknodots row arrow-location-center-02 pt-layout-product-item" data-item="5">
            @foreach($offer_products as $product)

                @php($is_new= $product->created_at->addMonth() >= now())
                @php($is_discount = true)
                @php($is_premium = $product->premium == 1)

                <div class="col-6 col-md-4 col-lg-4">
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
