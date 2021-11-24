<div class="pt-collapse open">
    <h3 class="pt-collapse-title">
        متوسط السعر
        <span class="pt-icon">
                <svg>
                    <use xlink:href="#icon-arrow_small_bottom"></use>
                </svg>
            </span>
    </h3>
    <div class="pt-collapse-content">
        <ul class="pt-list-row">
            <li class="{{request('price-rang') === '10-100' ? 'active' : ''}}">
                <a href="?price-rang=10-100">10ريال- 100ريال</a>
            </li>
            <li class="{{request('price-rang') === '100-200' ? 'active' : ''}}">
                <a href="?price-rang=100-200">100ريال-200ريال</a>
            </li>
            <li class="{{request('price-rang') === '200-300' ? 'active' : ''}}">
                <a href="?price-rang=200-300">200ريال-300ريال</a>
            </li>
            <li class="{{request('price-rang') === '300-400' ? 'active' : ''}}">
                <a href="?price-rang=300-400">300ريال-400ريال</a>
            </li>
            <li class="{{request('price-rang') === '400-500' ? 'active' : ''}}">
                <a href="?price-rang=400-500">400ريال-500ريال</a>
            </li>
            <li class="{{request('price-rang') === '0-10000' ? 'active' : ''}}">
                <a href="?price-rang=0-10000">0ريال-10000ريال</a>
            </li>
        </ul>
    </div>
</div>
