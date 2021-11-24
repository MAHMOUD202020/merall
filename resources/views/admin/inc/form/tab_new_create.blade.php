<form method="post" action="{{route('admin.news.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-12">
            <label for="value">محتوي الخبر</label>
            <input name="value" type="text" class="form-control @error('value') is-invalid @enderror" id="value" placeholder="محتوي الخبر مثل معلومات عن العرض او الخصم" value="{{old('value')}}" required maxlength="75">
            @error('value')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-12">
            <label for="link">الرابط</label>
            <input name="link" type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="link الخاص بالخبر مثل رابط المنتج في الموقع" value="{{old('link')}}">
            @error('link')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-12">
            <label for="type">تحديد نوع الخبر</label>
            <select name="type" class="form-control  @error('type') is-invalid @enderror" id="type" required>
                    <option value="0">خبر عادي</option>
                    <option value="1">خبر مميز</option>
            </select>
            @error('type')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة خبر جديد</button>
</form>
