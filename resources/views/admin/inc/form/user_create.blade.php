<form method="post" action="{{Route::currentRouteName() === "admin.user.store" ? route('admin.user.store') : route('admin.admin.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">الاسم</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="الاسم الظاهر في الموقع" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="email">البريد الالكتروني</label>
            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="الاسم الظاهر في  ال url" value="{{old('email')}}">
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="country">الدولة</label>
                <select name="country" class="form-control  @error('country') is-invalid @enderror" id="country" required>
                    @foreach($countries as $country)
                        <option data-areas="{{$country->areas->pluck('name' , 'id')}}" value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                    @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </select>
            @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="area">المدينة</label>
            <select name="area" class="form-control  @error('area') is-invalid @enderror" id="area" required>
                @foreach($countries->first()->areas as $area)
                    <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
                @error('area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </select>
            @error('area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-6">
            <label for="phone">رقم الهاتف</label>
            <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{old('phone')}}" required>
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-6">
            <label for="password">كلمة المرور</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{old('password')}}" required>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة مستخدم جديد</button>
</form>
