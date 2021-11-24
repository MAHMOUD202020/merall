<div class="pt-desctop-parent-account pt-parent-box">
    <div class="pt-account pt-dropdown-obj js-dropdown">
        <button class="pt-dropdown-toggle"  data-tooltip="حسابي" data-tposition="bottom">
            <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#icon-user"></use>
            </svg>
        </button>
        <div class="pt-dropdown-menu">
            <div class="pt-mobile-add">
                <button class="pt-close">
                    <svg>
                        <use xlink:href="#icon-close"></use>
                    </svg>Close
                </button>
            </div>
            <div class="pt-dropdown-inner">
                <ul>
                    @guest()
                        <li><a href="{{route('login')}}">
                            <i class="pt-icon">
                                <svg width="18" height="23">
                                    <use xlink:href="#icon-lock"></use>
                                </svg>
                            </i>
                            <span class="pt-text">تسجيل الدخول</span>
                        </a></li>
                        <li><a href="{{route('register')}}">
                            <i class="pt-icon pt-align-icon">
                                <svg width="24" height="24">
                                    <use xlink:href="#icon-user"></use>
                                </svg>
                            </i>
                            <span class="pt-text">التسجيل</span>
                        </a></li>
                    @else
                        <li><a class="text-center">
                                <span class="pt-text">{{auth()->user()->name}}</span>
                            </a>
                        </li>
                        <li>
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
            </div>
        </div>
    </div>
</div>
