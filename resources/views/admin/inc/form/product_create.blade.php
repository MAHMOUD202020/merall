<form  id="form_create_post" method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
  @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">اسم المنتج</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="الاسم الظاهر في الموقع" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="slug">ال slug</label>
            <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="الاسم الظاهر في  ال url" value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="price">السعر</label>
            <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="سعر المنتج" value="{{old('price')}}" step="any" required>
            @error('price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-6">
            <label for="discount">السعر بعد الخصم (اختياري)</label>
            <input name="discount" type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="سعر المنتج بعد اضافة الخصم علية" value="{{old('discount')}}" step="any">
            @error('discount')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-6">
            <label for="sizeChart">جدول المقاسات</label>
            <select name="sizeChart"  id="sizeChart" class="form-control">
                <option value="{{null}}">بدون جدول مقاسات</option>
                @foreach($sizeCharts as $sizeChart)
                    <option  {{old('sizeChart') == $sizeChart->id ? 'selected' : ''}} value="{{$sizeChart->id}}">
                        {{$sizeChart->name}}
                    </option>
                @endforeach
            </select>
            @error('sizeChart')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-12  @error('sizes') border border-danger @enderror">
            <label for="section_id">تحديد المقاسات للمنتج</label>
            <div class="widget cover-size">
                @php($oldSizes = old('sizes') ? old('sizes') : [])
                @foreach($sizes as $size)
                    <div class="custom-control custom-checkbox">
                        <input name="sizes[]"  value="{{$size->id}}" type="checkbox" class="custom-control-input cat-checkbox" id="check-{{$size->id}}" {{ in_array($size->id , $oldSizes) ? 'checked' : ''}}>
                        <label class="custom-control-label" for="check-{{$size->id}}">{{$size->name}}</label>
                    </div>
                @endforeach
            </div>
            @error('sizes')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>{{$message}}</strong></span>@enderror
        </div>

        <div class="form-group col-12  @error('cats') border border-danger @enderror">
            <label for="section_id">تحديد الاقسام والتصنيفات للمنتج</label>
            <div class="widget cover-cats">
                @php($oldCats = old('cats') ? old('cats') : [])
                @foreach($sections as $section)
                    <label for="section_id" class="d-block text-black">{{$section->name}}</label>
                    <div class="widget mt-3 mb-3">
                        @foreach($section->cats as $cat)
                            <div class="custom-control custom-checkbox">
                                <input name="cats[]"  value="{{$cat->id}}" type="checkbox" class="custom-control-input cat-checkbox" id="check-{{$cat->slug}}" {{ in_array($cat->id , $oldCats) ? 'checked' : ''}}>
                                <label class="custom-control-label" for="check-{{$cat->slug}}">{{$cat->name}}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            @error('cats')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>يجب اختيار تصنيف واحد علي الاقل</strong></span>@enderror
        </div>

        <div class="container">

            <div id="tooltip" class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
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
                            <input name="img" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" required>
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                    <div class="form-group ">
                        <label for="alt">Alt Text (Seo)</label>
                        <input name="alt" type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" placeholder="الاسم المعبر عن الصورة في حالة تركة فارغا سوف يتم تعين اسم المنتج  كا قيمة مدخلة لهاذا الحقل" value="{{old('alt')}}">
                        @error('alt')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
            </div>
            @error('img')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>{{$message}}</strong></span>@enderror
        </div>
        <div id="fuMultipleFile" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow  @error('images') border border-danger @enderror">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>معرض الصور للمنتج</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="custom-file-container" data-upload-id="mySecondImage">
                        <label>حذف الصور المحددة <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input name="images[]" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" multiple>
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="alt_images">Alt Text (Seo)</label>
                    <input name="alt_images" type="text" class="form-control @error('alt_images') is-invalid @enderror" id="alt_images" placeholder="الاسم المعبر عن الصورة في حالة تركة فارغا سوف يتم تعين اسم المنتج  كا قيمة مدخلة لهاذا الحقل" value="{{old('alt_images')}}">
                    @error('alt_images')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
            </div>
            @error('images')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>{{$message}}</strong></span>@enderror
        </div>

        <div class="form-group col-12">
            <label for="other">خصائص اخرى</label>
            <div class="widget">
                <label for="other" class="d-block text-black"></label>
                <div class=" mt-3 mb-3">
                    <div class="custom-control custom-checkbox mb-4">
                        <input name="premium" type="checkbox" class="custom-control-input" id="premium" {{old('premium') ? 'checked' : ''}}>
                        <label class="custom-control-label" for="premium">تميز المنتج</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input name="available" type="checkbox" class="custom-control-input" id="available" {{old('available') ? 'checked' : ''}}>
                        <label class="custom-control-label" for="available">المنتج غير متاح حاليا</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group col-12">
            <label for="colors" class="mt-3">
                لون المنتج
            </label>
            <div class="widget  cover-colors">
                <label for="colors" class="d-block text-black"></label>

                <div class="row mb-4 mt-3">
                    <div class="col-sm-3 col-12 bg-light pt-3 pb-3">
                        <div class="nav flex-column nav-pills mb-sm-0 mb-3 text-center mx-auto" id="v-line-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-3" id="v-line-pills-home-tab" data-toggle="pill" href="#v-line-pills-home" role="tab" aria-controls="v-line-pills-home" aria-selected="true">عرض الالوان العامة</a>
                            <a class="nav-link mb-3  text-center" id="v-line-pills-profile-tab" data-toggle="pill" href="#v-line-pills-profile" role="tab" aria-controls="v-line-pills-profile" aria-selected="false">عرض الالوان المخصصة</a>
                            <a class="btn btn-secondary" data-toggle="modal" data-target="#modal_create_color_cover">اضافة لون جديد</a>

                        </div>
                    </div>

                    <div class="col-sm-9 col-12">
                        <div class="tab-content" id="v-line-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-line-pills-home" role="tabpanel" aria-labelledby="v-line-pills-home-tab">
                                <div class=" mt-3 mb-3" id="cover_all_colors">
                                    @foreach($colors_all as $color)
                                        <div class="custom-control custom-checkbox mb-4">
                                            <input  value="{{$color->id}}" name="colors[]" type="checkbox" class="custom-control-input" id="{{$color->slug}}">
                                            <label class="custom-control-label" for="{{$color->slug}}">
                                                {{$color->name}}
                                                <img src="{{asset("assets/web/images/colors/min/small_$color->img")}}" alt="{{$color->alt}}" class="img-fluid d-block" width="50px">
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="tab-pane fade" id="v-line-pills-profile" role="tabpanel" aria-labelledby="v-line-pills-profile-tab">
                                <div class=" mt-3 mb-3" id="cover_custom_colors">
                                    @foreach($colors_custom as $color)
                                    <div class="custom-control custom-checkbox mb-4">
                                        <input  value="{{$color->id}}" name="colors[]" type="checkbox" class="custom-control-input" id="{{$color->slug}}">
                                        <label class="custom-control-label" for="{{$color->slug}}">
                                            {{$color->name}}
                                            <img src="{{asset("assets/web/images/colors/min/small_$color->img")}}" alt="{{$color->alt}}" class="img-fluid d-block" width="50px">
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                        </div>
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
                <textarea name="seo_title" type="number" class="form-control  @error('seo_title') is-invalid @enderror" id="seo_title"   maxlength="255" rows="4">{{old('seo_title')}}</textarea>
                @error('seo_title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>

            <div class="form-group col-12">
                <label for="keyword_tag">الكلمات المفتاحة للمنتج (اختياري)  (Keyword Tag) اقصي حد 255 حرف افصل بسن كل كلمة مفتاحية بعلامة الكومة , في حالة تركة فارغا يتم تقطيع وصف المنتج وتحويلة الي كلمات مفتاحية</label>
                <textarea name="keyword_tag" type="number" class="form-control  @error('keyword_tag') is-invalid @enderror" id="keyword_tag"   maxlength="255" rows="4">{{old('keyword_tag')}}</textarea>
                @error('keyword_tag')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة منتج جديد</button>
</form>
