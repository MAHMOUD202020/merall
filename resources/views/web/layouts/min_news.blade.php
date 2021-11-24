@if ($minNews)
    <div class="pt-top-panel">
        <div class="container">
            <div class="pt-row">
                <div class="pt-description">
                    <strong>{{$minNews->value}}</strong>
                    @if ($minNews->link)
                            <a href="{{$minNews->link}}" target="_blank" class="text-secondary" >
                                عرض المزيد
                            </a>
                    @endif
                </div>
                <button class="pt-btn-close js-removeitem">
                    <svg fill="none">
                        <use xlink:href="#icon-close"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endif
