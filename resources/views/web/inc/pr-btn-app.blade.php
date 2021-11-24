<div class="pt-app-btn">
    <a href="{{route('web.like.create' , $product->id)}}" class="pt-btn-wishlist" data-tooltip="المفضلة" data-tposition="left">
        <svg><use xlink:href="#icon-wishlist"></use></svg>
        <svg><use xlink:href="#icon-wishlist-add"></use></svg>
    </a>
    <a href="{{route('web.compare.create' , $product->id)}}"  class="pt-btn-compare" data-tooltip="المقارنة" data-tposition="left">
        <svg><use xlink:href="#icon-compare"></use></svg>
        <svg><use xlink:href="#icon-compare-add"></use></svg>
    </a>
</div>
