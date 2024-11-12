
<div class="menu-bar" id="menu-bar">
    <div class="bg-opacity">
        <div class="container-fluid">
            <div class="col-md-12 col-sm-12 header-top-right">
                <div id="main-menu" class="main-menu">
                    <nav class="navbar navbar-default">
                        <div id="navbar" class="navbar-collapse collapse">
                            <div class="search-panel" style="width: 230px;">
                                <ul>
                                    <li>
                                        <a type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            style="padding: 14px 20px; width: 100%;">
                                            <span id="search_concept"><i class="fa fa-th-list" aria-hidden="true"></i> All Categories <span class="caret"></span></span> 
                                        </a>
                                        <ul class="catgories-menu" role="menu">
                                            @foreach ($categoriesWithSubcategories as $mainCategory)
                                                <li>
                                                    <a href="/category/{{ $mainCategory->slug }}" class="category_menu_text">
                                                        <img src="{{ SM::sm_get_the_src($mainCategory->fav_icon) }}" alt="">
                                                        <span>{{ $mainCategory->title }}</span>
                                                    </a>

                                                    {{-- Check if the main category has subcategories --}}
                                                    @if (!$mainCategory->subcategories->isEmpty())
                                                    <div class="sub-menu mega-menu mega-menu-column-4">
                                                        @include('frontend.common.partial_nav', [
                                                            'subcategories' => $mainCategory->subcategories,
                                                        ])
                                                    </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            $menu = [
                                'nav_wrapper' => 'ul',
                                'start_class' => 'nav navbar-nav nav-justify',
                                'link_wrapper' => 'li',
                                'dropdown_class' => '',
                                'subNavUlClass' => 'dropdown-menu mega_dropdown',
                                'has_dropdown_wrapper_class' => 'dropdown',
                                'show' => true,
                            ];
                            SM::sm_get_menu($menu);
                            ?>
                            <a href="{{ url('/compare') }}" type="button" class="btn compare-button">
                                <i class="fa fa-compress" aria-hidden="true"></i> Compare
                             </a>
                             
                        </div>
                    </nav>
                    <div class="group-button-header">
                                <div class="btn-cart header_cart_html" id="cart-block">
                                    <a href="{{ url('/cart') }}" style="display: flex;">
                                        <div class="card_view">
                                            {{-- <a title="My cart" href="{{ url('/cart') }}">Cart</a> --}}
                                            {{-- <span class="notify notify-right cart_count">{{ Cart::instance('cart')->count() }}</span> --}}
                                            <img src="{{ url('frontend/images/favorite-cart.gif') }}" alt="">
                                        </div>
                                        <div class="shoping_cart_text">
                                            <p>Shopping Cart</p>
                                            <span>{{ Cart::instance('cart')->count() }} items</span>
                                            <span>- ৳ {{ Cart::total() }}</span>
                                        </div>
                                    </a>
                                    <div class="cart-block">
                                        <div class="cart-block-content">
                                            <h5 class="cart-title cart_count">{{ Cart::instance('cart')->count() }}
                                                Items in
                                                my cart</h5>
                                            <div class="cart-block-list">
                                                <ul>
                                                    <?php
                                                    $items = Cart::instance('cart')->content();
                                                    ?>
                                                    @forelse($items as $id => $item)
                                                        <li class="product-info removeCartTrLi">
                                                            <div class="p-left">
                                                                <a data-product_id="{{ $item->rowId }}"
                                                                    class="remove_link removeToCart"
                                                                    title="Remove item" href="javascript:void(0)"></a>
                                                                <a
                                                                    href="{{ url('product/' . $item->options->slug) }}">
                                                                    <img class="img-responsive"
                                                                        src="{{ SM::sm_get_the_src($item->options->image, 100, 100) }}"
                                                                        alt="{{ $item->name }}">
                                                                </a>
                                                            </div>
                                                            <div class="p-right">
                                                                <p class="p-name">{{ $item->name }}</p>
                                                                <p class="p-rice">
                                                                    {{ SM::currency_price_value($item->price) }}
                                                                </p>
                                                                <p>Qty: {{ $item->qty }}</p>
                                                                @if ($item->options->sizename != '')
                                                                    <p>Size: {{ $item->options->sizename }}</p>
                                                                @endif
                                                                @if ($item->options->colorname != '')
                                                                    <p>Color: {{ $item->options->colorname }}</p>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <p>No data found!</p>
                                                    @endforelse
                                                </ul>
                                            </div>
                                            <div class="toal-cart">
                                                <span>Total</span>
                                                <span class="toal-price pull-right">
                                                    {{ SM::currency_price_value(Cart::instance('cart')->subTotal()) }}
                                                </span>
                                            </div>
                                            <div class="cart-buttons">
                                                <a href="{{ url('/cart') }}" class="btn-check-out">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="clearfix"></div>-->
