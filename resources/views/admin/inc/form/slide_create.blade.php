<form method="post" action="{{route('admin.slide.store')}}" enctype="multipart/form-data">
    @csrf
    <div id="fuSingleFile" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow @error('img') border border-danger @enderror">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>الصورة الرئسية للمنتج</h4>
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

    <div class="form-row mb-4">
        <div class="form-group col-md-6">
            <label for="description">وصف الشريحة (اختياري)</label>
            <input maxlength="255" name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="النص الظاهر فوق الصوره" value="{{old('description')}}" >
            @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="textLink">عنوان الرابط (اختياري)</label>
            <input maxlength="255" name="textLink" type="text" class="form-control @error('textLink') is-invalid @enderror" id="textLink" placeholder="النص الظاهر فوق الزر" value="{{old('textLink')}}" >
            @error('textLink')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="link"> الرابط (اختياري)</label>
            <input maxlength="255" name="link" type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="رابط ال url" value="{{old('link')}}" >
            @error('link')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">اضافة شريحة جديده</button>
</form>
