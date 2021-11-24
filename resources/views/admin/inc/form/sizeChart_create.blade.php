<form method="post" action="{{route('admin.sizeChart.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">
        <div class="form-group col-md-12">
            <label for="name">اسم جدول المقاسات</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="اسم تعريفي للجدول" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div id="fuSingleFile" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow @error('img') border border-danger @enderror">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>حدد صورة لجدول المقاسات</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="custom-file-container" data-upload-id="myFirstImage">
                    <label>حذف الصورة المحدده<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                    <label class="custom-file-container__custom-file" >
                        <input name="img" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/jpeg,png,jpg,svg">
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    <div class="custom-file-container__image-preview"></div>
                </div>
            </div>
        </div>
        @error('img')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>{{$message}}</strong></span>@enderror
    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة جدول مقاسات جديد</button>
</form>
