@extends('layouts.app')

@section('title','Product')

@section('content')

<!-- START HEADER -->
@include('frontend.layouts.nheader')
<!-- END HEADER -->


<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">

    <div class="container">
        <!-- STRART CONTAINER -->

        <div class="row align-items-center">

            <div class="col-md-6">

                <div class="page-title">

                    <h1>Product Detail</h1>

                </div>

            </div>

            <div class="col-md-6">

                <ol class="breadcrumb justify-content-md-end">

                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#">
                            {{ $product->category->category_name }}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#">
                            {{ $product->subcategory->subcategory_name }}
                        </a>
                    </li>

                    {{-- 
                    <li class="breadcrumb-item active">
                        {{ $product->childcategory->childcategory_name }}
                    </li>
                    --}}

                </ol>

            </div>

        </div>

    </div>
    <!-- END CONTAINER-->

</div>
<!-- END SECTION BREADCRUMB -->


<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">

        <div class="container">

            @php

                /*
                |--------------------------------------------------------------------------
                | Default Product Color
                |--------------------------------------------------------------------------
                */

                $selectedColor = $product->colors->first();

                $selectedThumbnail = null;
                $selectedImages = [];

                if ($selectedColor) {

                    $selectedThumbnail = $selectedColor->thumbnail;

                    $selectedImages = is_array($selectedColor->images)
                        ? $selectedColor->images
                        : json_decode($selectedColor->images, true);

                    if (!is_array($selectedImages)) {
                        $selectedImages = [];
                    }
                }

            @endphp


            <div class="row">

                <!-- =========================================
                     PRODUCT IMAGE
                ========================================== -->

                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">

                    <div class="product-image">

                        <div class="product_img_box">

                            @if($selectedThumbnail)

                                <img
                                    id="product_img"
                                    src="{{ asset($selectedThumbnail) }}"
                                    data-zoom-image="{{ asset($selectedThumbnail) }}"
                                    alt="{{ $product->product_name }}"
                                />

                            @else

                                <img
                                    id="product_img"
                                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                                    data-zoom-image="{{ asset('frontend/assets/images/no-image.png') }}"
                                    alt="{{ $product->product_name }}"
                                />

                            @endif


                            <a href="#" class="product_img_zoom" title="Zoom">

                                <span class="linearicons-zoom-in"></span>

                            </a>

                        </div>


                        <!-- PRODUCT GALLERY -->

                        <div
                            id="pr_item_gallery"
                            class="product_gallery_item slick_slider"
                            data-slides-to-show="4"
                            data-slides-to-scroll="1"
                            data-infinite="false"
                        >

                            @if(!empty($selectedImages))

                                @foreach ($selectedImages as $key => $image)

                                    <div class="item">

                                        <a
                                            href="#"
                                            class="product_gallery_item {{ $key == 0 ? 'active' : '' }}"
                                            data-image="{{ asset($image) }}"
                                            data-zoom-image="{{ asset($image) }}"
                                        >

                                            <img
                                                src="{{ asset($image) }}"
                                                alt="product_small_img{{ $key + 1 }}"
                                            />

                                        </a>

                                    </div>

                                @endforeach

                            @elseif($selectedThumbnail)

                                <div class="item">

                                    <a
                                        href="#"
                                        class="product_gallery_item active"
                                        data-image="{{ asset($selectedThumbnail) }}"
                                        data-zoom-image="{{ asset($selectedThumbnail) }}"
                                    >

                                        <img
                                            src="{{ asset($selectedThumbnail) }}"
                                            alt="{{ $product->product_name }}"
                                        />

                                    </a>

                                </div>

                            @else

                                <p>No images available for this product.</p>

                            @endif

                        </div>

                    </div>

                    <br>


                    <!-- YouTube Video Embed -->

                    @if(!empty($product->video))

                        <strong>Product Video:</strong>

                        <div class="embed-responsive embed-responsive-16by9">

                            <iframe
                                width="500"
                                height="280"
                                src="https://www.youtube.com/embed/{{ $product->video }}"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                            </iframe>

                        </div>

                    @endif

                </div>


                <!-- =========================================
                     PRODUCT INFORMATION
                ========================================== -->

                <div class="col-lg-6 col-md-6">

                    <div class="pr_detail">

                        <div class="product_description">

                            <h4 class="product_title">
                                <a href="#">
                                    {{ $product->product_name }}
                                </a>
                            </h4>


                            <h6 class="product_title">
                                <a href="#">
                                    Brand:
                                    {{ $product->brand->brand_name }}
                                </a>
                            </h6>


                            <h6 class="product_title">
                                <a href="#">
                                    Stock:
                                    {{ $product->stock_quantity }}
                                </a>
                            </h6>


                            <!-- PRICE -->

                            <div class="product_price">

                                @if ($product->discount_price == Null)

                                    <span class="price">
                                        {{ $setting->currency }}{{ $product->selling_price }}
                                    </span>

                                    <del></del>

                                @else

                                    <span class="price">
                                        {{ $setting->currency }}{{ $product->discount_price }}
                                    </span>

                                    <del>
                                        {{ $setting->currency }}{{ $product->selling_price }}
                                    </del>

                                    @php

                                        $discount =
                                            ($product->selling_price - $product->discount_price)
                                            / $product->selling_price * 100;

                                    @endphp

                                    <div class="on_sale">

                                        <span>
                                            {{ round($discount) }}% Off
                                        </span>

                                    </div>

                                @endif

                            </div>


                            <!-- RATING -->

                            <div class="rating_wrap">

                                <div class="rating">

                                    <div
                                        class="product_rate"
                                        style="width: {{ $averageRating ? ($averageRating / 5 * 100) : 0 }}%;"
                                    >
                                    </div>

                                </div>

                                <span class="rating_num">
                                    ({{ $reviewCount }})
                                </span>

                            </div>

                            <br>


                            <!-- SHORT DESCRIPTION -->

                            <div
                                class="pr_desc"
                                style="text-align: justify"
                            >

                                <p>
                                    {{ $product->short_description }}
                                </p>

                            </div>


                            <!-- PRODUCT INFO -->

                            <div class="product_sort_info">

                                <ul>

                                    <li>
                                        <i class="linearicons-map-marker"></i>

                                        <strong>Pickup Point:</strong>

                                        {{ $product->pickuppoint->pickup_point_name ?? 'N/A' }}

                                    </li>

                                    <li>
                                        <i class="linearicons-shield-check"></i>
                                        1 Year AL Jazeera Brand Warranty
                                    </li>

                                    <li>
                                        <i class="linearicons-sync"></i>
                                        30 Day Return Policy
                                    </li>

                                    <li>
                                        <i class="linearicons-bag-dollar"></i>
                                        Cash on Delivery available
                                    </li>

                                </ul>

                            </div>


                            <!-- =====================================
                                 PRODUCT COLORS
                            ====================================== -->

                            <div class="pr_switch_wrap">

                                <span class="switch_lable">
                                    Color
                                </span>

                                <div class="product_color_switch">

                                    @if($product->colors->count() > 0)

                                        @foreach ($product->colors as $productColor)

                                            <span
                                                class="color_option {{ $loop->first ? 'active' : '' }}"
                                                data-color-id="{{ $productColor->id }}"
                                                data-color="{{ $productColor->color }}"
                                                data-thumbnail="{{ $productColor->thumbnail }}"
                                                data-images='@json($productColor->images)'
                                                title="{{ $productColor->color }}"
                                                style="
                                                    background-color: {{ $productColor->color }};
                                                    cursor: pointer;
                                                "
                                            >
                                            </span>

                                        @endforeach

                                    @else

                                        <p>
                                            No Color available for this product.
                                        </p>

                                    @endif

                                </div>

                            </div>


                            <!-- =====================================
                                 SIZE
                            ====================================== -->

                            @if ($product->size == Null)

                            @else

                                <div class="pr_switch_wrap">

                                    <span class="switch_lable">
                                        Size
                                    </span>

                                    <div class="product_size_switch">

                                        @if(!empty($size) && is_array($size))

                                            @foreach ($size as $sizes)

                                                <span>
                                                    {{ $sizes }}
                                                </span>

                                            @endforeach

                                        @else

                                            <p>
                                                No Size available for this product.
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            @endif

                        </div>


                        <hr />


                        <!-- =====================================
                             ADD TO CART
                        ====================================== -->

                        <form
                            action="{{ route('add.to.cart.quickview') }}"
                            method="POST"
                            id="add_cart_form"
                        >

                            @csrf

                            <div class="cart_extra">

                                <div class="cart-product-quantity">

                                    <div class="quantity">

                                        <input
                                            type="button"
                                            value="-"
                                            class="minus"
                                        >

                                        <input
                                            type="text"
                                            name="qty"
                                            value="1"
                                            title="Qty"
                                            class="qty"
                                            size="4"
                                        >

                                        <input
                                            type="button"
                                            value="+"
                                            class="plus"
                                        >

                                    </div>

                                </div>


                                {{-- Cart and details --}}

                                <input
                                    type="hidden"
                                    name="id"
                                    value="{{ $product->id }}"
                                >


                                @if($product->discount_price == NULL)

                                    <input
                                        type="hidden"
                                        name="price"
                                        value="{{ $product->selling_price }}"
                                        id="product-price"
                                    >

                                @else

                                    <input
                                        type="hidden"
                                        name="price"
                                        value="{{ $product->discount_price }}"
                                        id="product-price"
                                    >

                                @endif


                                <!-- SELECTED COLOR ID -->

                                <input
                                    type="hidden"
                                    name="product_color_id"
                                    value="{{ $selectedColor->id ?? '' }}"
                                    id="product-color-id"
                                >


                                <!-- SELECTED COLOR NAME -->

                                <input
                                    type="hidden"
                                    name="color"
                                    value="{{ $selectedColor->color ?? '' }}"
                                    id="product-color"
                                >


                                <!-- SELECTED SIZE -->

                                <input
                                    type="hidden"
                                    name="size"
                                    value=""
                                    id="product-size"
                                >


                                <div class="cart_btn">

                                    @if($product->stock_quantity < 1)

                                        <button
                                            class="btn btn-fill-outline-danger"
                                            disabled
                                        >
                                            <i class="icon-basket-loaded"></i>
                                            Stock Out
                                        </button>

                                    @else

                                        <button
                                            class="btn btn-fill-out btn-addtocart"
                                            type="submit"
                                        >

                                            <i class="icon-basket-loaded"></i>

                                            <span class="loading d-none">
                                                ....
                                            </span>

                                            Add to cart

                                        </button>

                                    @endif


                                    <a
                                        class="add_compare"
                                        href="#"
                                    >
                                        <i class="icon-shuffle"></i>
                                    </a>


                                    <a
                                        class="add_wishlist"
                                        href="{{ route('wishlist.add', $product->id) }}"
                                    >
                                        <i class="icon-heart"></i>
                                    </a>

                                </div>

                            </div>

                        </form>


                        <hr />


                        <!-- PRODUCT META -->

                        <ul class="product-meta">

                            <li>
                                product_code:

                                <a href="#">
                                    {{ $product->product_code }}
                                </a>
                            </li>


                            <li>
                                Category:

                                <a href="#">
                                    {{ $product->category->category_name }}
                                </a>
                            </li>


                            <li>
                                Tags:

                                @if(!empty($tags) && is_array($tags))

                                    @foreach ($tags as $tag)

                                        <a href="#" rel="tag">
                                            {{ $tag }}
                                        </a>

                                        @if (!$loop->last)
                                            ,
                                        @endif

                                    @endforeach

                                @else

                                    <p>
                                        No Tags available for this product.
                                    </p>

                                @endif

                            </li>

                        </ul>


                        <!-- SHARE -->

                        <div class="product_share">

                            <span>
                                Share:
                            </span>

                            <ul class="social_icons">

                                <li>
                                    <a href="{{ $setting->facebook }}">
                                        <i class="ion-social-facebook"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ $setting->twitter }}">
                                        <i class="ion-social-twitter"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ $setting->linkedin }}">
                                        <i class="ion-social-linkedin"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ $setting->youtube }}">
                                        <i class="ion-social-youtube-outline"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ $setting->instragram }}">
                                        <i class="ion-social-instagram-outline"></i>
                                    </a>
                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>


            <div class="row">

                <div class="col-12">

                    <div class="large_divider clearfix"></div>

                </div>

            </div>


            <!-- =====================================
                 TABS
            ====================================== -->

            <div class="row">

                <div class="col-12">

                    <div class="tab-style3">

                        <ul
                            class="nav nav-tabs"
                            role="tablist"
                        >

                            <li class="nav-item">

                                <a
                                    class="nav-link active"
                                    id="Description-tab"
                                    data-bs-toggle="tab"
                                    href="#Description"
                                    role="tab"
                                    aria-controls="Description"
                                    aria-selected="true"
                                >
                                    Description
                                </a>

                            </li>


                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    id="Additional-info-tab"
                                    data-bs-toggle="tab"
                                    href="#Additional-info"
                                    role="tab"
                                    aria-controls="Additional-info"
                                    aria-selected="false"
                                >
                                    Additional info
                                </a>

                            </li>


                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    id="Reviews-tab"
                                    data-bs-toggle="tab"
                                    href="#Reviews"
                                    role="tab"
                                    aria-controls="Reviews"
                                    aria-selected="false"
                                >
                                    Reviews ({{ $reviewCount }})
                                </a>

                            </li>

                        </ul>


                        <div class="tab-content shop_info_tab">


                            <style>

                                #Description p {
                                    text-align: justify;
                                }

                            </style>


                            <!-- DESCRIPTION -->

                            <div
                                class="tab-pane fade show active"
                                id="Description"
                                role="tabpanel"
                                aria-labelledby="Description-tab"
                            >

                                <p>
                                    {!! $product->description !!}
                                </p>

                            </div>


                            <!-- ADDITIONAL INFORMATION -->

                            <div
                                class="tab-pane fade"
                                id="Additional-info"
                                role="tabpanel"
                                aria-labelledby="Additional-info-tab"
                            >

                                <table class="table table-bordered">

                                    <tr>

                                        <td>
                                            Stock:
                                        </td>

                                        <td>
                                            {{ $product->stock_quantity }}
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            Unit:
                                        </td>

                                        <td>
                                            {{ $product->unit }}
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>
                                            Color:
                                        </td>

                                        <td>

                                            @if($product->colors->count() > 0)

                                                @foreach($product->colors as $productColor)

                                                    {{ $productColor->color }}

                                                    @if(!$loop->last)
                                                        ,
                                                    @endif

                                                @endforeach

                                            @else

                                                N/A

                                            @endif

                                        </td>

                                    </tr>


                                    @if ($product->size == Null)

                                    @else

                                        <tr>

                                            <td>
                                                Size:
                                            </td>

                                            <td>
                                                {{ $product->size }}
                                            </td>

                                        </tr>

                                    @endif

                                </table>

                            </div>


                            <!-- REVIEWS -->

                            <div
                                class="tab-pane fade"
                                id="Reviews"
                                role="tabpanel"
                                aria-labelledby="Reviews-tab"
                            >

                                <div class="comments">

                                    @if ($reviews->isNotEmpty())

                                        <h5 class="product_tab_title">

                                            {{ $reviewCount }} Review For

                                            <span>
                                                {{ $reviews->first()->product->product_name }}
                                            </span>

                                        </h5>

                                    @endif


                                    <ul class="list_none comment_list mt-4">

                                        @foreach ($reviews as $review)

                                            <li>

                                                <div class="comment_img">

                                                    <img
                                                        src="{{ asset($review->user->profile_image) }}"
                                                        alt="user"
                                                    />

                                                </div>


                                                <div class="comment_block">

                                                    <div class="rating_wrap">

                                                        <div class="rating">

                                                            <div
                                                                class="product_rate"
                                                                style="width:{{ ($review->rating / 5) * 100 }}%;"
                                                            >
                                                            </div>

                                                        </div>

                                                    </div>


                                                    <p class="customer_meta">

                                                        <span class="review_author">
                                                            {{ $review->user->name }}
                                                        </span>

                                                        <span class="comment-date">
                                                            {{ $review->review_date }}
                                                        </span>

                                                    </p>


                                                    <div class="description">

                                                        <p>
                                                            {{ $review->review }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </li>

                                        @endforeach

                                    </ul>

                                </div>


                                <!-- REVIEW FORM -->

                                <div class="review_form field_form">

                                    <h5>
                                        Add a review
                                    </h5>


                                    <form
                                        class="row mt-3"
                                        action="{{ route('reviews.store') }}"
                                        method="POST"
                                    >

                                        @csrf


                                        <div class="form-group col-12 mb-3">

                                            <div
                                                class="star_rating"
                                                style="display: flex;"
                                            >

                                                <span
                                                    data-value="1"
                                                    style="cursor: pointer;"
                                                >
                                                    <i class="far fa-star"></i>
                                                </span>

                                                <span
                                                    data-value="2"
                                                    style="cursor: pointer;"
                                                >
                                                    <i class="far fa-star"></i>
                                                </span>

                                                <span
                                                    data-value="3"
                                                    style="cursor: pointer;"
                                                >
                                                    <i class="far fa-star"></i>
                                                </span>

                                                <span
                                                    data-value="4"
                                                    style="cursor: pointer;"
                                                >
                                                    <i class="far fa-star"></i>
                                                </span>

                                                <span
                                                    data-value="5"
                                                    style="cursor: pointer;"
                                                >
                                                    <i class="far fa-star"></i>
                                                </span>

                                            </div>


                                            <input
                                                type="hidden"
                                                name="rating"
                                                value="0"
                                            >

                                        </div>


                                        <div class="form-group col-12 mb-3">

                                            <textarea
                                                required="required"
                                                placeholder="Your review *"
                                                class="form-control"
                                                name="review"
                                                rows="4"
                                            ></textarea>

                                        </div>


                                        <input
                                            type="hidden"
                                            name="product_id"
                                            value="{{ $product->id }}"
                                        >


                                        <div class="form-group col-12 mb-3">

                                            @if(Auth::check())

                                                <button
                                                    type="submit"
                                                    class="btn btn-fill-out"
                                                    name="submit"
                                                    value="Submit"
                                                >
                                                    Submit Review
                                                </button>

                                            @else

                                                <p class="text-danger">
                                                    Please at first login to your account for submitting a review.
                                                </p>

                                            @endif

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="row">

                <div class="col-12">

                    <div class="small_divider"></div>

                    <div class="divider"></div>

                    <div class="medium_divider"></div>

                </div>

            </div>


            <!-- =====================================
                 RELATED PRODUCTS
            ====================================== -->

            <div class="row">

                <div class="col-12">

                    <div class="heading_s1">

                        <h3>
                            Related Products
                        </h3>

                    </div>


                    <div
                        class="releted_product_slider carousel_slider owl-carousel owl-theme"
                        data-margin="20"
                        data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'
                    >

                        @foreach($releted_product as $row)

                            @php

                                $relatedColor = $row->colors->first();

                            @endphp

                            <div class="item">

                                <div class="product">

                                    <div class="product_img">

                                        <a href="{{ route('product.details', $row->product_slug) }}">

                                            @if($relatedColor && $relatedColor->thumbnail)

                                                <img
                                                    src="{{ asset($relatedColor->thumbnail) }}"
                                                    alt="{{ $row->product_name }}"
                                                >

                                            @else

                                                <img
                                                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                                                    alt="{{ $row->product_name }}"
                                                >

                                            @endif

                                        </a>

                                    </div>


                                    <div class="product_info">

                                        <h6 class="product_title">

                                            <a href="{{ route('product.details', $row->product_slug) }}">

                                                {{ substr($row->product_name, 0, 40) }}

                                            </a>

                                        </h6>


                                        <div class="product_price">

                                            @if ($row->discount_price == null)

                                                <span class="price">

                                                    {{ $setting->currency }}{{ $row->selling_price }}

                                                </span>

                                            @else

                                                <span class="price">

                                                    {{ $setting->currency }}{{ $row->discount_price }}

                                                </span>

                                                <del>

                                                    {{ $setting->currency }}{{ $row->selling_price }}

                                                </del>

                                                @php

                                                    $discount =
                                                        ($row->selling_price - $row->discount_price)
                                                        / $row->selling_price * 100;

                                                @endphp

                                                <div class="on_sale">

                                                    <span>
                                                        {{ round($discount) }}% Off
                                                    </span>

                                                </div>

                                            @endif

                                        </div>


                                        <div class="rating_wrap">

                                            <div class="rating">

                                                <div
                                                    class="product_rate"
                                                    style="width: {{ ($row->average_rating / 5) * 100 }}%;"
                                                >
                                                </div>

                                            </div>

                                            <span class="rating_num">
                                                ({{ $row->review_count }} Reviews)
                                            </span>

                                        </div>


                                        <div class="pr_desc">

                                            <p>
                                                {{ \Illuminate\Support\Str::limit(strip_tags($row->description), 100) }}
                                            </p>

                                        </div>


                                        <!-- RELATED PRODUCT COLORS -->

                                        <div class="pr_switch_wrap">

                                            <div class="product_color_switch">

                                                @if($row->colors->count() > 0)

                                                    @foreach ($row->colors as $relatedProductColor)

                                                        <span
                                                            class="active"
                                                            data-color="{{ $relatedProductColor->color }}"
                                                            title="{{ $relatedProductColor->color }}"
                                                            style="
                                                                background-color: {{ $relatedProductColor->color }};
                                                            "
                                                        >
                                                        </span>

                                                    @endforeach

                                                @else

                                                    <p>
                                                        No Color available for this product.
                                                    </p>

                                                @endif

                                            </div>

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
    <!-- END SECTION SHOP -->


    <!-- START SECTION SUBSCRIBE NEWSLETTER -->

    @include('frontend.layouts.subscribe')

    <!-- END SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->


<!-- START FOOTER -->

@include('frontend.layouts.others_footer')

<!-- END FOOTER -->


<!-- =====================================
     RATING SYSTEM
====================================== -->

<script>

    document.querySelectorAll('.star_rating span').forEach(function(star) {

        star.addEventListener('click', function() {

            document
                .querySelectorAll('.star_rating span')
                .forEach(function(otherStar) {

                    otherStar.classList.remove('selected');

                });

            this.classList.add('selected');

            document.querySelector(
                'input[name="rating"]'
            ).value = this.getAttribute('data-value');

        });

    });

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<!-- =====================================
     COLOR CHANGE
====================================== -->

<script>

$(document).ready(function () {

    $('.color_option').on('click', function (e) {

        e.preventDefault();

        /*
        |--------------------------------------------------------------------------
        | Selected Color
        |--------------------------------------------------------------------------
        */

        let colorId =
            $(this).data('color-id');

        let colorName =
            $(this).data('color');

        let thumbnail =
            $(this).data('thumbnail');

        let images =
            $(this).attr('data-images');


        /*
        |--------------------------------------------------------------------------
        | Active Color
        |--------------------------------------------------------------------------
        */

        $('.color_option').removeClass('active');

        $(this).addClass('active');


        /*
        |--------------------------------------------------------------------------
        | Update Hidden Color
        |--------------------------------------------------------------------------
        */

        $('#product-color-id').val(colorId);

        $('#product-color').val(colorName);


        /*
        |--------------------------------------------------------------------------
        | Update Main Image
        |--------------------------------------------------------------------------
        */

        if (thumbnail) {

            $('#product_img')
                .attr('src', '{{ asset('') }}' + thumbnail)
                .attr('data-zoom-image', '{{ asset('') }}' + thumbnail);

        }


        /*
        |--------------------------------------------------------------------------
        | Update Gallery
        |--------------------------------------------------------------------------
        */

        let gallery =
            $('#pr_item_gallery');


        if (gallery.hasClass('slick-initialized')) {

            gallery.slick('unslick');

        }


        gallery.empty();


        let imageArray = [];

        try {

            imageArray =
                JSON.parse(images);

        } catch (error) {

            imageArray = [];

        }


        /*
        |--------------------------------------------------------------------------
        | If No Gallery Image
        |--------------------------------------------------------------------------
        */

        if (
            !Array.isArray(imageArray) ||
            imageArray.length === 0
        ) {

            if (thumbnail) {

                gallery.append(`

                    <div class="item">

                        <a
                            href="#"
                            class="product_gallery_item active"
                            data-image="{{ asset('') }}${thumbnail}"
                            data-zoom-image="{{ asset('') }}${thumbnail}"
                        >

                            <img
                                src="{{ asset('') }}${thumbnail}"
                                alt="{{ $product->product_name }}"
                            />

                        </a>

                    </div>

                `);

            }

        } else {

            /*
            |--------------------------------------------------------------------------
            | Add Gallery Images
            |--------------------------------------------------------------------------
            */

            imageArray.forEach(function (image, index) {

                gallery.append(`

                    <div class="item">

                        <a
                            href="#"
                            class="product_gallery_item ${index === 0 ? 'active' : ''}"
                            data-image="{{ asset('') }}${image}"
                            data-zoom-image="{{ asset('') }}${image}"
                        >

                            <img
                                src="{{ asset('') }}${image}"
                                alt="product_small_img${index + 1}"
                            />

                        </a>

                    </div>

                `);

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Reinitialize Slick
        |--------------------------------------------------------------------------
        */

        gallery.slick({

            slidesToShow: 4,

            slidesToScroll: 1,

            infinite: false,

            responsive: [

                {
                    breakpoint: 768,

                    settings: {
                        slidesToShow: 3
                    }

                },

                {
                    breakpoint: 480,

                    settings: {
                        slidesToShow: 2
                    }

                }

            ]

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Gallery Image Click
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.product_gallery_item',
        function (e) {

            e.preventDefault();

            let image =
                $(this).data('image');

            let zoomImage =
                $(this).data('zoom-image');


            $('.product_gallery_item')
                .removeClass('active');

            $(this).addClass('active');


            $('#product_img')
                .attr('src', image)
                .attr('data-zoom-image', zoomImage);

        }
    );

});

</script>


<!-- =====================================
     LOADER
====================================== -->

<script>

$(document).ready(function(){

    setTimeout(function() {

        $('.product_view')
            .removeClass("d-none");

        $('.loader')
            .css("display", "none");

    }, 500);

});

</script>

@endsection