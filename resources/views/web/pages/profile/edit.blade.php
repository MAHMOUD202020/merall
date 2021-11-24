@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li><a href="{{route('profile.index')}}">الملف الشخصي</a></li>
    <li>تعديل البيانات الشخصية</li>
@endsection
@section('content')

    @php($name       = old('name') ? old('name') : auth()->user()->name)
    @php($email      = old('email') ? old('email') : auth()->user()->email)
    @php($address    = old('address') ? old('address') : auth()->user()->address )
    @php($phone      = old('phone') ? old('phone') : auth()->user()->phone )
    @php($country_id = old('country') ? old('country') : auth()->user()->country_id )
    @php($area_id    = old('area') ? old('area') : auth()->user()->area_id )

    <div class="container-indent">
        @if (session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="pt-title-page text-center">املاء البيانات التالية</h2>
                    <form id="login-form" class="form-default form-layout-01" method="POST" action="{{route('profile.update' , auth()->id())}}" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="name">الاسم الخاص بك *</label>
                            <div class="form-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $name }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">البريد الالكتروني الخاص بك *</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">رقم الهاتف الشخصي *</label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $phone }}" required autocomplete="phone">
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
                                    <option {{$country_id == $country->id ? "select"  : ''}} data-areas="{{$country->areas->pluck('name' , 'id')}}" value="{{$country->id}}">{{$country->name}}</option>
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

                        <div class="form-group">
                            <label for="address">عنوان الشحن الافتراضي (يمكنك تغيره في كل اوردر الي اي عنوان اخر)</label>
                            <textarea id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address"  required autocomplete="address">{{ $address }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row-btn">
                            <button type="submit" class="btn btn-block">تعديل البيانات الشخصية</button>
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

            selectArea_method($('#country'))

            function selectArea_method($this) {

                let data = $.parseJSON($this.find(':selected').attr('data-areas'));
                $.each(data, function ($id, $name) {

                    let  isSelected = $id == {{$area_id}} ? 'selected' : '';

                    areas.push("<option "+isSelected+" value='" + $id +"'>" + $name + "</option>")

                })

                selectArea.html(areas);
                areas = [];
            }
        });

    </script>
@endsection
