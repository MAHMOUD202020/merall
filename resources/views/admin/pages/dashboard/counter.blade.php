<div class="container m-5">
    <div class="row">
        <div class="four col-md-3">
            <a href="{{route('admin.dashboard.show' , 'sales')}}">
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$salesCount}}</span>
                    <p>عدد التواصل مع قسم الاستفسارات</p>
                </div>
            </a>
        </div>

        <div class="four col-md-3">
            <a href="{{route('admin.dashboard.show' , 'abayas')}}">
                <div class="counter-box colored"> <i class="fa fa-group"></i> <span class="counter">{{$abayasCount}}</span>
                    <p>عدد التواصل مع قسم الملابس</p>
                </div>
            </a>
        </div>

        <div class="four col-md-3">
            <a href="{{route('admin.dashboard.show' , 'cartUser')}}">
                <div class="counter-box colored"> <i class="fa fa-group"></i> <span class="counter">{{$cartUserCount}}</span>
                    <p>عدد السلات المتروكة من الاعضاء</p>
                </div>
            </a>
        </div>

        <div class="four col-md-3">
            <a href="{{route('admin.dashboard.show' , 'cartGuest')}}">
                <div class="counter-box colored"> <i class="fa fa-group"></i> <span class="counter">{{$cartGuestCount}}</span>
                    <p>عدد السلات المتروكة من الزوار</p>
                </div>
            </a>
        </div>

    </div>
</div>
