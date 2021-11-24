<div class="col-6">
    <div class="pt-product-single-info">
        @include('web.pages.singleProduct.label')
        <h1 class="pt-title">{{$product->name}}</h1>
        <div class="pt-price">
            @if($product->discount > 0)
                <s>{{$product->price}} ريال</s> {{$product->discount}} ريال
            @else
                {{$product->price}} ريال
            @endif
        </div>
        <div class="pt-add-info">
            <ul>
                <li><span>رقم المنتج:</span>{{$product->id}}</li>
                @foreach($product->cats as $cat)
                    <li>
                        <span>التصنيف: </span> <a href="{{route('web.section.show' , $cat->section->slug)}}" target="_blank">{{ $cat->section->name}}</a>
                        >
                        <a href="{{route('web.cat.show' , $cat->slug)}}" target="_blank">{{$cat->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

{{--        @dd (strlen(trim($product->description)))--}}

        @if (strlen($product->description) > 2)
            <div class="pt-wrapper">
                <div class="pt-text">
                    <h3 class="title-wrapper">الوصف</h3>
                    {!! $product->description !!}
                </div>
            </div>
        @endif


        @if(count($sizes) > 0)

            <div class="pt-wrapper">
                <div class="pt-title-options">
                    اختاري المقاس المناسب اليكي -
                    @if ($product->sizeChart_id != null)
                        @include('web.pages.singleProduct.model_sizeChart')
                        <a class="btn" style="background-color: #fa5661; color: white" data-toggle="modal" data-target="#exampleModalCenter" >عرض جدول المقاسات</a>
                    @endif
                </div>
                <ul class="pt-options-swatch size-middle select-size">

                    @foreach($sizes  as $size)
                        @if($loop->first)
                            <li class="active" ><a href="{{$size->id}}">{{$size->name}}</a></li>
                        @else
                            <li><a href="{{$size->id}}">{{$size->name}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>

        @endif

        @if (count($colors) > 0)
            <div class="pt-option-block mt-2">
                <h3 class="title-item">الالوان المتاحة</h3>
                <ul class="pt-options-swatch js-change-img select-color">
                    @foreach($colors as $color)
                        @if ($loop->first)
                            <li class="text-center active">
                                <a href="{{$color->id}}" data-color-image="{{asset("assets/web/images/colors/min/$color->img")}}" class="options-color-img product-color-img" data-src="{{asset("assets/web/images/colors/min/small_$color->img")}}"></a>
                                <spn class="text-sm d-block text-v-smal"> {{$color->name}} </spn>

                            </li>
                        @else
                            <li class="text-center">
                                <a href="{{$color->id}}" data-color-image="{{asset("assets/web/images/colors/min/$color->img")}}" class="options-color-img product-color-img" data-src="{{asset("assets/web/images/colors/min/small_$color->img")}}"></a>
                                <spn class="text-sm d-block text-v-smal"> {{$color->name}} </spn>

                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($product->available == 1)
            <div class="pt-wrapper">
                <div class="pt-row-custom-01">
                    <div class="col-item">
                        <div class="pt-input-counter style-01">
                                            <span class="minus-btn">
                                                <svg>
                                                    <use xlink:href="#icon_minus"></use>
                                                </svg>
                                            </span>
                            <input name="count" type="text" value="1" size="20" id="quantity-products">
                            <span class="plus-btn">
                                <svg>
                                    <use xlink:href="#icon_add"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="col-item">
                        <a href="{{route('web.cart.store' , 'product='.$product->id)}}" class="btn btn-lg">
                            <div class="pt-icon">
                                <svg>
                                    <use xlink:href="#icon-cart_1"></use>
                                </svg>
                            </div>
                            <span class="pt-text">
                                اضافة الي السلة
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="pt-wrapper">
            <ul class="pt-list-btn">
                <li>
                    <a href="{{route('web.like.create' , $product->id)}}" class="btn btn-border btn-like {{$like ? "active" : ""}}">
                        <div class="pt-icon">
                            <svg>
                                <use xlink:href="#icon-wishlist"></use>
                            </svg>
                        </div>
                        <span class="pt-text">
                           {{$like ? "ازالة من المفضلة" : "اضافة الي المفضلة"}}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/')}}" class="btn btn-border">
                        <div class="pt-icon">
                            <svg>
                                <use xlink:href="#icon-compare"></use>
                            </svg>
                        </div>
                        <span class="pt-text">
                            اضافة الي المقارنة
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="pt-wrapper">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cb03aae6a4f75e3"></script>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox"></div>
        </div>
    </div>
</div>
