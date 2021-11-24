@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.sizeChart.index')}}">جداول المقاسات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة جدول مقاسات</span></li>
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
                                <h4>اضافة جدول مقاسات</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.inc.form.sizeChart_create')
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

    <script>

        var firstUpload = new FileUploadWithPreview('myFirstImage')

    </script>

@endsection

