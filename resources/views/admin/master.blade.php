<!DOCTYPE html>
<html lang="ar">
@include('admin.layouts.head')
<body>
    @include('admin.layouts.load_screen')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sub_navbar')
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>
        @include('admin.layouts.sidebar')

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content pt-5">

            @yield('content')

            @include('admin.layouts.footer')
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    @include('admin.layouts.script')


</body>
</html>
