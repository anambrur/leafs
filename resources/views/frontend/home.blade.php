@extends('frontend.master')
@section('title', '')
@section('content')
    <!-- Home slideder-->
    @include('frontend.common.slider')
    <!-- END Home slideder-->

    <div class="content-page">
        @include('frontend.products.shopCategorys')
        {{-- latest deals start --}}
        @include('frontend.products.latest_deals')
        <!--latest deals end-->
        <div class="container">
            <div class="feature-product-wrapper">
                <?php
                $countC = 0;
                $x = 1;
                ?>
                @forelse($categories as $catKey => $category)

                    <?php
                
                $subcategory_id = \App\Model\Common\Category::where('parent_id', $category->id)->get();
                                    $countProduct = $category->total_products;
                                    foreach ($subcategory_id as $item) {
                                        $countProduct += $item->total_products;
                                    }
                                      if($countProduct>0){
               
                $title = $category->title;
                $fav =  $category->fav_icon;
                $fav1 =  $category->image;
                $slug =  $category->slug;
                // dd($fav);
                $color = $category->color_code;
                ?>
                    @include('frontend.inc.css.homeCss')

                    <div class="product-featured clearfix">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 hidden-xs">
                                <div class="category-img-box">
                                    <img src="{{ SM::sm_get_the_src($fav1, 186, 331) }}" class="img-responsive">
                                </div>
                                <div class="category_product_all">
                                    <div><a href="{{ url('category/' . $slug) }}"><span>VIEW ALL</span></a></div>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-8">
                                <h2 class="page-heading home-page-heading">
                                    {{ $title }}
                                </h2>
                                <div class="latest-deals-product">
                                    <span class="count-down-time2" style="display: none;">
                                        <span class="icon-clock"></span>
                                        <span>end in</span>
                                        <span class="countdown-lastest" data-y="2016" data-m="7" data-d="1"
                                            data-h="00" data-i="00" data-s="00"></span>
                                    </span>
                                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav="true"
                                        data-margin="10" data-autoplayTimeout="1000" data-autoplayHoverPause="true"
                                        data-responsive='{"0":{"items":2},"600":{"items":2},"991":{"items":3},"1000":{"items":5}}'>
                                        <?php $latestDeals = SM::categoryProducts($category->id);
                                        ?>
                                        @forelse($latestDeals as $latestDeal)
                                            @if ($latestDeal->product_type == 2)
                                                <?php
                                                $att_data = SM::getAttributeByProductId($latestDeal->id);
                                                if (!empty($att_data->attribute_image)) {
                                                    $attribute_image = $att_data->attribute_image;
                                                } else {
                                                    $attribute_image = $latestDeal->image;
                                                }
                                                ?>
                                                <li data-product-id="{{ $latestDeal->id }}">
                                                    <div class="left-block">
                                                        <a href="{{ url('product/' . $latestDeal->slug) }}">
                                                            <img class="img-responsive" alt="{{ $latestDeal->title }}"
                                                                src="{{ SM::sm_get_the_src($attribute_image, 186, 186) }}" />
                                                        </a>
                                                        @if ($latestDeal->sale_price > 0)
                                                            <div class="price-percent-reduction2">
                                                                {{ SM::productDiscount($latestDeal->id) }}% OFF
                                                            </div>
                                                        @endif
                                                        <div class="compare">

                                                        </div>
                                                    </div>
                                                    <div class="right-block">
                                                        <div class="content_price">
                                                            <h5 class="product-name"><a
                                                                    href="{{ url('product/' . $latestDeal->slug) }}">{{ chunk_split($latestDeal->title, 10) . ' ...' }}</a>
                                                            </h5>

                                                            @if ($latestDeal->sale_price > 0)
                                                                <span
                                                                    class="price product-price">{{ SM::currency_price_value($latestDeal->sale_price) }}</span>
                                                                <span
                                                                    class="price old-price">{{ SM::currency_price_value($latestDeal->regular_price) }}</span>
                                                            @else
                                                                <span
                                                                    class="price product-price">{{ SM::currency_price_value($latestDeal->regular_price) }}</span>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $colors = SM::productAttributeColor($latestDeal->id);
                                                            $sizes = SM::productAttributeSize($latestDeal->id);

                                                        @endphp
                                                        <div class="product-colors">
                                                            @foreach ($colors as $color)
                                                                <label style="background-color: {{ $color->color_code }};"
                                                                    class="color_btn_looks">
                                                                    <input type="radio" name="product_attribute_color"
                                                                        class="color-btn color-attr"
                                                                        data-color-id="{{ $color->color_id }}"
                                                                        style="display: none;"
                                                                        value="{{ $color->color_id }}" />
                                                                </label>
                                                            @endforeach
                                                        </div>


                                                        <div class="product-sizes">
                                                            @foreach ($sizes as $size)
                                                                <label class="size_btn_looks">
                                                                    <input type="radio" name="size"
                                                                        class="size-btn size-attr"
                                                                        data-size-id="{{ $size->id }}"
                                                                        style="display: none;"
                                                                        value="{{ $size->id }}" />
                                                                    {{ $size->title }}
                                                                </label>
                                                            @endforeach
                                                        </div>

                                                        <div class="quick-view">
                                                            <?php echo SM::quickViewHtml($latestDeal->id, $latestDeal->slug); ?>
                                                            <?php echo SM::addToCartButton($latestDeal->id, $latestDeal->regular_price, $latestDeal->sale_price); ?>
                                                        </div>

                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    <div class="left-block">
                                                        <a href="{{ url('product/' . $latestDeal->slug) }}">
                                                            <img class="img-responsive"
                                                                alt="{{ chunk_split($latestDeal->title, 10) . ' ...' }}"
                                                                src="{{ SM::sm_get_the_src($latestDeal->image, 186, 186) }}" />
                                                        </a>
                                                        @if ($latestDeal->sale_price > 0)
                                                            <div class="price-percent-reduction2">
                                                                {{ SM::productDiscount($latestDeal->id) }}% OFF
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="right-block">
                                                        <div class="content_price">
                                                            <h5 class="product-name"><a
                                                                    href="{{ url('product/' . $latestDeal->slug) }}">{{ $latestDeal->title }}</a>
                                                            </h5>
                                                            @if ($latestDeal->sale_price > 0)
                                                                <span
                                                                    class="price product-price">{{ SM::currency_price_value($latestDeal->sale_price) }}</span>
                                                                <span
                                                                    class="price old-price">{{ SM::currency_price_value($latestDeal->regular_price) }}</span>
                                                            @else
                                                                <span
                                                                    class="price product-price">{{ SM::currency_price_value($latestDeal->regular_price) }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="quick-view">
                                                            <?php echo SM::addToCartButton($latestDeal->id, $latestDeal->regular_price, $latestDeal->sale_price); ?>
                                                            <?php echo SM::quickViewHtml($latestDeal->id, $latestDeal->slug); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @empty
                                            No data found!
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end featured category electronic-->
                    <?php 
                $countC++ ;
                $x++;
                }
                ?>
                @empty
                    No data found
                @endforelse
            </div>
        </div>
    </div>

    {{-- @include('frontend.inc.footer_top') --}}
    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                <?php
                $maxC = count($categories);
                for ($i = 0; $i < $maxC; $i++) {
                ?>
                $('.common_selector_<?php echo $i; ?>').click(function() {

                    var category_id = $(this).data("category_id");
                    var type = $(this).data("type");
                    $.ajax({
                        type: 'get',
                        url: '{{ URL::route('categoryType_filter_by_product') }}',
                        data: {
                            category_id: category_id,
                            type: type,
                        },
                        success: function(data) {
                            $('.categoryByProduct_<?php echo $i; ?>').empty().html(data);
                        }
                    });
                });
                <?php } ?>

                // $('.color-btn').on('change', function() {
                //     var colorId = $(this).data('color-id');
                //     var productId = $(this).closest('li').data('product-id');
                //     var baseUrl = "{{ asset('storage/uploads/') }}";
                //     console.log("test");



                //     var $productContainer = $(this).closest('li');
                //     $.ajax({
                //         url: '/get-product-by-color',
                //         type: 'POST',
                //         data: {
                //             color_id: colorId,
                //             product_id: productId,
                //             _token: '{{ csrf_token() }}'
                //         },
                //         success: function(response) {

                //             var $priceContainer = $productContainer.find('.product-price');
                //             $priceContainer.empty();

                //             let firstItem = Object.values(response)[0];
                //             $productContainer.find('.product-price').text('TK ' + firstItem
                //                 .attribute_price);

                //             var imageContainer = $productContainer.find('.img-responsive');
                //             imageContainer.attr("src", baseUrl + '/' + firstItem.attribute_image);
                //             imageContainer.css({
                //                 width: '186px',
                //                 height: '192px'
                //             });
                //             imageContainer.show();

                //             var $sizesContainer = $productContainer.find('.product-sizes');
                //             $sizesContainer.empty();
                //             Object.entries(response).forEach(function([key, value]) {
                //                 $sizesContainer.append(
                //                     `<label class="size_btn_looks "><input type="radio" name="product_attribute_size" class="size-btn" style="display: none;" data-size-id="${value.attribute_id}" value="${value.attribute_id}" /> ${value.title}</label>`
                //                 );
                //             });
                //         },
                //         error: function(xhr, status, error) {
                //             console.error("An error occurred:", error);
                //         }
                //     });
                // });

            });
        </script>
    @endpush
@endsection
