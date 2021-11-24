@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">اختيار المسئول</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>تويع الصلاحيات</span></li>
@endsection

@section('content')
    @include('admin.inc.message_success')



    <a class="btn btn-info btnChecked selectAll mb-2 bg-dark">تحديد الكل</a>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title bg-danger p-2">تويع الصلاحيات للمسئول <span class="text-dark">{{$admin->name}}</span></h6>
                <div class="table-responsive">
                    <form action="{{route('admin.roles.update' , $admin->id)}}" method="post">
                        @csrf
                        {{method_field('PUT')}}
                       <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحالة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($lastNameRole = '')
                        @foreach($roles as $role)
                            @php($roleNow =  explode( '.' , $role->name)[0])
                            @if ($roleNow !== $lastNameRole)
                                <tr>
                                    <td class="title" colspan="2">@lang("roles.title.".preg_replace("/.index/" , '' , $role->name ))</td>
                                </tr>
                            @endif
                            <tr>
                                <th>@lang("roles.names.".preg_replace("/[a-z]+\./" , '' , $role->name ))</th>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input  name="name[]" type="checkbox" value="{{$role->id}}" {{in_array($role->name , $roleChecked) ? 'checked'  : ''}} class="form-check-input">
                                            <i class="input-frame"></i></label>
                                    </div>
                                </td>
                            </tr>
                            @php($lastNameRole =  explode( '.' , $role->name)[0])
                        @endforeach
                        </tbody>
                    </table>
                        <button class="btn btn-info mt-5 d-block m-auto w-100 font-weight-bold">تعديل الصلاحيات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function (){

            $('.btnChecked').on('click' , function (){

                if ($(this).hasClass('selectAll')) {
                    $('input').each(function () {

                        $(this).prop('checked', true)
                    })

                    $(this).removeClass('selectAll').addClass('deSelectAll').text('الغاء تحديد الكل')

                }else {

                    if ($(this).hasClass('deSelectAll')) {

                        $('input').each(function () {

                            $(this).prop('checked', false)
                        })
                        $(this).addClass('selectAll').removeClass('deSelectAll').text(' تحديد الكل')

                    }
                }
            })
        });


    </script>
@endsection

@section('css')
    <style>
        table .title {
            font-size: 20px;
            font-weight: bold;
            padding: 26px 0;
            background-color: #782c47;
            text-align: center;
            color: white !important;

        }

    </style>
@endsection

@section('js')

@endsection
