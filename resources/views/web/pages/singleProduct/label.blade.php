<div class="pt-wrapper">
    <div class="pt-label">
        @if ($product->available == 0)
            <div class="pt-label-out-stock">انتهت الكمية</div>
        @else
            @if($product->created_at->addMonth() >= now())
                <span class="pt-label-new">جديد</span>
            @endif
            @if($product->premium == 1)
                <span class="pt-label-our-fatured">مميز</span>
            @endif
            @if($product->discount > 0)
                <span class="pt-label-sale">خصم -{{$product->percentage}}%</span>
            @endif
        @endif

    </div>
</div>
