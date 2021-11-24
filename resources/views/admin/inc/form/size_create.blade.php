<form method="post" action="{{route('admin.size.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">
        <div class="form-group col-md-12">
            <label for="name">اسم المقاس</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="اسم تعريفي  للمقاس" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-row mb-4">
        <div class="form-group col-md-12">
            <label for="sort">الترتيب</label>
            <input name="sort" type="number" class="form-control @error('sort') is-invalid @enderror" id="sort" placeholder="التريتب تنازلي" value="{{old('sort') ? old('sort') : 0}}">
            @error('sort')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">اضافة مقاس جديد</button>
</form>
