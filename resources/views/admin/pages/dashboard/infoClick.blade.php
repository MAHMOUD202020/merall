@extends('admin.master')

@section('content')

    <?php
    use Stevebauman\Location\Facades\Location;
    ?>

    <div class="container bg-light ">
        <table class="table ">
            <thead>
            <tr>
                <th scope="col">القسم</th>
                <th scope="col">اللوكيشن </th>
                <th scope="col">التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @php($names = ['sales' => 'الاستفسارات' , 'abayas' => 'الملابس'])
            @foreach($data as $click)
                <tr>
                    <td>{{$names[$click->type]}} </td>
                    <td>
                        @php($loaction = Location::get($click->ip))
                        @if ($loaction)
                            دولة  {{$loaction->countryName .' محافظة '. $loaction->cityName}}
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


