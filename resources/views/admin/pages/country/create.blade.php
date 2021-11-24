@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.country.index')}}">الدول</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة دولة</span></li>
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
                                <h4>اضافة دولة جديد</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.inc.form.country_create')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
