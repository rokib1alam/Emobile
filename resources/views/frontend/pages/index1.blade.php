@extends('layouts.app')
@section('title','Home')
@section('content')

<!-- START HEADER -->
@include('frontend.layouts.eheader')
<!-- END HEADER -->
<!-- START SECTION BANNER -->
@include('frontend.layouts.slider')
<!-- END SECTION BANNER -->
<!-- START MAIN CONTENT -->
<!-- END MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION CATEGORIES -->
    <div class="section pt-0 small_pb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cat_overlap radius_all_5">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-4">
                                <div class="text-center text-md-start">
                                    <h4>Top Categories</h4>
                                    {{-- <p class="mb-2">Be furniture for every room and style.</p> --}}
                                    {{-- <a href="#" class="btn btn-line-fill btn-sm">View All</a> --}}
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5"
                                    data-loop="true" data-dots="false" data-nav="true" data-margin="30"
                                    data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}'>

                                    @foreach ($top_viewed_categories as $category)
                                            <div class="item">
                                                <div class="categories_box text-center">
                                                    <a href="{{ url('category/'.$category->category_slug) }}">
                                                        <i class="{{ $category->icon }}" style="font-size: 3em;"></i>
                                                        <span>{{ $category->category_name }}</span>
                                                    </a>
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
    <!-- END SECTION CATEGORIES -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt pb_70">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                <h2>Our featured Products</h2>
                </div>
                <p class="text-center leads">Discover the finest furniture pieces crafted for style, comfort, and durability.</p>
            </div>
            </div>

            <div class="row shop_container">
                @foreach ($featured as $featur)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="product_box text-center">
                        <div class="product_img">
                            <a href="{{ route('product.details', $featur->product_slug) }}">
                            <img src="{{ asset($featur->thumbnail) }}" alt="{{ $featur->product_name }}">
                            </a>
                            <div class="product_action_box">
                            <ul class="list_none pr_action_btn">
                                <li>
                                    <a href="javascript:void(0)" onclick="addToCompare({{ $featur->id }})" >
                                        <i class="icon-shuffle"></i> Compare
                                    </a>
                                </li>
                                <li><a href="#" id="{{$featur->id}}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                <li><a href="{{ route('wishlist.add', $featur->id) }}"><i class="icon-heart"></i></a></li>
                            </ul>
                            </div>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title">
                            <a href="{{ route('product.details', $featur->product_slug) }}">{{ $featur->product_name }}</a>
                            </h6>
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
                            <div class="pr_desc">
                            <p>{{ Str::limit($featur->short_description ?? 'No description available', 100) }}</p>
                            </div>
                        @php
                            $sizes = explode(',', $featur->size);
                            $colors = explode(',', $featur->color);
                            $defaultSize = $sizes[0] ?? '';
                            $defaultColor = $colors[0] ?? '';
                            $price = $featur->discount_price ?? $featur->selling_price;
                        @endphp

                        <div class="add-to-cart">
                            <button class="btn btn-fill-out btn-radius add-to-cart"
                                    data-id="{{ $featur->id }}"
                                    data-price="{{ $featur->discount_price ?? $featur->selling_price }}"
                                    data-color="{{ explode(',', $featur->color)[0] ?? '' }}"
                                    data-size="{{ explode(',', $featur->size)[0] ?? '' }}"
                                    data-qty="1">
                                <i class="icon-basket-loaded"></i> Add To Cart
                            </button>
                        </div>

                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION Deal -->
    @if($today_deal)
        <div class="section background_bg" data-img-src="{{ asset($today_deal->thumbnail) }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-9">
                        <div class="furniture_banner">
                            <h3 class="single_bn_title">{{ Str::limit($today_deal->product_name, 30) }}</h3>

                            <h4 class="single_bn_title1 text_default">
                                @if ($today_deal->discount_price)
                                    Sale {{ round((($today_deal->selling_price - $today_deal->discount_price) / $today_deal->selling_price) * 100) }}% Off
                                @else
                                    Special Offer
                                @endif
                            </h4>

                            <div class="countdown_time countdown_style3 mb-4" data-time="{{ $today_deal->countdown_time ?? now()->addDays(2)->format('Y/m/d H:i:s') }}"></div>

                            <a href="{{ route('product.details', $today_deal->product_slug) }}" class="btn btn-fill-out">Shop Now</a>

                            <div class="newsletter_form2 mt-5">
                                <form method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input name="email" required type="email" class="form-control" placeholder="Enter Your Email">
                                        <button class="btn btn-fill-out text-uppercase" type="submit">Subscribe</button>
                                    </div>
                                    <div class="form-group">
                                        <small>To receive latest offers and discounts from the shop.</small>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- END SECTION Deal -->

    <!-- START SECTION SHOP -->
<div class="section pb_20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Special Offers</h2>
                </div>
                <p class="text-center leads">Discover the finest furniture pieces crafted for style, comfort, and durability.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product_slider carousel_slider owl-carousel owl-theme nav_style5"
                     data-loop="true" data-dots="false" data-nav="true" data-margin="30"
                     data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                    @foreach($trendy_product as $product)
                        @php
                            $sizes = explode(',', $product->size);
                            $colors = explode(',', $product->color);
                            $defaultSize = $sizes[0] ?? '';
                            $defaultColor = $colors[0] ?? '';
                            $price = $product->discount_price ?? $product->selling_price;
                            $discount = $product->discount_price
                                ? round(($product->selling_price - $product->discount_price) / $product->selling_price * 100)
                                : null;
                        @endphp

                        <div class="item">
                            <div class="product_box text-center">
                                <div class="product_img">
                                    <a href="{{ route('product.details', $product->product_slug) }}">
                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="#" id="{{ $product->id }}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="{{ route('wishlist.add', $product->id) }}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title">
                                        <a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                    </h6>
                                    <div class="product_price">
                                        <span class="price">{{ $setting->currency }}{{ number_format($price, 2) }}</span>
                                        @if($product->discount_price)
                                            <del>{{ $setting->currency }}{{ number_format($product->selling_price, 2) }}</del>
                                        @endif
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                        </div>
                                        <span class="rating_num">({{ $product->reviewCount }})</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>{{ Str::limit($product->short_description ?? 'No description available.', 100) }}</p>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="btn btn-fill-out btn-radius add-to-cart"
                                                data-id="{{ $product->id }}"
                                                data-price="{{ $product->discount_price ?? $product->selling_price }}"
                                                data-color="{{ explode(',', $product->color)[0] ?? '' }}"
                                                data-size="{{ explode(',', $product->size)[0] ?? '' }}"
                                                data-qty="1">
                                            <i class="icon-basket-loaded"></i> Add To Cart
                                        </button>
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
