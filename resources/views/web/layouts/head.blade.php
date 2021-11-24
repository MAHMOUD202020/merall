<head>
    <meta charset="utf-8">
    <!-- Primary Meta Tags -->
    @php($var_title_seo = isset($title_seo) ? 'merall-ميرال | ' . $title_seo : "ميرال | merall | meralll")
    @php($var_description_seo = isset($description_seo) ? $description_seo : "موقع ميرال كل ما تحتاجة المرأة في مكان واحد من مستحضرات تجميل وملابس وادوات نسائيه|merall - Website All what a woman needs in one place")
    @php($var_img_seo =  isset($img_seo) ? $img_seo : asset('assets/web/images/logo.png'))
    <title>@isset($title_page) ميرال - merall | {{$title_page}}  @else  ميرال | merall @endif</title>
    <meta name="title" content="{{$var_title_seo}}">
    <meta name="description" content="{{$var_description_seo}}">
    <meta name="keywords" content="@isset($keywords_seo) {{$keywords_seo}} @else مستحضرات تجميل , ميك اب ارتست ,  ملابس نسائية , ادوات تجميل , المراء , المكياج ,ميرال,merall,merall,فرش,نساء,المراءه,المرأه,العناية بالجسد ,العناية بالمراه,العناية @endif">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Arabic">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.facebook.com/Meral-Store-%D9%85%D9%8A%D8%B1%D8%A7%D9%84-%D8%B3%D8%AA%D9%88%D8%B1-101874235289132">
    <meta property="og:title" content="{{$var_title_seo}}">
    <meta property="og:description" content="{{$var_description_seo}}">
    <meta property="og:image" content="{{$var_img_seo}}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://twitter.com/StoreMeral">
    <meta property="twitter:title" content="{{$var_title_seo}}">
    <meta property="twitter:description" content="{{$var_description_seo}}">
    <meta property="twitter:image" content="{{$var_img_seo}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/web/favicon/favicon.ico')}}">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/WAFloatBox.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/rtl.css')}}">
    @yield('css')
</head>
