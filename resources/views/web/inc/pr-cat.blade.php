<ul class="pt-add-info">
    <li class="d-block w-100 bg-info text-white text-center font-weight-bold">منتج اصلي مضمون</li>
    @php($cat = $product->cats->first())
    <li class="d-inline-block"><a href="{{route('web.cat.show' , $cat->slug)}}">{{$cat->name}}</a></li>
</ul>
