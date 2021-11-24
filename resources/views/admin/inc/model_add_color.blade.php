<div class="modal fade" id="modal_create_color_cover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة لون جديد</h5>
            </div>
            <div class="modal-body">


                <form action="{{route('admin.color.store')}}" method="post" id="form_modal_add_new_color">
                    <div class="form-row mb-4">

                        @csrf
                        <div class="form-group col-md-6">
                            <label for="name">اسم اللون</label>
                            <input name="name" type="text" class="form-control " id="name" placeholder="الاسم الظاهر في الموقع" value="" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">ال slug</label>
                            <input name="slug" type="text" class="form-control " id="slug" placeholder="الاسم الظاهر في  ال url" value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="img">الصورة</label>
                            <input name="img" type="file" class="form-control " id="img" value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="alt">Alt Text (Seo)</label>
                            <input name="alt" type="text" class="form-control " id="alt" placeholder="الاسم المعبر عن الصورة" value="">
                        </div>
                        <div class="custom-control custom-checkbox mb-4">
                            <input name="custom" type="checkbox" class="custom-control-input" id="custom" checked>
                            <label class="custom-control-label" for="custom">اضافة اللون كا لون مخصص لهاذا المنتج فقط</label>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> اغلاق</button>
                <button id="btn_modal_add_new_color" type="button" class="btn btn-primary active">
                    <span class="spinner-border text-white mr-2 align-self-center loader-sm spinner_add_ajax d-none"></span>
                    اضافة
                </button>

                <div class="alert alert-success d-none  w-100 d-none"> تم اضافة اللون بنجاح</div>
            </div>
        </div>
    </div>
</div>
