@if($carts->count() > 0)

    <div class="pt-cart-list">
        @php($total = 0)
        @foreach($carts as $cart)
            <div class="pt-item">
                <a href="{{route('web.product.show' , $cart->slug)}}">
                    <div class="pt-item-img">
                        <picture>
                            <source srcset="{{asset("assets/web/images/products/min/small_$cart->img")}}" type="image/jpg">
                            <img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArwAAAOCAQMAAACvc5NpAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAHBJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADg9uCABAAAAEDQ/9f9CBUAAAAAAAAAAAAAAAAAAAAAAGAiOEEAAVstZ/kAAAAASUVORK5CYII="
                                alt="image">
                        </picture>
                    </div>
                    <div class="pt-item-descriptions">
                        <h2 class="pt-title">{{$cart->name}}</h2>
                        <ul class="pt-add-info">
                            <li>عدد القطع</li>
                            <li>{{$cart->quantity}} قطعة</li>
                        </ul>
                        <div class="pt-quantity">السعر</div>
                        <div class="pt-price">{{$cart->price}} ريال</div>
                        @php($total+=$cart->price)
                    </div>
                </a>
                <div class="pt-item-close">
                    <a href="{{route('web.cart.destroy' , $cart->id)}}" class="pt-btn-close removeProductInCart">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#icon-remove"></use>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pt-cart-total-row">
        <div class="pt-cart-total-title">الاجمالي:</div>&nbsp;
        <div class="pt-cart-total-price">{{$total}} ريال</div>
    </div>
    <div class="pt-cart-btn">
        <div class="pt-item">
            <a href="{{route('web.cart.index')}}" class="btn">عرض عربة التسوق</a>
        </div>

    </div>
@else
    <a class="pt-cart-empty">
        <p>لا توجد اي منتجات تمت اضافتها الي عربة التسوق</p>
    </a>
@endif
