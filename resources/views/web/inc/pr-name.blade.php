<h2 class="pt-title"><a href="{{route('web.product.show' ,$product->slug)}}">{{$product->name}}</a></h2>
<div class="pt-price">
    @if ($is_discount)
        <span class="old-price">{{$product->price}} ريال </span>
        <span class="new-price">{{$product->discount}} ريال </span>
    @else
        {{$product->price}} ريال
    @endif
</div>
