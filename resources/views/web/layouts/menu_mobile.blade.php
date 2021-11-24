<nav class="panel-menu mobile-main-menu">
    <ul>
        <li>
            <a href="{{url('/')}}">الرئيسية</a>
        </li>

        @foreach($sections as $section)
            <li>
                <a href="{{route('web.section.show' , $section->slug)}}">{{$section->name}}</a>
                <ul>
                    @foreach($section->cats as $cat)
                        <li>
                            <a href="{{route('web.cat.show' , $cat->slug)}}">{{$cat->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach


        <li class="">
            <a href="{{route('web.fashion-and-style')}}"><span>ازياء وموضة</span></a>
        </li>
        <li class="">
            <a href="{{route('web.offer.show')}}"><span>العروض والخصومات</span></a>
        </li>

        <li class="">
            <a href="{{route('web.premium.show')}}"><span>منتجات مميزة</span></a>
        </li>

        <li class="">
            <a href="{{route('web.about.show')}}"><span>من نحن</span></a>
        </li>

        <li class="">
            <a href="{{route('web.blog')}}"><span>المدونة</span></a>
        </li>

        @guest()
            <li>
                <div class="external-item-title mr-3 mb-2 mt-5">حسابي</div>
                <a href="{{route('login')}}">
                    <i class="pt-icon">
                        <svg width="18" height="23">
                            <use xlink:href="#icon-lock"></use>
                        </svg>
                    </i>
                    <span class="pt-text">تسجيل الدخول</span>
                </a>
            </li>
            <li>
                <a href="{{route('register')}}">
                    <i class="pt-icon pt-align-icon">
                        <svg width="24" height="24">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                    </i>
                    <span class="pt-text">التسجل</span>
                </a>
            </li>
        @else
            <li>
                <div class="external-item-title mr-3 mb-2 mt-5">حسابي</div>
                <a href="{{route('profile.index')}}">
                    <i class="pt-icon">
                        <svg width="18" height="23">
                            <use xlink:href="#icon-lock"></use>
                        </svg>
                    </i>
                    <span class="pt-text">الملف الشخصي</span>
                </a>
            </li>
            <li>
                <a href="{{route('logout')}}">
                    <i class="pt-icon pt-align-icon">
                        <svg width="24" height="24">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                    </i>
                    <span class="pt-text">تسجيل الخروج</span>
                </a>
            </li>
        @endif
    </ul>


    <div class="mm-navbtn-names">
        <div class="mm-closebtn">اغلاق</div>
        <div class="mm-backbtn">رجوع</div>
    </div>


</nav>
