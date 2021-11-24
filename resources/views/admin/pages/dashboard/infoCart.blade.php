@extends('admin.master')

@section('content')

    <?php
        use Stevebauman\Location\Facades\Location;
    ?>

    <div class="container bg-light ">
        <table class="table ">
            <thead>
            <tr>
                <th scope="col">السلة</th>
                <th scope="col">عدد المنتجات</th>
                <th scope="col">صاحب السلة</th>
                <th scope="col">التاريخ</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $key => $click)
{{--                @php($infoCart = $click->first())--}}
                <tr>
                    <td>{{$loop->index}} </td>
                    <td>{{$click->num}}</td>
                    <td>
                        @if ($click->user_id)

                            {{$click->user->name}}

                        @else

                            @php($loaction = Location::get($click->guest_ip))
                            زائر من دولة  {{$loaction->countryName .' محافظة '. $loaction->cityName}}
                        @endif
                    </td>
                    <td>{{$click->created_at}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-3 text-center">
            {!! $data->links() !!}
        </div>

    </div>
@endsection


