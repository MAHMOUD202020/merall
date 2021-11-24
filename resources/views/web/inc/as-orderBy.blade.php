<div class="pt-collapse open ">
    <h3 class="pt-collapse-title">
        ترتيب حسب
        <span class="pt-icon">
                <svg>
                    <use xlink:href="#icon-arrow_small_bottom"></use>
                </svg>
            </span>
    </h3>

    <div class="pt-collapse-content">
        <ul class="pt-filter-list">
            <li class="{{request('orderBy') === 'date' ? 'active' : ''}}">
                <a href="?orderBy=date">
                    <i class="icon">
                        <svg>
                            <use xlink:href="#icon-close"></use>
                        </svg>
                    </i>
                    التاريخ
                </a>
            </li>
            <li class="{{request('orderBy') === 'price' ? 'active' : ''}}">
                <a href="?orderBy=price">
                    <i class="icon">
                        <svg>
                            <use xlink:href="#icon-close"></use>
                        </svg>
                    </i>
                    السعر
                </a>
            </li>
            <li class="{{request('orderBy') == 'featured' ? 'active' : ''}}">
                <a href="?orderBy=featured">
                    <i class="icon">
                        <svg>
                            <use xlink:href="#icon-close"></use>
                        </svg>
                    </i>
                    منتجات مميزهً
                </a>
            </li>
            <li class="{{request('orderBy') == 'sale' ? 'active' : ''}}">
                <a href="?orderBy=sale">
                    <i class="icon">
                        <svg>
                            <use xlink:href="#icon-close"></use>
                        </svg>
                    </i>
                    منتجات بخصومات
                </a>
            </li>

        </ul>
    </div>
</div>
