@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">المنتجات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة منتج</span></li>
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
                                <h4>اضافة منتج جديد</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        @include('admin.inc.form.product_create')

                        @include('admin.inc.model_add_color')

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')

    <link rel="stylesheet" href="{{asset('assets/admin/plugins/file-upload/file-upload-with-preview.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/editors/quill/quill.snow.css')}}">
    <style>
        .cover-cats , .cover-colors{
            max-height: 400px;
            overflow: auto;
        }
        .tox .tox-editor-container{
            direction: rtl !important;
            text-align: right !important;
        }



    </style>
@endsection

@section('js')

    <script src="{{asset('assets/admin/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src='https://cdn.tiny.cloud/1/jj3v8hawt3vfkwkos9o6imcflmz0n20feztjejosztf38fco/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>

        tinymce.init({
            selector: '#mytextarea',
            directionality :"rtl",
            height : "480",
            plugins: "link image code past",
            toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code'
        });

        var firstUpload = new FileUploadWithPreview('myFirstImage')

        var secondUpload = new FileUploadWithPreview('mySecondImage')

        let inpPrice = $('#price'),
            inpDiscount = $('#discount');

        $('#form_create_post').on('submit' , function () {

            if ($('.cat-checkbox:checked').length  <= 0){

                alert('يجب ان يكون المنتج تحت تصنيف واحد علي الاقل')

                return false


            }else if (parseInt(inpDiscount.val()) >= inpPrice.val()){

                alert('يجب ان يكون سعر الخصم اقل من السعر الاساسي للمنتج')

                return false

            } else {


                return  true
            }


        })

        inpDiscount.on('focusout' , function () {

            if (parseFloat($(this).val()) >= parseFloat(inpPrice.val()) ||  (inpPrice.val().length === 0 && $(this).val().length > 0)){

                alert('يجب ان يكون سعر الخصم اقل من السعر الاساسي للمنتج')
            }
        })

        inpPrice.on('focusout' , function () {

            if (parseFloat($(this).val()) <= parseFloat(inpDiscount.val())){

                alert('يجب ان يكون سعر الخصم اقل من السعر الاساسي للمنتج')
            }
        })


        let form_add_color = $('#form_modal_add_new_color'),
            elementError = $('<span class="invalid-feedback d-block" user="alert"><strong></strong></span></div></div>');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn_modal_add_new_color.active').on('click' , function (e){

            e.preventDefault();

            if ($(this).hasClass('active')){

                $.ajax({

                    url: form_add_color.attr('action'),
                    method: 'post',
                    data: new FormData(form_add_color[0]),
                    contentType: false,
                    cache: false,
                    processData:false,

                    beforeSend:function (){

                        $(this).removeClass('active')
                        $('#modal_create_color_cover .spinner_add_ajax').removeClass('d-none')
                        $('#modal_create_color_cover .alert-success').addClass('d-none')

                        $('#modal_create_color_cover .is-invalid').removeClass('is-invalid')
                        $('#modal_create_color_cover .invalid-feedback').remove()
                    },

                    success($response){

                        $('#modal_create_color_cover .spinner_add_ajax').addClass('d-none')
                        $('#modal_create_color_cover .alert-success').removeClass('d-none')
                        $('#modal_create_color_cover input').val('')

                        let cover_colors =  $response.data.custom == 0
                        ? $('#cover_all_colors')
                        : $('#cover_custom_colors');

                        cover_colors.prepend(`<div class="custom-control custom-checkbox mb-4">
                                                        <input name="colors[]" value="${$response.data.id}" type="checkbox" class="custom-control-input" id="${$response.data.id}" checked>
                                                         <label class="custom-control-label" for="${$response.data.slug}">
                                                          ${$response.data.name}
                                                          <img src="{{asset("assets/web/images/colors/min/small_")}}${$response.data.img}" alt="${$response.data.alt}" class="img-fluid d-block" width="50px">
                                                          `)

                    },

                    error:function (xhr) {

                        $('#modal_create_color_cover .spinner_add_ajax').addClass('d-none')

                        $.each(xhr.responseJSON.errors , function (key , error) {

                            let htmlError = elementError.clone();
                            htmlError.children('strong').text(error)
                            form_add_color.find('#'+key).addClass('is-invalid').after(htmlError[0].outerHTML)
                        })
                    }
                })

            }
        })

        $('.show_section_seo').on('click' , function (e) {

            e.preventDefault();

            $('.cover_seo').removeClass('d-none');
            $(this).remove()
        })
    </script>

@endsection
