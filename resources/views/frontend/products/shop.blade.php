@extends('frontend.master')
@section('title', 'Shop')
@section('content')
    <?php
    $countStickyPost = count($stickyProductPost);
    $isBreadcrumbEnable = SM::smGetThemeOption('product_is_breadcrumb_enable', false);
    
    $pagination = [
        [
            'title' => 'Product',
        ],
    ];
    $title = SM::smGetThemeOption('product_banner_title');
    $subtitle = SM::smGetThemeOption('product_banner_subtitle');
    $bannerImage = SM::smGetThemeOption('product_banner_image');
    ?>
    @push('style')
        <style>
            #loading {
                text-align: center;
                background: url('loader.gif') no-repeat center;
                height: 150px;
            }
        </style>
    @endpush
    <!-- page wapper-->
    <div class="columns-container">
        <div class="container" id="columns">
            <!--@include('frontend.common.mainnav')-->
            <div id="clearfix"></div>

            @include('frontend.common.breadcrumb')

            <div class="row">

                @include('frontend.products.product_sidebar')
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <div class="category-slider">
                        {{-- <img class="img-responsive" src="{{ SM::sm_get_the_src($bannerImage, 1017, 336) }}" alt="{{$title }}"> --}}
                    </div>
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading">
                            <span class="page-heading-title">{{ $title }}</span>
                        </h2>
                        <ul class="display-product-option" style="width: 253px !important;">
                            <li>
                                <div class="sortPagiBar">
                                    <div class="sort-product">
                                        <select name="common_selector orderByPrice" class="common_selector orderByPrice">
                                            <option value="">Popularity</option>
                                            <option value="1">Price low to high</option>
                                            <option value="2">Price high to low</option>
                                        </select>
                                        <div class="sort-product-icon">
                                            <i class="fa fa-sort-alpha-asc"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>

                        </ul>
                        <ul class="row product-list grid " id="ajax_view_product_list">
                            @include('frontend.products.product_list_item')
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ./page wapper-->
    @push('script')
        
    @endpush
@endsection
