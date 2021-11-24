<form method="post" action="{{route('admin.post.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">
        <div class="form-group col-md-6">
            <label for="title">عنوان المقالة الرئيسي(اقصي حد 100 حرف)</label>
            <input name="title" type="text" maxlength="100" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="الاسم الظاهر في صفحة المدونة" value="{{old('title')}}" required>
            @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="slug"> ال slug (اختياري)</label>
            <input name="slug" maxlength="100" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="الاسم الظاهر في  ال url" value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="subtitle">عنوان المقالة الفرعي  (اقصي حد 255 حرف)</label>
            <input name="subtitle" type="text" maxlength="100" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" placeholder="الاسم الظاهر في اول المقالة" value="{{old('subtitle')}}" required>
            @error('subtitle')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="catBlog_id">تحديد التصنيف الخاص بالمقالة</label>
            <select name="catBlog_id" class="form-control  @error('catBlog_id') is-invalid @enderror" id="catBlog_id" required>
                @foreach($catBlog as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
            @error('catBlog_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-12">
            <label for="tags">التاجات (افصل بين كل كلمة ب علامة ,)</label>
            <textarea name="tags"  maxlength="255" class="form-control @error('tags') is-invalid @enderror" id="tags" required> {{old('tags')}} </textarea>
            @error('tags')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>


    <div id="fuSingleFile" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow @error('img') border border-danger @enderror">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>الصورة الرئسية للمقالة</h4>
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


    <div class="container">
        @error('description')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror

        <div id="tooltip" class="row layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow @error('description') border border-danger @enderror">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <label for="mytextarea"> وصف المنتج </label>
                            </div>
                        </div>
                    </div>
                    <textarea id="mytextarea" name="description">{{old('description')}}</textarea>
                </div>
            </div>
        </div>

    </div>

    <div class="col12 d-block m-auto pt-3 pb-3">
        <a href="#" class="btn  border-info show_section_seo">عرض خصائص ال Seo للمنتج</a>
    </div>
    <div class="cover_seo  d-none row">

        <div class="form-group col-12">
            <label for="meta_description">وصف المنتج في ال Seo (اختياري)  (Meta Description) اقصي حد 255 حرف في حالة تركة فارغا سوف يتم قطع 255 حرف من وصف المنتح وتعينها كا قيمة له</label>
            <textarea name="meta_description" type="number" class="form-control  @error('meta_description') is-invalid @enderror" id="meta_description"   maxlength="255" rows="4">{{old('meta_description')}}</textarea>
            @error('meta_description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-12">
            <label for="seo_title"> عنوان المنتج في ال Seo (اختياري)  (Title) اقصي حد 255 حرف  في حالة تركة فارغا يتم تعين العنوان الرئيسي للمنتج كا قيمة لة</label>
            <textarea name="seo_title"  type="number" class="form-control  @error('seo_title') is-invalid @enderror" id="seo_title"   maxlength="255" rows="4">{{old('seo_title')}}</textarea>
            @error('seo_title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة مقالة جديدة</button>
</form>
