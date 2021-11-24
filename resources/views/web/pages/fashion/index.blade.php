@php($title_page      = "الازياء والموضة")
@php($title_seo       = "الازياء والموضة")
@php($description_seo = $section->meta_description)

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>الاقسام</li>
    <li>الازياء والموضة</li>
@endsection

@section('content')

    <div class="container-indent mb-5">
        <div class="container container-fluid-custom-mobile-padding">
            <h1 class="pt-title-subpages noborder">الازياء والموضة</h1>
            <div class="pt-layout-col-promo">
                <div class="row justify-content-center">
                    @foreach($cats as $cat)
                        <div class="col-6 col-md-3">
                            <a href="{{route('web.cat.show' , $cat->slug)}}" class="pt-promo-box" target="_blank">
                                <div class="image-box">
                                    <img src="{{asset("assets/web/images/fashion/$cat->slug.jpg")}}" alt="meral">
                                </div>
                                <div class="pt-description pr-promo-type1 pt-point-external">
                                    <div class="pt-description-wrapper">
                                        <div class="pt-title-large"><span>{{$cat->name}}</span></div>
                                        <p>{{$cat->products_count}} منتج </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <a href="https://api.whatsapp.com/send?phone=0554412103 &amp;text=some%20predefined%20message&amp;source=&amp;data=" class="btn btn-success btn-rounded btn-whatsapp whatsapp2">تواصلي مع قسم الملابس</a>

@endsection
