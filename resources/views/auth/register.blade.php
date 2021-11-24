@extends('web.master')

@php($title_page      = 'التسجيل')
@php($title_seo       = 'التسجيل')


@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>الحساب</li>
    <li>التسجيل</li>
@endsection

@section('content')
<div class="container-indent">
    <div class="container">
        <h1 class="pt-title-subpages noborder">تسجيل حساب جديد</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <h2 class="pt-title-page text-center">املاء البيانات التالية</h2>
                <form id="login-form" class="form-default form-layout-01" method="POST" action="{{ route('register') }}" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="name">الاسم الخاص بك *</label>
                        <div class="form-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الالكتروني الخاص بك *</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الهاتف الشخصي *</label>
                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">الدولة</label>
                        <select name="country" class="form-control  @error('country') is-invalid @enderror" id="country" required>
                            @foreach($countries as $country)
                                <option data-areas="{{$country->areas->pluck('name' , 'id')}}" value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                            @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </select>
                        @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="area">المدينة</label>
                        <select name="area" class="form-control  @error('area') is-invalid @enderror" id="area" required>
                            @foreach($countries->first()->areas as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                            @endforeach
                            @error('area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </select>
                        @error('area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة مرور مكونة من 8 ارقام او حروف *</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row-btn">
                        <button type="submit" class="btn btn-block">تسجيل</button>
                        <a href="{{route('login')}}" class="btn-link btn-block btn-lg"><span class="pt-text">لدي حساب بالفعل</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(function () {

            let selectArea = $('#area'),
                areas = [];

            $('#country').on('change', function (e) {

                selectArea_method($(this));
            });


            function selectArea_method($this) {

                let data = $.parseJSON($this.find(':selected').attr('data-areas'));
                $.each(data, function ($id, $name) {


                    areas.push("<option  value='" + $id +"'>" + $name + "</option>")

                })

                selectArea.html(areas);
                areas = [];
            }
        });
    </script>
@endsection
