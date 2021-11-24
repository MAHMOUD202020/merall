<form method="post" action="{{route('admin.coupon.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">اسم القسيمة</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="اسم يدل علي القسيمة" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="end_at">تاريخ الانتهاء</label>
            <input name="end_at" type="date" class="form-control @error('end_at') is-invalid @enderror" id="end_at" value="{{old('end_at') ? old('end_at') : \Illuminate\Support\Carbon::now()->addMonth()->format('Y-m-d')}}" required >
            @error('end_at')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="type">تاريخ الانتهاء</label>
            <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                <option value="0"> نسبة مئوية</option>
                <option value="1"> مبلغ مالي</option>
            </select>
            @error('type')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="discount">قيمة الخصم</label>
            <input name="discount" type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="المبلغ او النسبة التي يتم خصمها" value="{{old('discount')}}" required>
            @error('discount')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="min_price">اقل مبلغ للاوردر لاستخدام القسيمة</label>
            <input name="min_price" type="number" class="form-control @error('min_price') is-invalid @enderror" id="min_price" placeholder="اذا كان يجب ان يتخطي الطلب قيمة مشتريات معينة" value="{{old('min_price') ? old('min_price') : 0}}" required>
            @error('min_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="limit">عدد المرات المتاحة لاستخدام القسيمة</label>
            <input name="limit" type="number" class="form-control @error('limit') is-invalid @enderror" id="limit" placeholder="كم مستخدم في الموقع بامكانهم استخدام القسمية" value="{{old('limit') ? old('limit') : 10000}}" required>
            @error('limit')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="limit_user">عدد المرات المتاحة لاستخدام القسيمة لنفس المستخدم</label>
            <input name="limit_user" type="number" class="form-control @error('limit_user') is-invalid @enderror" id="limit_user" placeholder="كم مره يمكن ان يستخدم نفس المستخدم هاذه القسيمة" value="{{old('limit_user') ? old('limit_user') : 1}}" required>
            @error('limit_user')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">اضافة قسيمة جديد</button>
</form>
