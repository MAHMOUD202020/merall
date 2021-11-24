<div class="pt-collapse open">
    <div class="pt-aside-block">
        <h6 class="pt-aside-title">
            خصومات رائعه
        </h6>
        <div class="pt-aside-content">
            @foreach($offersRandom_products as $product)
                <div class="pt-item">
                    <div class="pt-img">
                        <a href="{{route('web.product.show' , $product->slug)}}">
                        <span class="pt-img-default">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArwAAAOCAQMAAACvc5NpAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAHBJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADg9uCABAAAAEDQ/9f9CBUAAAAAAAAAAAAAAAAAAAAAAGAiOEEAAVstZ/kAAAAASUVORK5CYII=" class="lazyload" data-src="{{asset("assets/web/images/products/min/small_$product->img")}}" alt="{{$product->alt}}">
                        </span>
                            <span class="pt-img-rollover">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArwAAAOCAQMAAACvc5NpAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAHBJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADg9uCABAAAAEDQ/9f9CBUAAAAAAAAAAAAAAAAAAAAAAGAiOEEAAVstZ/kAAAAASUVORK5CYII=" class="lazyload" data-src="{{asset("assets/web/images/products/min/small_$product->img")}}" alt="{{$product->alt}}">
                        </span>
                        </a>
                    </div>
                    <div class="pt-content">
                        <ul class="pt-add-info">
                            <li>وفري {{$product->percentage}} %</li>
                        </ul>
                        <h6 class="pt-title"><a href="{{route('web.product.show' , $product->slug)}}">{{$product->name}}</a></h6>
                        <div class="pt-price">
                            <span class="old-price">{{$product->price}}</span>
                            <span class="new-price">{{$product->discount}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
