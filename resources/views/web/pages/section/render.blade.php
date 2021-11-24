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
