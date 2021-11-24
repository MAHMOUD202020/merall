@php($loopNumber = 0)

@foreach($carts as $cart)

    <input name="card[{{$loopNumber}}][id]" type="hidden" value="{{$cart->id}}">


    <div class="pt-item">
        <div class="pt-item-btn">
            <button data-href="{{route('web.cart.destroy' , $cart->id)}}" class="pt-btn js-remove-item" >
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="#icon-remove"></use>
                </svg>
            </button>
        </div>
        <div class="pt-item-img">
            <a href="{{route('web.product.show' , $cart->slug)}}"><img src="{{asset("assets/web/images/products/min/small_$cart->img")}}" alt=""></a>
        </div>
        <div class="pt-item-description">
            <div class="pt-col">
                <h6 class="pt-title"><a href="{{route('web.product.show' , $cart->slug)}}">{{$cart->name}}</a></h6>
                <ul class="pt-add-info">
                    @if ($cart->size_name)
                        <li>المقاس: <strong>{{$cart->size_name }}</strong></li>
                    @endif
                    @if ($cart->color_name)
                        <li>اللون:
                            <img width="40" height="40" class="border-img" src="{{asset("assets/web/images/colors/min/small_$cart->color_img")}}" alt="{{$cart->color_name}}">
                        </li>
                    @endif
                </ul>
            </div>
            <div class="pt-col min-price" data-price="{{$cart->min_price}}">
                <div class="pt-price">{{$cart->min_price}} ريال</div>
            </div>
            <div class="pt-col">
                <div class="pt-input-counter style-01">
                    <span class="minus-btn">
                        <svg>
                            <use xlink:href="#icon_minus"></use>
                        </svg>
                    </span>
                    <input data-id="{{$cart->id}}" name="card[{{$loopNumber}}][quantity]" type="text" value="{{$cart->quantity}}" size="20" class="count-products">
                    <span class="plus-btn">
                        <svg>
                            <use xlink:href="#icon_add"></use>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="pt-col total-price">
                <div class="pt-price">{{$cart->price}} ريال</div>
            </div>

        </div>
    </div>

    @php($loopNumber++)

{{--    @php($tax = ($cart->min_price * 15)/100 )--}}

{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-6 col-md-3 text-center pt-2 pb-2 bg-light">--}}
{{--                سعر المنتج--}}
{{--            </div>--}}
{{--            <div class="col-6 col-md-3 text-center pt-2 pb-2 bg-light">--}}
{{--                {{$cart->min_price - $tax}} ريال--}}
{{--            </div>--}}

{{--            <div class="col-6 col-md-3 text-center pt-2 pb-2 bg-secondary text-white">--}}
{{--                سعر الضريبة (15%)--}}
{{--            </div>--}}
{{--            <div class="col-6 col-md-3 text-center pt-2 pb-2 bg-secondary text-white">--}}
{{--                {{$tax}} ريال--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endforeach
