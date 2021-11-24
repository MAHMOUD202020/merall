@if(request()->route()->getName() != "web.cart.index")

<div class="pt-promofixed" id="js-init-promofixed">
    <a href="#" class="pt-btn-close">
        <svg fill="none">
            <use xlink:href="#icon-close"></use>
        </svg>
    </a>
    <div id="js-slick-promofixed" class="promofixed-list-item">
        @foreach($offersRandom_products as $product)
            <a href="{{route('web.product.show' , $product->slug)}}" class="pt-item">
                <div class="pt-img">
                    <picture>
                        <source srcset="{{asset("assets/web/images/products/min/small_$product->img")}}">
                        <img class="lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArwAAAOCAQMAAACvc5NpAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAHBJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADg9uCABAAAAEDQ/9f9CBUAAAAAAAAAAAAAAAAAAAAAAGAiOEEAAVstZ/kAAAAASUVORK5CYII=" data-lazy="{{asset("assets/web/images/products/min/small_$product->img")}}" alt="{{$product->alt}}">
                    </picture>
                </div>
                <div class="pt-description">
                    <p> اشتري الان فقط بسعر {{$product->discount}}</p>
                    <h6 class="pt-title">{{$product->name}}</h6>
                    <h7 class="d-block text-center text-info">وفري {{$product->percentage}} %</h7>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif
