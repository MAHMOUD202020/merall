@php($title_page      = 'سلة التسوق')
@php($title_seo       = 'سلة التسوق')
@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>سلة التسوق</li>
@endsection

@section('content')

    @php($authCheck  = auth()->check())
    @php($name       = old('name') ? old('name') :( $authCheck ? auth()->user()->name : ''))
    @php($email      = old('email') ? old('email') : ($authCheck ? auth()->user()->email : ''))
    @php($address    = old('address') ? old('address') : ($authCheck ? auth()->user()->address : ''))
    @php($phone      = old('phone') ? old('phone') : ($authCheck ? auth()->user()->phone : ''))
    @php($country_id = old('country') ? old('country') : ($authCheck ? auth()->user()->country_id : 0))
    @php($area_id    = old('area') ? old('area') : ($authCheck ? auth()->user()->area_id : 0))

    @if ($carts->count() > 0)

        <main id="pt-pageContent">
            @if (session()->has('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">{!!session('error')!!}</div>
            @endif
            <div class="container-indent">
                <div class="container">
                    <h1 class="pt-title-subpages noborder">سلة التسوق</h1>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="pt-shopcart-page size-small">
                                <form method="post" action="{{route('web.cart.update' , 0)}}" id="form-update-cart">
                                   @csrf
                                    {{method_field('put')}}
                                    @include('web.pages.cart.product')
                                    <div class="pt-shopcart-btn">
                                        <div class="pt-col">
                                            <a href="{{url('/')}}" class="btn-link btn-lg">
                                                <div class="pt-icon">
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#icon-arrow_large_left"></use>
                                                    </svg>
                                                </div>
                                                <span class="pt-text">العودة الي التسوق</span>
                                            </a>
                                        </div>
                                        <div class="pt-col">
                                            <a href="{{route('web.cart.cart_delete_all')}}" class="btn-link btn-lg">
                                                <div class="pt-icon">
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#icon-remove"></use>
                                                    </svg>
                                                </div>
                                                <span class="pt-text">حذف كل المنتجات من السلة</span>
                                            </a>
                                            <a href="#" class="btn-link btn-lg" id="btn-update-cart">
                                                <div class="pt-icon">
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#icon-update"></use>
                                                    </svg>
                                                </div>
                                                <span class="pt-text">تحديث التعديلات في السلة</span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @include('web.pages.cart.shipping')
                    </div>
                </div>
            </div>
        </main>
        <form method="post" action="" class="d-none" id="form_delete_product">
            @csrf
            {{method_field('delete')}}
        </form>
    @else
        @include('web.pages.cart.empty')
    @endif
@endsection

@section('js')

    <script>
        area_selected = '{{$area_id}}';

        $(function (){

            $('.minus-btn , .plus-btn').on('click' , function (){

                let  $this = $(this);

                setTimeout(function (){

                    let $inputQ = $this.siblings('input');

                    $.ajax({
                        method:'post',
                        url:location.origin+'/cart_update_count/'+$inputQ.attr('data-id'),
                        data:{'quantity' : $inputQ.val()}
                    } , 150)
                })
            })
        })
    </script>
    <script src="{{asset('assets/web/js/cart.js')}}"></script>

@endsection
