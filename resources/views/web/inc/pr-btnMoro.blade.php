<div class="text-center pt_product_showmore mb-5">

    @if ($products->hasMorePages())
        <a id="load-products" href="" class="btn btn-border">عرض المزيد</a>
        <a class="not-load-products  btn-border01 d-none">لا يوجد المزيد من المنتجات لعرضها</a>
    @else
        <a class="not-load-products btn-border01">لا يوجد المزيد من المنتجات لعرضها</a>

    @endif

</div>
