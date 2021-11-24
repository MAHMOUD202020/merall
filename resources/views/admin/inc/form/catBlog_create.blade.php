<form method="post" action="{{route('admin.catBlog.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">اسم التصنيف</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="الاسم الظاهر في الموقع" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="slug">ال slug</label>
            <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="الاسم الظاهر في  ال url" value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة تصنيف جديد</button>
</form>
