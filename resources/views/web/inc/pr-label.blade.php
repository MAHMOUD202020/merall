<span class="pt-label-location">
    @if($is_new)
        <span class="pt-label-new">جديد</span>
    @endif
    @if($is_premium)
        <span class="pt-label-our-fatured">مميز</span>
    @endif
    @if($is_discount)
        <span class="pt-label-sale">خصم -{{$product->percentage}}%</span>
    @endif
</span>
