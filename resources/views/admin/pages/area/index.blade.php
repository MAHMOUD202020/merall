@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>المدن</span></li>
@endsection

@section('content')

    @include('admin.inc.modalBtnAction')

    {!! myDataTable_button([
        'اضافة مدينة جديد' => route('admin.area.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"             => 'id',
        "name"           => 'الاسم',
        "slug"           => 'slug',
        "shipping_price" => 'سعر الشحن',
        "cache"          => 'الدفع عند الاستلام',
        "country_id"     => 'الدولة',
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let country_id = '@json($countries)';
        let cache = '@json(['0' => 'غير متاح' , '1' => 'متاح'])';

        myDataTableColumns({
            name:  ['id', 'name' , 'slug' , 'shipping_price' , 'cache' ,'country_id'],
            input:{'shipping_price':'number'},
            select: {country_id , cache},
            alias: {country_id , cache},
            btn :  {
                'edit': '{{url('admin/area/{id}')}}',
                'delete': '{{url('admin/area/{id}')}}',
                'print': '#',
            }
        })
    </script>
@endsection
