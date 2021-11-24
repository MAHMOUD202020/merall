@if ($news)
    <ul class="js-header-slider pt-slider-smoothhiding slick-animated-show">
        @foreach($news as $new)
            <li>
                <strong class="pt-base-dark-color text-rtl">{{$new->value}}</strong>
                @if ($new->link)
                    <a href="{{$new->link}}" target="_blank" class="pt-link-underline">عرض المزيد</a>
                @endif
            </li>
        @endforeach
    </ul>
@endif
