<div class="pt-collapse open">
    <h3 class="pt-collapse-title">
        التصنيفات في هاذا القسم
        <span class="pt-icon">
                <svg>
                    <use xlink:href="#icon-arrow_small_bottom"></use>
                </svg>
            </span>
    </h3>
    <div class="pt-collapse-content">
        <ul class="pt-list-row">
            @foreach($section->cats as $cat)
                <li><a href="{{route('web.cat.show' , $cat->slug)}}">{{$cat->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
