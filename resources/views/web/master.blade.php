@php($appNAme = env('app_name'))
<!DOCTYPE html>
<html lang="ar">
@include('web.layouts.head')
<body>
<!-- modal "Add To Cart" -->
@include('web.inc.modelAddCart')
    @include('web.layouts.header')

    <div class="pt-breadcrumb">
        <div class="container-fluid">
            <ul>
                @yield('breadcrumb')
            </ul>
        </div>
    </div>

    <main id="pt-pageContent">
        @yield('content')
    </main>

    @include('web.layouts.footer')

    @include('web.layouts.models')
  
    @include('web.inc.modelAddCart')

    @include('web.layouts.script')
    


</body>
</html>
