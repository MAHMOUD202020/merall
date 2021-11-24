@php($title_page      = 'من نحن')
@php($title_seo       = 'من نحن')
@php($description_seo = '                        نحن شركة منافسه في مجال التجميل والعناية ونحن نخوض هذا المجال بكل قوة لما لدينا من كوادر ومؤهلات وخبرات تتعدى ٢٥ سنه لخدمة النصف الثاني من المجتمع بأفضل رعاية ممكنه لتنال إعجابكم و رضاكم')

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>من نحن</li>
@endsection
@section('content')
    <div class="container-indent mb-5">
        <div class="container">
            <div class="pt-about">
                <div class="pt-img">
                    <div class="pt-img-main">
                        <div><img src="{{asset('assets/web/images/about/img1.png')}}" class="js-init-parallax" data-orientation="up" data-overflow="true" data-scale="1.4" alt=""></div>
                    </div>
                    <div class="pt-img-sub">
                        <div>
                            <img src="{{asset('assets/web/images/about/img2.png')}}" class="js-init-parallax" data-orientation="down" data-overflow="true"  data-scale="1.4" alt="">
                        </div>
                    </div>
                </div>
                <div class="pt-description">
                    <div class="pt-title">من نحن</div>
                    <p>
                        اهلا وسهلا بكم في متجركم ميرال
                        <br class="mt-1">
                        نحن شركة منافسه في مجال التجميل والعناية ونحن نخوض هذا المجال بكل قوة لما لدينا من كوادر ومؤهلات وخبرات تتعدى ٢٥ سنه لخدمة النصف الثاني من المجتمع بأفضل رعاية ممكنه لتنال إعجابكم و رضاكم
                    </p>


                    <div class="pt-title mt-5">عن العمل</div>
                    <p>
                        موقع ميرال هو موقع متخصص في كل ما يتعلق بالجمال والمرأة ومنتجات وأدوات التجميل والعناية بالشعر والبشرة والجسم ويحتوي على افضل الماركات العالميه الاصليه والمشهورة
                        وعلى أقسام خاصة لملابس السهرات النسائيه والاكسسوار بشتى أنواعه
                        ونتميز بخدمة ما بعد البيع لأي استفسار يخص المنتجات وطريقة استخدامها لأفضل نتيجه مرجوة                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
