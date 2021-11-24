<div class="row">

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="">المنتجات الاكثر مبيعاً</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">الصورة</div></th>
                            <th><div class="th-content">اسم المنتج</div></th>
                            <th><div class="th-content">السعر</div></th>
                            <th><div class="th-content">الخصم</div></th>
                            <th><div class="th-content">عدد الطلبات</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topProducts as $product)
                            <tr>
                                <td><div class="td-content customer-name"><img src="{{asset("assets/web/images/products/min/small_$product->img")}}" alt="avatar"></div></td>
                                <td><div class="td-content product-brand">{{$product->name}}</div></td>
                                <td><div class="td-content">{{$product->price}} </div></td>
                                <td><div class="td-content pricing"><span class="">{{$product->discount}} </span></div></td>
                                <td><div class="td-content"><span class="badge outline-badge-primary">{{$product->carts_count}}</span></div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="">المنتجات الاقل مبيعاً</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">الصورة</div></th>
                            <th><div class="th-content">اسم المنتج</div></th>
                            <th><div class="th-content">السعر</div></th>
                            <th><div class="th-content">الخصم</div></th>
                            <th><div class="th-content">عدد الطلبات</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessProducts as $product)
                            <tr>
                                <td><div class="td-content customer-name"><img src="{{asset("assets/web/images/products/min/small_$product->img")}}" alt="avatar"></div></td>
                                <td><div class="td-content product-brand">{{$product->name}}</div></td>
                                <td><div class="td-content">{{$product->price}} </div></td>
                                <td><div class="td-content pricing"><span class="">{{$product->discount}} </span></div></td>
                                <td><div class="td-content"><span class="badge outline-badge-primary">{{$product->carts_count}}</span></div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
