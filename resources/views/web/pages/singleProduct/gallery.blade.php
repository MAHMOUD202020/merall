<div class="product-images-carousel">
    <ul id="smallGallery" class="arrow-location-02  slick-animated-show">
        <li><a class="zoomGalleryActive" href="#" data-image="{{asset("assets/web/images/products/min/$product->img")}}" data-zoom-image="{{asset("assets/web/images/products/min/$product->img")}}"><img src="{{asset("assets/web/images/products/min/small_$product->img")}}" alt="{{$product->alt}}"></a></li>
        @foreach($product->images as $img)
            <li><a href="#" data-image="{{asset("assets/web/images/products/gallery/$product->slug/$img->src")}}" data-zoom-image="{{asset("assets/web/images/products/gallery/$product->slug/$img->src")}}"><img src="{{asset("assets/web/images/products/gallery/$product->slug/small_$img->src")}}" alt="{{$img->alt}}"></a></li>
        @endforeach
    </ul>
</div>
