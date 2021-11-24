<a href="{{route('web.product.show' ,$product->slug)}}">
    <div class="pt-img">
        <picture>
            <source srcset="{{asset("assets/web/images/products/min/$product->img")}}" type="image/jpg">
            <img class="lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArwAAAOCAQMAAACvc5NpAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAHBJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADg9uCABAAAAEDQ/9f9CBUAAAAAAAAAAAAAAAAAAAAAAGAiOEEAAVstZ/kAAAAASUVORK5CYII=" data-lazy="{{asset("assets/web/images/products/min/medium_$product->img")}}" alt="{{$product->alt}}">
        </picture>
    </div>
</a>
