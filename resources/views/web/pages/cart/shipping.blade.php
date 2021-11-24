<div class="col-xl-4">
    <div class="pt-shopcart-wrapperaside form-default">
        <form id="shopcartform"  method="post"  action="{{route('web.order.store')}}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-12">
                    <div class="pt-shopcart-box">
                        <h6 class="pt-title">بيانات الطلب</h6>
                        <p>
                            لاتمام عملة الدفع وشحن المنتجات من فضلك املاء البيانات التالية
                        </p>
                        <div class="form-wrapper">
                            <div class="form-group">
                                <label for="name">الاسم الشخصي *</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" required value="{{$name}}">
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">رقم الهاتف *</label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" required value="{{$phone}}">
                                @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="email">البريد *</label>--}}
{{--                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required value="{{$email}}">--}}
{{--                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                            </div>--}}
{{--                            @guest()--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="password">كلمة مرور مكونة من 8 ارقام او حروف *</label>--}}
{{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}
{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            @endguest--}}

                            <div class="form-group">
                                <label for="address">عنوان الشحن *</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" required value="{{$address}}">
                                @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="country">الدولة</label>
                                <select name="country" class="form-control  @error('country') is-invalid @enderror" id="country" required>
                                    @foreach($countries as $country)
                                        <option {{$country_id == $country->id ? "selected"  : ''}} data-areas="{{$country->areas}}" value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                    @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </select>
                                @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="area">المدينة</label>
                                <select name="area" class="form-control  @error('area') is-invalid @enderror" id="area" required>
                                </select>
                                @error('area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="shipping-SA-country">
                                <div class="alert-info p-2 cover-shiiping-price">
                                    سعر الشحن
                                    <span id="area-shipping-price">0</span>
                                    ريال
                                </div>
                                <div class="alert-success p-2">
                                    اذا كان صافي المنتجات اكثر من 300 ريال سوف تحصل علي شحن مجاني
                                </div>
                            </div>
                            <div class="shipping-other-country d-none">
                                <div class="alert-info p-2 cover-shiiping-price">
                                    @lang('customString.otherShippingCountry')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-12">
                    <div class="pt-shopcart-box bg-info">
                        <h6 class="pt-title mb-2">اختيار طريقة الدفع</h6>

                        <div class="checkbox-group cache-payment">
                            <input {{old('payment') == "cache" ? "checked"  : ''}}  type="radio" id="cache" name="payment" checked="" value="cache">
                            <label for="cache" class="text-white">
                                الدفع عند الاستلام
                            </label>
                            @error('payment')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div id="cache-box" class="alert alert-info text-sm cache-payment">
                            سوف يتم الدفع نقدا عند استلام الطلب
                        </div>

                        <div class="checkbox-group">
                            <input {{old('payment') == "bank" ? "checked"  : ''}}  type="radio" id="bank" name="payment" value="bank">
                            <label for="bank" class="text-white">
                                الدفع من خلال الحسابات البنكية
                            </label>
                        </div>
                        <div id="bank-box" class="d-none">

                            <div  class="alert alert-info text-sm">
                                من فضلك قم بتحويل المبلغ علي احد الحسابات التالية ثم قم بارفاق صورة الدفع
                            </div>
                            <div class="img-fluid">
                                <img src="{{asset('assets/web/images/account.jpg')}}" alt="payment" onclick=" window.open('{{asset('assets/web/images/account.jpg')}}', '_blank').focus();" style="cursor: pointer">
                            </div>

                            <div class="form-group">
                                <label for="img_payment">ارفاق صورة التحويل</label>
                                <input type="file" name="img_payment" class="form-control @error('img_payment') is-invalid @enderror" id="img_payment"  value="{{old('img_payment')}}">
                                @error('img_payment')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                    @error('payment')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

                </div>
                <div class="col-md-6 col-lg-6 col-xl-12">
                    <div class="pt-shopcart-box">
                        <h6 class="pt-title">ملاحظة</h6>
                        <p>
                            اذا كانت هناك اي ملاحظات حول عملية الشحن او الطلب فلا تترد باخبارنا بها
                        </p>
                        <div class="form-default form-wrapper">
                            <textarea name="not" class="form-control  @error('not') is-invalid @enderror" rows="5" placeholder="Enter message" id="textareaMessage">{{old('not')}}</textarea>
                        </div>
                        @error('not')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-12">
                    <div class="pt-shopcart-box bg-danger">
                        <h6 class="pt-title text-white">هل تمتلك قسيمة شراء</h6>
                        <p class="text-white">
                           اذا كنت تمتلك قسيمة مشتريات من ميرال ادخل الكود الان واحصل علي الخصم في هاذا الطلب
                        </p>
                        <div class="form-default form-wrapper">
                            <input type="text" name="serial" class="form-control @error('serial') is-invalid @enderror" id="serial" required  placeholder="Enter serial" value="{{old('serial')}}">
                        </div>
                        @error('serial')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 col-xl-12">
                    <div class="pt-shopcart-total">
                        @php($sumOrder = round($carts->map->price->sum() , 2) )
                        @php($tax = round(($sumOrder * 15)/100 , 2) )
                        <div class="pt-price-01" id="order-price" data-price="{{$sumOrder}}">ملخص السلة: <span>{{$sumOrder - $tax}}</span> ريال</div>
                        <div class="pt-price-01 mt-1" id="order-shipping"> الشحن: <span>0</span> ريال</div>
                        <div class="pt-price-01 mt-1" id="order-tax"> الضريبة: <span>{{$tax}}</span> ريال</div>
                        <div class="pt-price-02" id="order-total" style="font-size: 25px">
                           اجمالي الطلب: <span></span> ريال
                        </div>
{{--                        <div class="checkbox-group">--}}
{{--                            <input type="checkbox" id="checkBox41" name="checkbox" checked="">--}}
{{--                            <label for="checkBox41">--}}
{{--                                <span class="check"></span>--}}
{{--                                <span class="box"></span>--}}
{{--                                I agree with the terms and conditions--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <button class="btn btn-block" type="submit">
                            <span class="pt-text">
                                اتمام عملية الدفع
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


