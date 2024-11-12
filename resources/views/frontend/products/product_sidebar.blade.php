<?php
$product_special_is_enable = SM::smGetThemeOption('product_special_is_enable', 1);
$product_show_category = SM::smGetThemeOption('product_show_category', 1);
$product_show_tag = SM::smGetThemeOption('product_show_tag', 1);
$product_show_brand = SM::smGetThemeOption('product_show_brand', 1);
$product_show_size = SM::smGetThemeOption('product_show_size', 1);
$product_show_color = SM::smGetThemeOption('product_show_color', 1);
$product_sidebar_add = SM::smGetThemeOption('product_sidebar_add', 1);
?>

<style>
    ul.sub-cat {
        margin-left: 20px;
    }
</style>

<div class="column col-xs-12 col-sm-3" id="left_column">
    <!-- Block Filter -->
    <div class="block left-module product-details-sidebar">
        <p class="title_block">Filter selection</p>
        <div class="block_content">
            <div class="layered layered-filter-price">

                <!-- Filter Category -->
                @if ($product_show_category)
                    <?php $getProductCategories = SM::getProductCategories(0); ?>
                    @if (count($getProductCategories) > 0)
                        <div class="layered_subtitle">CATEGORIES</div>
                        <div class="layered-content">
                            <ul class="check-box-list">
                                @foreach ($getProductCategories as $cat)
                                    <?php
                                    
                                    $segment = Request::segment(2);
                                    $selected = $segment == $cat->slug ? 'checked' : '';
                                    $category_filter[] = $cat->id;
                                    $subcategory_id = \App\Model\Common\Category::where('parent_id', $cat->id)->get();
                                    $countProduct = $cat->total_products;
                                    // dd($countProduct);
                                    // foreach ($subcategory_id as $item) {
                                    //     $category_filter[] = $item->id;
                                    //     $countProduct += $item->total_products;
                                    // }
                                    
                                    ?>
                                    <li>
                                        <input name="category" {{ $selected }} type="radio"
                                            id="c1_{{ $cat->id }}" value="{{ $cat->id }}"
                                            class="common_selector category" style="margin: 0" />
                                        <label for="c1_{{ $cat->id }}">
                                            {{ $cat->title }} <span class="count">({{ $countProduct }})</span>
                                        </label>
                                        {!! SM::category_tree_for_select_cat_id($cat->id, $segment) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif

                <!-- Filter Price -->
                <?php
                $max_price = (int) \App\Model\Common\Product::max('regular_price');
                $min_price = (int) \App\Model\Common\Product::min('regular_price');
                ?>

                <div class="layered_subtitle">Price</div>
                <div class="layered-content slider-range">
                    <div class="slider-range-price" data-label-reasult="Range:" data-min="{{ $min_price }}"
                        data-max="{{ $max_price }}" data-unit="{{ SM::get_setting_value('currency') }}"
                        data-value-min="{{ $min_price }}" data-value-max="{{ $max_price }}">
                    </div>
                    <input type="hidden" id="hidden_minimum_price" value="{{ $min_price }}" />
                    <input type="hidden" id="hidden_maximum_price" value="{{ $max_price }}" />
                    <div class="amount-range-price">Range: {{ SM::product_price($min_price) }} -
                        {{ SM::product_price($max_price) }}</div>
                </div>

                <!-- Filter Color -->
                @if ($product_show_color)
                    <?php $getProductColors = SM::getProductColors(0); ?>
                    @if (count($getProductColors) > 0)
                        <div class="layered_subtitle">Color</div>
                        <div class="layered-content filter-color">
                            <ul class="check-box-list">
                                @foreach ($getProductColors as $color)
                                    <li>
                                        <input type="checkbox" id="color_{{ $color->id }}"
                                            value="{{ $color->id }}" class="common_selector color" />
                                        <label for="color_{{ $color->id }}">{{ $color->title }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif

                <!-- Filter Brand -->
                @if ($product_show_brand)
                    <?php $getProductBrands = SM::getProductBrands(0); ?>
                    @if (count($getProductBrands) > 0)
                        <div class="layered_subtitle">Brand</div>
                        <div class="layered-content filter-brand">
                            <ul class="check-box-list">
                                @foreach ($getProductBrands as $brand)
                                    <li>
                                        <input type="checkbox" value="{{ $brand->id }}"
                                            id="brand_{{ $brand->id }}" class="common_selector brand" />
                                        <label for="brand_{{ $brand->id }}">
                                            {{ $brand->title }} <span
                                                class="count">({{ count($brand->products) }})</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif

                <!-- Filter Size -->
                @if ($product_show_size)
                    <?php $getProductSizes = SM::getProductSizes(0); ?>
                    @if (count($getProductSizes) > 0)
                        <div class="layered_subtitle">Size</div>
                        <div class="layered-content filter-size">
                            <ul class="check-box-list">
                                @foreach ($getProductSizes as $size)
                                    <li>
                                        <input type="checkbox" id="size_{{ $size->id }}"
                                            value="{{ $size->id }}" class="common_selector size" />
                                        <label for="size_{{ $size->id }}">{{ $size->title }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Ads -->
    <?php
    $product_sidebar_add_link = SM::smGetThemeOption('product_sidebar_add_link', '#');
    ?>
    @empty(!$product_sidebar_add)
        <div class="col-left-slide left-module">
            <a href="{{ $product_sidebar_add_link }}">
                <img src="{{ SM::sm_get_the_src($product_sidebar_add, 319, 389) }}" alt="sidebar-ad">
            </a>
        </div>
    @endempty

    <!-- Special Products -->
    @if ($product_special_is_enable)
        <?php
        $product_special_per_page = SM::smGetThemeOption('product_special_per_page', 1);
        $specialProducts = SM::getSpecialProduct($product_special_per_page);
        ?>
        @if (count($specialProducts) > 0)
            <div class="block left-module">
                <p class="title_block">SPECIAL PRODUCTS</p>
                <div class="block_content">
                    <ul class="products-block">
                        @foreach ($specialProducts as $product)
                            <li>
                                <div class="products-block-left">
                                    <a href="{{ url('product/' . $product->slug) }}">
                                        <img src="{{ SM::sm_get_the_src($product->image, 75, 75) }}"
                                            alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="products-block-right">
                                    <p class="product-name"><a
                                            href="{{ url('product/' . $product->slug) }}">{{ $product->title }}</a>
                                    </p>
                                    <div class="content_price">
                                        <p class="price product-price">
                                            {{ SM::product_price($product->sale_price > 0 ? $product->sale_price : $product->regular_price) }}
                                        </p>
                                    </div>
                                    <p class="product-star">{{ SM::product_review($product->id) }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="products-block-bottom"><a class="link-all" href="{{ url('/shop') }}">All Products</a>
                    </div>
                </div>
            </div>
        @endif
    @endif

    <!-- Tags -->
    @if ($product_show_tag)
        <?php $getTags = SM::getTags(); ?>
        @if (count($getTags) > 0)
            <div class="block left-module">
                <p class="title_block">TAGS</p>
                <div class="block_content">
                    <div class="tags">
                        @foreach ($getTags as $tag)
                            @if ($tag->title)
                                <a href="{{ url('tag/' . $tag->slug) }}"><span
                                        class="level2">{{ $tag->title }}</span></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

    <!-- Testimonials -->
    <?php
    $testimonialTitle = SM::smGetThemeOption('testimonial_title');
    $testimonials = SM::smGetThemeOption('testimonials');
    ?>
    @if (!empty($testimonials))
        <div class="block left-module">
            <p class="title_block">{{ $testimonialTitle }}</p>
            <div class="block_content">
                <ul class="testimonials owl-carousel" data-loop="true" data-nav="false" data-margin="30"
                    data-autoplayTimeout="1000" data-autoplay="true" data-autoplayHoverPause="true" data-items="1">
                    @foreach ($testimonials as $testimonial)
                        <li>
                            <div class="client-mane">{{ $testimonial['name'] }}</div>
                            <div class="client-avarta"><img
                                    src="{{ SM::sm_get_the_src($testimonial['image'], 97, 97) }}"
                                    alt="{{ $testimonial['name'] }}"></div>
                            <div class="testimonial">{{ $testimonial['description'] }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
