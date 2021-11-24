@extends('web.master')

@php($title_page      = 'تسجيل الدخول')
@php($title_seo       = 'تسجيل الدخول')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>الحساب</li>
    <li>تسحيل الدخول</li>
@endsection

@section('content')

<div class="container-indent">
    <div class="container">
        <h1 class="pt-title-subpages noborder">هل لديك حساب بالفعل</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <h2 class="pt-title-page text-center">تسجيل الدخول</h2>
                <form id="login-form" class="form-default form-layout-01" method="POST"  novalidate="novalidate"  action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">البريد الالكتروني</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group d-none">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="row-btn">
                        <button type="submit" class="btn btn-block">                                   تسجيل الدخول</button>
                        <a href="{{route('password.request')}}" class="btn-link btn-block btn-lg"><span class="pt-text">هل نسيت كلمة المرور ؟</span></a>
                    </div>
                    <div class="form-content">
                        <h3 class="pt-title-page text-center">عميل جديد</h3>
                        من خلال إنشاء حساب في متجرنا ، ستتمكن من التنقل خلال عملية الدفع بشكل أسرع ، وتخزين عناوين شحن متعددة ، وعرض وتتبع طلباتك في حسابك والمزيد.
                        <button type="submit" class="btn btn-dark btn-block btn-top">تسجيل حساب</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
