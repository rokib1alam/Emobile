@extends('layouts.app')
@section('title','Home')
@section('content')

<!-- START HEADER -->
@include('frontend.layouts.nheader')
<!-- END HEADER -->
<!-- START SECTION BANNER -->
@include('frontend.layouts.slider')
<!-- END SECTION BANNER -->
<!-- START MAIN CONTENT -->
<!-- END MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section small_pt pb-0">
        <div class="custom-container">
            <div class="row">
                <div class="col-xl-3 d-none d-xl-block">
                    <div class="sale-banner">
                        <a class="hover_effect1" href="#">
                            <img src="{{asset('/')}}frontend/assets/images/shop_banner_img6.jpg" alt="shop_banner_img6">
                        </a>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Exclusive Products</h4>
                                </div>
                                <div class="tab-style2">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tabmenubar" aria-expanded="false"> 
                                        <span class="ion-android-menu"></span>
                                    </button>
                                    <ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="featured-tab" data-bs-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="true">Featured</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="most-popular-tab" data-bs-toggle="tab" href="#mostpopular" role="tab" aria-controls="mostpopular" aria-selected="false">Most Popular</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content">
                                <!-- Featured Products Tab -->
                                <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                                    <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                        @foreach ($featured as $featur)
                                            <div class="item">
                                                <div class="product_wrap">
                                                    <span class="pr_flash bg-danger">Hot</span>
                                                    <div class="product_img">
                                                        <a href="{{ route('product.details', $featur->product_slug) }}">

                                                            @php
                                                                $featuredColor = $featur->colors->first();
                                                            @endphp

                                                            @if($featuredColor && $featuredColor->thumbnail)

                                                                <img
                                                                    src="{{ asset($featuredColor->thumbnail) }}"
                                                                    alt="{{ $featur->product_name }}"
                                                                >

                                                                <img
                                                                    class="product_hover_img"
                                                                    src="{{ asset($featuredColor->thumbnail) }}"
                                                                    alt="{{ $featur->product_name }} Hover Image"
                                                                >

                                                            @else

                                                                <img
                                                                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                                                                    alt="{{ $featur->product_name }}"
                                                                >

                                                                <img
                                                                    class="product_hover_img"
                                                                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                                                                    alt="{{ $featur->product_name }} Hover Image"
                                                                >

                                                            @endif

                                                        </a>
                                                        <div class="product_action_box">
                                                            <ul class="list_none pr_action_btn">
                                                                <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                                                <li><a href="#" id="{{$featur->id}}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                                                <li><a href="{{ route('wishlist.add', $featur->id) }}"><i class="icon-heart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_title"><a href="{{ route('product.details', $featur->product_slug) }}">{{ $featur->product_name }}</a></h6>
                                                        <div class="product_price">
                                                            @if ($featur->discount_price == null)
                                                                <span class="price">{{ $setting->currency }}{{ number_format((float) $featur->selling_price, 2) }}</span>
                                                            @else
                                                                <span class="price">{{ $setting->currency }}{{ number_format((float) $featur->discount_price, 2) }}</span>
                                                                <del>{{ $setting->currency }}{{ number_format((float) $featur->selling_price, 2) }}</del>
                                                                @php
                                                                    $sellingPrice = (float) $featur->selling_price;
                                                                    $discountPrice = (float) $featur->discount_price;
                                                                    $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                                @endphp
                                                                <br>
                                                                <div class="on_sale">
                                                                    <span>{{ $discount }}% Off</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width:{{ ($featur->averageRating / 5) * 100 }}%"></div>
                                                            </div>
                                                            <span class="rating_num">({{ $featur->reviewCount }})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Most Popular Products Tab -->
                                <div class="tab-pane fade" id="mostpopular" role="tabpanel" aria-labelledby="most-popular-tab">
                                    <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                        @foreach ($popular_product as $product)
                                            <div class="item">
                                                <div class="product_wrap">
                                                    <div class="product_img">
                                                        <a href="{{ route('product.details', $product->product_slug) }}">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                                            <img class="product_hover_img" src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }} Hover Image">
                                                        </a>
                                                        <div class="product_action_box">
                                                            <ul class="list_none pr_action_btn">
                                                                <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                                                <li><a href="#" id="{{$product->id}}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                                                <li><a href="{{ route('wishlist.add', $product->id) }}"><i class="icon-heart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></h6>
                                                        <div class="product_price">
                                                            @if ($product->discount_price == null)
                                                                <span class="price">{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</span>
                                                            @else
                                                                <span class="price">{{ $setting->currency }}{{ number_format((float) $product->discount_price, 2) }}</span>
                                                                <del>{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</del>
                                                                @php
                                                                    $sellingPrice = (float) $product->selling_price;
                                                                    $discountPrice = (float) $product->discount_price;
                                                                    $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                                @endphp
                                                                <br>
                                                                <div class="on_sale">
                                                                    <span>{{ $discount }}% Off</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                                            </div>
                                                            <span class="rating_num">({{ $product->reviewCount }})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION BANNER --> 
    <div class="section pb_20 small_pt">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-4">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{asset('/')}}frontend/assets/images/shop_banner_img7.jpg" alt="shop_banner_img7">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{asset('/')}}frontend/assets/images/shop_banner_img8.jpg" alt="shop_banner_img8">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{asset('/')}}frontend/assets/images/shop_banner_img9.jpg" alt="shop_banner_img9">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BANNER --> 

    <!-- START SECTION SHOP -->
    @if($today_deal)

        <div class="section pt-0 pb-0">

            <div class="custom-container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="heading_tab_header">

                            <div class="heading_s2">

                                <h4>
                                    Deal Of The Day
                                </h4>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-12">

                        <div
                            class="product_slider carousel_slider owl-carousel owl-theme nav_style3"
                            data-loop="true"
                            data-dots="false"
                            data-nav="true"
                            data-margin="30"
                            data-responsive='{"0":{"items": "1"}, "650":{"items": "2"}, "1199":{"items": "2"}}'
                        >

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | Product
                                |--------------------------------------------------------------------------
                                */

                                $product = $today_deal;


                                /*
                                |--------------------------------------------------------------------------
                                | Product Color Image
                                |--------------------------------------------------------------------------
                                */

                                $productColor = $product->colors
                                    ->whereNotNull('thumbnail')
                                    ->first();


                                /*
                                |--------------------------------------------------------------------------
                                | Price
                                |--------------------------------------------------------------------------
                                */

                                $price = $product->discount_price
                                    ?? $product->selling_price;


                                /*
                                |--------------------------------------------------------------------------
                                | Discount
                                |--------------------------------------------------------------------------
                                */

                                $discount = null;

                                if (
                                    $product->discount_price &&
                                    $product->selling_price > 0
                                ) {

                                    $discount = round(

                                        (
                                            ($product->selling_price - $product->discount_price)
                                            / $product->selling_price
                                        ) * 100

                                    );

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | Stock / Sold
                                |--------------------------------------------------------------------------
                                */

                                $soldQuantity =
                                    $product->sold_quantity ?? 0;

                                $stockQuantity =
                                    $product->stock_quantity ?? 0;

                                $total =
                                    $soldQuantity + $stockQuantity;

                                $percentage = 0;

                                if ($total > 0) {

                                    $percentage =
                                        ($soldQuantity / $total) * 100;

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | Countdown
                                |--------------------------------------------------------------------------
                                */

                                $countdownTime =
                                    $product->countdown_time
                                    ?? now()
                                        ->addDays(2)
                                        ->format('Y/m/d H:i:s');

                            @endphp


                            <div class="item">

                                <div class="deal_wrap">


                                    {{-- PRODUCT IMAGE --}}

                                    <div class="product_img">

                                        <a href="{{ route('product.details', $product->product_slug) }}">

                                            @if($productColor && $productColor->thumbnail)

                                                <img
                                                    src="{{ asset($productColor->thumbnail) }}"
                                                    alt="{{ $product->product_name }}"
                                                >

                                            @else

                                                <img
                                                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                                                    alt="{{ $product->product_name }}"
                                                >

                                            @endif

                                        </a>

                                    </div>


                                    {{-- DEAL CONTENT --}}

                                    <div class="deal_content">

                                        <div class="product_info">


                                            {{-- SUBCATEGORY --}}

                                            <h6>

                                                {{ $product->subcategory->subcategory_name ?? '' }}

                                            </h6>


                                            {{-- PRODUCT NAME --}}

                                            <h5>

                                                <a href="{{ route('product.details', $product->product_slug) }}">

                                                    {{ Str::limit($product->product_name, 20) }}

                                                </a>

                                            </h5>


                                            {{-- PRICE --}}

                                            <div class="product_price">

                                                @if($product->discount_price == null)

                                                    <span class="price">

                                                        {{ $setting->currency }}

                                                        {{ number_format((float) $product->selling_price, 2) }}

                                                    </span>

                                                @else

                                                    <span class="price">

                                                        {{ $setting->currency }}

                                                        {{ number_format((float) $product->discount_price, 2) }}

                                                    </span>

                                                    @if($discount)

                                                        <del>

                                                            {{ $setting->currency }}

                                                            {{ number_format((float) $product->selling_price, 2) }}

                                                        </del>

                                                    @endif

                                                @endif

                                            </div>


                                        </div>


                                        {{-- STOCK PROGRESS --}}

                                        <div class="deal_progress">

                                            <span class="stock-sold">

                                                Already Sold:

                                                <strong>
                                                    {{ $soldQuantity }}
                                                </strong>

                                            </span>


                                            <span class="stock-available">

                                                Available:

                                                <strong>
                                                    {{ $stockQuantity }}
                                                </strong>

                                            </span>


                                            <div class="progress">

                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    aria-valuenow="{{ $percentage }}"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width:{{ $percentage }}%"
                                                >

                                                    {{ round($percentage) }}%

                                                </div>

                                            </div>

                                        </div>


                                        {{-- COUNTDOWN --}}

                                        <div
                                            class="countdown_time countdown_style4 mb-4"
                                            data-time="{{ $countdownTime }}"
                                        ></div>


                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif
    <!-- END SECTION SHOP -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt small_pb">
        <div class="custom-container">
            <div class="row">
                {{-- <div class="col-xl-3 d-none d-xl-block">
                    <div class="sale-banner">
                        <a class="hover_effect1" href="#">
                            <img src="{{ asset($trendy_product_new->thumbnail) }}" alt="shop_banner_img10">
                        </a>
                    </div>
                </div> --}}
                @if($trendy_product_new)
                    <div class="col-xl-3 d-none d-xl-block">
                        <div class="banner">
                            <div class="discount">
                                @if ($trendy_product_new->discount_price == null)
                                    @else
                                        @php
                                            $sellingPrice = (float) $product->selling_price;
                                            $discountPrice = (float) $product->discount_price;
                                            $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                        @endphp
                                        Up to {{ $discount }} % Off
                                @endif
                            </div>
                            <h1>New Collection</h1>
                            <a href="{{ route('product.details', $trendy_product_new->product_slug) }}" class="shop-now">Shop Now →</a>
                            <img src="{{ asset($trendy_product_new->thumbnail) }}" alt="img" class="product-image"> 
                            <div class="vertical-text">
                                {{ $trendy_product_new->childcategory->childcategory_name ?? 'No Category' }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Trending products</h4>
                                </div>
                                <div class="view_all">
                                    <a href="#" class="text_default"><i class="linearicons-power"></i> <span>View All</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                @foreach ($trendy_product as $product )
                                
                                    <div class="item">
                                        <div class="product_wrap">
                                            <div class="product_img">
                                                <a href="{{ route('product.details', $product->product_slug) }}">
                                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                                    <img class="product_hover_img" src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }} Hover Image">
                                                </a>
                                                <div class="product_action_box">
                                                    <ul class="list_none pr_action_btn">
                                                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                        <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                                        <li><a href="#" id="{{$product->id}}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                                        <li><a href="{{ route('wishlist.add', $product->id) }}"><i class="icon-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></h6>
                                                <div class="product_price">
                                                    @if ($product->discount_price == null)
                                                        <span class="price">{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</span>
                                                    @else
                                                        <span class="price">{{ $setting->currency }}{{ number_format((float) $product->discount_price, 2) }}</span>
                                                        <del>{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</del>
                                                        @php
                                                            $sellingPrice = (float) $product->selling_price;
                                                            $discountPrice = (float) $product->discount_price;
                                                            $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                        @endphp
                                                        <br>
                                                        <div class="on_sale">
                                                            <span>{{ $discount }}% Off</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                                    </div>
                                                    <span class="rating_num">({{ $product->reviewCount }})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
    <!-- START Category List-->
    <div class="section pt-0 small_pb">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h4>Our Categorys</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}, "1199":{"items": "6"}}'>
                        @foreach ($categories as $category)
                            <div class="item">
                                <div class="cl_logo" style="text-align: center;">
                                    <i class="{{ $category->icon }}" style="font-size: 3em;"></i>
                                    <span style="display: block; margin-top: 10px;">{{ $category->category_name }}</span>
                                </div>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- END Category List  -->
    <!-- Home Category Wise product -->
    @foreach($home_category as $home)
    @php
        $cat_product=App\Models\product::where('category_id',$home->id)->orderBy('id','DESC')->limit(24)->get();
        foreach ($cat_product as $product) {
            $product->reviewCount = App\Models\review::where('product_id', $product->id)->count();
            $product->averageRating = App\Models\review::where('product_id', $product->id)->avg('rating');
        }
    @endphp
        <div class="section small_pt small_pb">
            <div class="custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading_tab_header">
                                    <div class="heading_s2">
                                        <h4>{{$home->category_name }}</h4>
                                    </div>
                                    <div class="view_all">
                                        <a href="#" class="text_default"><i class="linearicons-power"></i> <span>View All</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"},"210":{"items": "2"} ,"481":{"items": "3"}, "768":{"items": "4"}, "991":{"items": "5"}}' >
                                    @foreach ($cat_product as $product)
                                        <div class="item">
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product.details', $product->product_slug) }}">
                                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                                        <img class="product_hover_img" src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }} Hover Image">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                            <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                                            <li><a href="#" id="{{$product->id}}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                                            <li><a href="{{ route('wishlist.add', $product->id) }}"><i class="icon-heart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></h6>
                                                    <div class="product_price">
                                                        @if ($product->discount_price == null)
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</span>
                                                        @else
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->discount_price, 2) }}</span>
                                                            <del>{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</del>
                                                            @php
                                                                $sellingPrice = (float) $product->selling_price;
                                                                $discountPrice = (float) $product->discount_price;
                                                                $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                            @endphp
                                                            <br>
                                                            <div class="on_sale">
                                                                <span>{{ $discount }}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $product->reviewCount }})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- END SECTION SHOP -->

    <!-- START SECTION CLIENT LOGO -->
    <div class="section pt-0 small_pb">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h4>Our Brands</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}, "1199":{"items": "6"}}'>
                        @foreach ($brands as $brand)
                            <div class="item">
                                <div class="cl_logo">
                                    <a href="" title="{{$brand->brand_name}}">
                                        <img src="{{asset($brand->brand_logo)}}" alt="{{$brand->brand_name}}"/>
                                    </a>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CLIENT LOGO -->

    <!-- START SECTION SHOP -->
    <div class="section pt-0 pb_20">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Featured Products</h4>
                                </div>
                                <div class="view_all">
                                    <a href="#" class="text_default"><span>View All</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                @foreach ($featured->chunk(3) as $productChunk)
                                    <div class="item">
                                        @foreach ($productChunk as $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product.details', $product->product_slug) }}">
                                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                                        <img class="product_hover_img" src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }} Hover Image">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></h6>
                                                    <div class="product_price">
                                                        @if ($product->discount_price == null)
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</span>
                                                        @else
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->discount_price, 2) }}</span>
                                                            <del>{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</del>
                                                            @php
                                                                $sellingPrice = (float) $product->selling_price;
                                                                $discountPrice = (float) $product->discount_price;
                                                                $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                            @endphp
                                                            <br>
                                                            <div class="on_sale">
                                                                <span>{{ $discount }}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $product->reviewCount }})</span>
                                                    </div>
                                                    {{-- <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Top Rated Products</h4>
                                </div>
                                <div class="view_all">
                                    <a href="#" class="text_default"><span>View All</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                @foreach ($top_rated_products->chunk(3) as $productChunk)
                                    <div class="item">
                                        @foreach ($productChunk as $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product.details', $product->product_slug) }}">
                                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                                        <img class="product_hover_img" src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }} Hover Image">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></h6>
                                                    <div class="product_price">
                                                        @if ($product->discount_price == null)
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</span>
                                                        @else
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->discount_price, 2) }}</span>
                                                            <del>{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</del>
                                                            @php
                                                                $sellingPrice = (float) $product->selling_price;
                                                                $discountPrice = (float) $product->discount_price;
                                                                $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                            @endphp
                                                            <br>
                                                            <div class="on_sale">
                                                                <span>{{ $discount }}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $product->reviewCount }})</span>
                                                    </div>
                                                    {{-- <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Popular Products</h4>
                                </div>
                                <div class="view_all">
                                    <a href="#" class="text_default"><span>View All</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                @foreach ($popular_product->chunk(3) as $productChunk)
                                    <div class="item">
                                        @foreach ($productChunk as $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product.details', $product->product_slug) }}">
                                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                                        <img class="product_hover_img" src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }} Hover Image">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a></h6>
                                                    <div class="product_price">
                                                        @if ($product->discount_price == null)
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</span>
                                                        @else
                                                            <span class="price">{{ $setting->currency }}{{ number_format((float) $product->discount_price, 2) }}</span>
                                                            <del>{{ $setting->currency }}{{ number_format((float) $product->selling_price, 2) }}</del>
                                                            @php
                                                                $sellingPrice = (float) $product->selling_price;
                                                                $discountPrice = (float) $product->discount_price;
                                                                $discount = round(($sellingPrice - $discountPrice) / $sellingPrice * 100);
                                                            @endphp
                                                            <br>
                                                            <div class="on_sale">
                                                                <span>{{ $discount }}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $product->reviewCount }})</span>
                                                    </div>
                                                    {{-- <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <div class="section bg_default small_pt small_pb">
        <div class="custom-container">	
            <div class="row align-items-center">	
                <div class="col-md-6">
                    <div class="newsletter_text text_white">
                        <h3>Join Our Newsletter Now</h3>
                        <p> Register now to get updates on promotions. </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter_form2 rounded_input">
                        <form>
                            <input type="text" required="" class="form-control" placeholder="Enter Email Address">
                            <button type="submit" class="btn btn-dark btn-radius" name="submit" value="Submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>

<!-- Product Quick View Modal -->
<div class="modal fade"  id="quickviewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="quick_view_body">
        
    </div>
</div>

<!-- Include jQuery library -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Include Bootstrap JS -->
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script type="text/javascript">
   $(document).on('click', '.Quickview', function() {
        var id = $(this).attr('id');
        // alert(id); check id is pass or not
        $.ajax({
                url: "{{url("/product-quick-view/")}}/" + id,
                type: 'GET',
                success: function(data) {
                    $("#quick_view_body").html(data);
                }
            });
        });
</script>


<!-- END MAIN CONTENT -->
<!-- START FOOTER -->
@include('frontend.layouts.footer')
<!-- END FOOTER -->


@endsection