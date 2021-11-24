<div class="container-indent nomargin">
    <div class="mainSlider-layout">
        <div class="mainSliderSlick mainSliderSlick-js arrow-slick-main">
            @foreach($slides as $slide)
                <div class="slide">
                    <div class="img--holder">
                        <picture>
                            <source srcset="{{asset("assets/web/images/slider/slide/$slide->img")}}" media="(max-width: 767px)" type="image/jpg">
                            <source srcset="{{asset("assets/web/images/slider/slide/$slide->img")}}" media="(max-width: 1024px)" type="image/jpg">
                            <source srcset="{{asset("assets/web/images/slider/slide/$slide->img")}}" type="image/jpg">
                            <img src="{{asset("assets/web/images/slider/slide/$slide->img")}}" alt="">
                        </picture>
                    </div>
                    <div class="slide-content pt-point-h-r">
                        <div class="pt-container" data-animation="fadeInRightSm" data-animation-delay="0s">
                            <div class="tp-caption1-wd-1 pt-white-color"></div>
                            @if ($slide->description)
                                <div class="tp-caption1-wd-2 pt-white-color ">{{$slide->description}}</div>
                            @endif
                            @if ($slide->link)
                                <div class="tp-caption1-wd-4"><a href="{{$slide->link}}" target="_blank" class="btn" data-text="DISCOVER NOW!">{{$slide->textLink}}</a></div>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
