<div id="js-init-mobile-productsingle" class="visible-xs arrow-location-center slick-animated-show-js">
    <div><img src="{{asset("assets/web/images/products/min/$product->img")}}" alt="{{$product->alt}}"></div>
    @foreach($product->images as $img)
        <div><img src="{{asset("assets/web/images/products/gallery/$product->slug/$img->src")}}" alt="{{$img->alt}}"></div>
    @endforeach
</div>
