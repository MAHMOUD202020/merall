@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.post.index')}}">المقالات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة مقالة</span></li>
@endsection

@section('content')
    <div class="container">

        @include('admin.inc.message_success')

        <div class="row">
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>تعديل المقالة </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.inc.form.post_update')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')

    <link rel="stylesheet" href="{{asset('assets/admin/plugins/file-upload/file-upload-with-preview.min.css')}}">

@endsection

@section('js')

    <script src="{{asset('assets/admin/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src='https://cdn.tiny.cloud/1/jj3v8hawt3vfkwkos9o6imcflmz0n20feztjejosztf38fco/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>

        tinymce.init({
            selector: '#mytextarea',
            directionality :"rtl",
            height : "480",
            plugins: "link image code",
            toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code'
        });

        var firstUpload = new FileUploadWithPreview('myFirstImage')

        $('.show_section_seo').on('click' , function (e) {

            e.preventDefault();

            $('.cover_seo').removeClass('d-none');
            $(this).remove();
        });
    </script>

@endsection

