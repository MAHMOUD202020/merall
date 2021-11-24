<div class="pt-col">
    <div class="pt-row-hover">
        @if ($product->available == 1)
            <a href="{{route('web.cart.store' , 'product='.$product->id)}}" class="pt-btn-addtocart" data-toggle="modal" data-target="">
        @else
            <a href="#" class="pt-btn-addtocart pt-disable" data-toggle="modal" data-target="#modalAddToCart">
        @endif
            <div class="pt-icon">
                <svg><use xlink:href="#icon-cart_1"></use></svg>
                <svg><use xlink:href="#icon-cart_1_plus"></use></svg>
                <svg><use xlink:href="#icon-cart_1_disable"></use></svg>
            </div>
            @if ($product->available == 1)
                <span class="pt-text">اضافة الي السلة</span>
            @else
                <span class="pt-text">انتهت الكمية</span>
            @endif
        </a>
        <div class="pt-price">
            @if ($is_discount)
                <span class="old-price">{{$product->price}} ريال </span>
                <span class="new-price">{{$product->discount}} ريال </span>
            @else
                {{$product->price}} ريال
            @endif
        </div>
    </div>
    <span class="text-secondary text-sm"> السعر شامل الضريبة</span>

</div>
