<nav>
    <ul>
        <li class="dropdown  megamenu ">
            <a href="{{url('/')}}"><span>الرئيسية</span></a>
        </li>
        @foreach($sections as $section)

            @php($countCats = $section->cats->count() )
            <li class="dropdown pt-megamenu-col-{{( ceil($countCats > 12)  ? $countCats / 12 : 1)}}">
            {{-- section --}}
            <a href="{{route('web.section.show' , $section->slug)}}">
                <span>{{$section->name}}</span>
            </a>

                {{-- cats --}}
            <div class="dropdown-menu">
                <div class="row">
                    @if($section->cats->count() > 12) <!-- check is count categories in this lop > 12 -->
                        @foreach($section->cats->chunk(12) as $cats)  <!-- chunk cast to 12 index Then foreach on chunk group  -->
                            <div class="col">
                                <ul class="pt-megamenu-submenu">
                                    @foreach($cats as $cat) <!-- foreach in group chunk active  -->
                                        <li><a href="{{route('web.cat.show' ,$cat->slug)}}">{{$cat->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                    @else <!-- else count categories <= 12  -->
                        <div class="col">
                            <ul class="pt-megamenu-submenu">
                                @foreach($section->cats as $cat)
                                    <li><a href="{{route('web.cat.show' , $cat->slug)}}">{{$cat->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </li>
        @endforeach

        <li class="dropdown  megamenu">
            <a href="{{route('web.fashion-and-style')}}"><span>ازياء وموضة</span></a>
        </li>
        <li class="dropdown  megamenu">
            <a href="{{route('web.offer.show')}}"><span>العروض والخصومات</span></a>
        </li>

        <li class="dropdown  megamenu">
            <a href="{{route('web.premium.show')}}"><span>منتجات مميزة</span></a>
        </li>

        <li class="dropdown  megamenu">
            <a href="{{route('web.about.show')}}"><span>من نحن</span></a>
        </li>


        <li class="dropdown  megamenu">
            <a href="{{route('web.blog')}}"><span>المدونة</span></a>
        </li>
    </ul>
</nav>
