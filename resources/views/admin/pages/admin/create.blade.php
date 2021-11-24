@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.admin.index')}}">المسئولين</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة مسئول</span></li>
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
                                <h4>اضافة مسئول جديد</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.inc.form.user_create')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function () {

            let selectArea = $('#area'),
                areas = [];

            $('#country').on('change', function (e) {

                selectArea_method($(this));
            });


            function selectArea_method($this) {

                let data = $.parseJSON($this.find(':selected').attr('data-areas'));
                $.each(data, function ($id, $name) {


                    areas.push("<option  value='" + $id +"'>" + $name + "</option>")

                })

                selectArea.html(areas);
                areas = [];
            }
        });
    </script>
@endsection
