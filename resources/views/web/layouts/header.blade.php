@php($user = auth()->user())
@if ($user && $user->admin == 1)

<div class="container-fluid bg-light pt-2 pb-2 text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{route('admin.dashboard.index')}}" class="btn bg-secondary ">الذهاب الي لوحة التحكم</a>
            </div>
            <div class="col">
                <a href="{{route('admin.product.create')}}" class="btn bg-secondary ">اضافة منتج جديد</a>
            </div>
            @if(request()->route()->getName() == "web.product.show")
                <div class="col">
                    <a href="{{route('admin.product.show' , $product_id)}}" class="btn bg-secondary ">تعديل المنتج</a>
                </div>
            @endif
        </div>

    </div>
</div>
@endif


<header id="pt-header">
    <!-- pt-top-panel -->
    @include('web.layouts.min_news')
    <!-- /pt-top-panel -->
    <div class="headerunderline">
        <div class="container-fluid">
            <div class="pt-header-row pt-top-row no-gutters">
                <div class="pt-col-left col-3 d-none d-md-block">
                    <div class="pt-box-info">
                        <ul>
                            <li><i class="icon-quote"></i><strong class="pt-base-dark-color"> الرياض - المملكة العربية السعودية</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="pt-col-center col-6">
                    <div class="pt-box-info">
                        @include('web.layouts.news')
                    </div>
                </div>
                <div class="pt-col-right col-3 ml-auto">
                    <div class="pt-desctop-parent-submenu pt-parent-box">
                        <ul class="submenu">
                            <li>
                                <a target="_blank" href="https://www.instagram.com/meralllstore/">
                                    <img src="{{asset('assets/web/images/social/instagram.svg')}}" width="30" height="30" alt="meralll instagram">
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/Meralll.Store/?ref=pages_you_manage">
                                    <img src="{{asset('assets/web/images/social/facebook.svg')}}" width="30" height="30" alt="meralll instagram">
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com/store_meral">
                                    <img src="{{asset('assets/web/images/social/twitter.svg')}}" width="30" height="30" alt="meralll instagram">
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.snapchat.com/add/StoreMeral">
                                        <img src="{{asset('assets/web/images/social/snapchat.svg')}}" width="30" height="30" alt="meralll instagram">
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.tiktok.com/@meralstore?lang=ar">
                                        <img src="{{asset('assets/web/images/social/tiktok.svg')}}" width="30" height="30" alt="meralll instagram">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- pt-mobile menu -->
    @include('web.layouts.menu_mobile')
    <!-- pt-mobile-header -->
    <div class="pt-mobile-header">
        <div class="container-fluid">
            <div class="pt-header-row">
                <!-- mobile menu toggle -->
                <div class="pt-mobile-parent-menu">
                    <div class="pt-menu-toggle">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#icon-mobile-menu-toggle"></use>
                        </svg>
                    </div>
                </div>
                <!-- /mobile menu toggle -->
                <div class="pt-logo-container">
                    <!-- mobile logo -->
                    <div class="pt-logo pt-logo-alignment" itemscope itemtype="http://schema.org/Organization">
                        <a href="{{url('/')}}" itemprop="url" style="max-width: 200px">
                            <h2 class="pt-title">
                                <img  class="img-fluid" src="{{asset('assets/web/images/logo.png')}}" alt="">
                            </h2>
                        </a>
                    </div>
                    <!-- /mobile logo -->
                </div>
                <!-- search -->
                <div class="pt-mobile-parent-search pt-parent-box"></div>
                <!-- /search -->
                <!-- cart -->
                <div class="pt-mobile-parent-cart pt-parent-box"></div>
                <!-- /cart -->
            </div>
        </div>
    </div>
    <!-- pt-desktop-header -->
    <div class="pt-desktop-header">
        <div class="container-fluid">
            <div class="headinfo-box form-inline">
                <!-- logo -->
                <div class="pt-logo pt-logo-alignment" itemscope itemtype="http://schema.org/Organization">
                    <a href="{{url('/')}}" itemprop="url" style="max-width: 100px" >
                        <img  class="img-fluid" src="{{asset('assets/web/images/logo.png')}}" alt="">
                    </a>
                </div>
                <!-- /logo -->
                <div class="navinfo text-center">
                    <!-- pt-menu -->
                    <div class="pt-desctop-parent-menu">
                        <div class="pt-desctop-menu" id="js-include-desktop-menu">
                            @include('web.layouts.menu')
                        </div>
                    </div>
                    <!-- /pt-menu -->
                </div>
                <div class="options">
                    <!-- pt-search -->
                    <div class="pt-desctop-parent-search pt-parent-box">
                        <div class="pt-search pt-dropdown-obj js-dropdown">
                            <button class="pt-dropdown-toggle" data-tooltip="بحث" data-tposition="bottom">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                            <div class="pt-dropdown-menu">
                                <div class="container">
                                    <form method="get" action="{{route('web.search.index')}}">
                                        <div class="pt-col">
                                            <input name="value" type="text" class="pt-search-input" placeholder="البحث في المنتجات...">
                                            <button class="pt-btn-search" type="submit">
                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                    <use xlink:href="#icon-search"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="pt-col">
                                            <button class="pt-btn-close">
                                                <svg width="16" height="16" viewBox="0 0 16 16">
                                                    <use xlink:href="#icon-close"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="pt-info-text">
                                          عن ماذا تريد ان تبحث
                                        </div>
                                        <div class="search-results"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /pt-search -->
                    <!-- pt-account -->
                    @include('web.layouts.auth')
                    <!-- /pt-account -->
                    <!-- pt-compare -->
                    <div class="pt-desctop-parent-compare pt-parent-box">
                        <div class="pt-compare pt-dropdown-obj">
                            <a href="{{route('web.compare.index')}}" class="pt-dropdown-toggle" data-tooltip="المقارنة" data-tposition="bottom">
								<span class="pt-icon">
									<svg width="24" height="24" viewBox="0 0 24 24">
										<use xlink:href="#icon-compare"></use>
									</svg>
								</span>
                                <span class="pt-text">المقارنة</span>
                                <span class="pt-badge" id="compares-count">0</span>
                            </a>
                        </div>
                    </div>
                    <!-- /pt-compare -->
                    <!-- pt-wishlist -->
                    <div class="pt-desctop-parent-wishlist pt-parent-box">
                        <div class="pt-wishlist pt-dropdown-obj">
                            <a href="{{route('web.like.index')}}" class="pt-dropdown-toggle pt-btn-wishlist" data-tooltip="المفضلة" data-tposition="bottom">
								<span class="pt-icon">
									<svg width="24" height="24" viewBox="0 0 24 24">
										<use xlink:href="#icon-wishlist"></use>
									</svg>
								</span>
                                <span class="pt-text">المفضلة</span>
                                <span class="pt-badge" id="likes-count">0</span>
                            </a>
                        </div>
                    </div>
                    <!-- /pt-wishlist -->
                    <!-- pt-cart -->
                    @include('web.inc.dropdown-cart')
                    <!-- /pt-cart -->
                </div>
            </div>
        </div>
    </div>
    <!-- stuck nav -->
    <div class="pt-stuck-nav">
        <div class="container-fluid">
            <div class="pt-header-row">
                <div class="pt-stuck-parent-menu"></div>
                <div class="pt-logo-container">
                    <!-- mobile logo -->
                    <div class="pt-logo pt-logo-alignment" itemscope itemtype="{{asset('assets/web/images/logo.png')}}">
                        <a href="{{url('/')}}" itemprop="url">
                            <img  class="img-fluid" style="max-width: 70px" src="{{asset('assets/web/images/logo.png')}}" alt="">
                        </a>
                    </div>
                    <!-- /mobile logo -->
                </div>
                <div class="pt-stuck-parent-search pt-parent-box"></div>
                <div class="pt-stuck-parent-account pt-parent-box"></div>
                <div class="pt-stuck-parent-compare pt-parent-box"></div>
                <div class="pt-stuck-parent-wishlist pt-parent-box"></div>
                <div class="pt-stuck-parent-cart pt-parent-box"></div>
            </div>
        </div>
    </div>
</header>
