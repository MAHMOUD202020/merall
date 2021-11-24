<form method="post" action="{{route('admin.area.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">اسم المدينة</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="الاسم الظاهر في الموقع" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="slug">ال slug</label>
            <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="الاسم الظاهر في  ال url" value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="shipping_price">سعر الشحن للمدينة</label>
            <input name="shipping_price" type="text" class="form-control @error('shipping_price') is-invalid @enderror" id="shipping_price" placeholder="مثال: 75" value="{{old('shipping_price')}}">
            @error('shipping_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="cache">الدفع عند الاستلام</label>
            <select name="cache" class="form-control  @error('cache') is-invalid @enderror" id="cache" required>
                <option value="1">متاح</option>
                <option value="0">غير متاح</option>
            </select>
            @error('cache')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="country_id">تحديد الدولة الخاصة بالمدينة</label>
            <select name="country_id" class="form-control  @error('country_id') is-invalid @enderror" id="country_id" required>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            @error('country_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة مدينة جديد</button>
</form>
