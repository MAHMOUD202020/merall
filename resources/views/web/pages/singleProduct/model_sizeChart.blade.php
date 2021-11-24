<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                @if ($product->sizeChart_id != null)
                    <img src="{{asset("assets/web/images/sizeCharts/min/".$product->sizeChart->img)}}" >
                @endif
            </div>
        </div>
    </div>
</div>
