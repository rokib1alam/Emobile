@extends('layouts.app')
@section('title','Shopwise|Product')
@section('content')
<!-- START HEADER -->
@include('frontend.layouts.others_header')
<!-- END HEADER -->
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{ $title }}</h1> <!-- Dynamic page title -->
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li> <!-- Dynamic breadcrumb -->
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
    	<div class="row">
			<div class="col-lg-9">
            	<div class="row align-items-center mb-4 pb-1">
                    <div class="col-12">
                        <form method="GET">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select name="sort" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="">Default</option>
                                            <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Sort by popularity</option>
                                            <option value="newness" {{ request('sort') == 'newness' ? 'selected' : '' }}>Sort by newness</option>
                                            <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}>Price low to high</option>
                                            <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}>Price high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:;" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                        <a href="javascript:;" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">
                                        <select name="perPage" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="9" {{ request('perPage') == 9 ? 'selected' : '' }}>9</option>
                                            <option value="12" {{ request('perPage') == 12 ? 'selected' : '' }}>12</option>
                                            <option value="18" {{ request('perPage') == 18 ? 'selected' : '' }}>18</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row shop_container">
                {{-- @foreach ($products as $product)
                    <div class="col-md-4 col-6">
                        <div class="product">
                            <div class="product_img">
                                <a href="{{ route('product.details', $product->product_slug) }}">
                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->product_name }}">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart">
                                            <button class="btn btn-fill-out btn-radius add-to-cart"
                                                    data-id="{{ $product->id }}"
                                                    data-price="{{ $product->discount_price ?? $product->selling_price }}"
                                                    data-color="{{ explode(',', $product->color)[0] ?? '' }}"
                                                    data-size="{{ explode(',', $product->size)[0] ?? '' }}"
                                                    data-qty="1">
                                                <i class="icon-basket-loaded"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" >
                                                <i class="icon-shuffle"></i> Compare
                                            </a>
                                        </li>
                                        <li><a href="#" id="{{ $product->id }}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal"><i class="icon-magnifier-add"></i></a></li>
                                        <li><a href="#"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title">
                                    <a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h6>
                                <div class="product_price">
                                    @if ($product->discount_price)
                                        <span class="price">{{ $setting->currency }}{{ number_format($product->discount_price, 2) }}</span>
                                        <del>{{ $setting->currency }}{{ number_format($product->selling_price, 2) }}</del>
                                        @php
                                            $discount = round((($product->selling_price - $product->discount_price) / $product->selling_price) * 100);
                                        @endphp
                                        <div class="on_sale"><span>{{ $discount }}% Off</span></div>
                                    @else
                                        <span class="price">${{ number_format($product->selling_price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{ ($product->averageRating / 5) * 100 }}%"></div>
                                    </div>
                                    <span class="rating_num">({{ $product->reviewCount }})</span>
                                </div>
                                <div class="pr_desc">
                                    <p>{{ Str::limit($product->short_description ?? 'No description available', 100) }}</p>
                                </div>
                                <div class="pr_switch_wrap">
                                    <div class="product_color_switch">
                                        @php
                                            $colors = explode(',', $product->color);
                                        @endphp
                                        @foreach ($colors as $color)
                                            <span data-color="{{ $color }}"></span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="list_product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart">
                                            <a href="javascript:void(0);"
                                            class="add-to-cart-btn"
                                            data-id="{{ $product->id }}">
                                            <i class="icon-basket-loaded"></i> Add To Cart
                                            </a>
                                        </li>
                                        <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                        <li><a href="#" class="popup-ajax" data-bs-toggle="modal" data-bs-target="#quickviewModal" data-id="{{ $product->id }}"><i class="icon-magnifier-add"></i></a></li>
                                        <li><a href="#"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                @foreach ($products as $featur)
                    <div class="col-md-4 col-6">
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
        		<div class="row">
                    <div class="col-12">
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $products->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
        	</div>
            <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
            	<div class="sidebar">
                	<div class="widget">
                        <h5 class="widget_title">Categories</h5>
                        <ul class="widget_categories">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('slug.handler', $category->category_slug) }}">
                                        <span class="categories_name">{{ $category->category_name }}</span>
                                        <span class="categories_num">({{ $category->products_count }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Filter</h5>
                        <form method="GET" id="priceFilterForm">
                            <div class="filter_price">
                                <div id="price_filter"
                                    data-min="0"
                                    data-max="5000"
                                    data-min-value="{{ request('min_price', 0) }}"
                                    data-max-value="{{ request('max_price', 5000) }}"
                                    data-price-sign="{{ $setting->currency ?? '$' }}">
                                </div>
                                <div class="price_range mt-2">
                                    <span>Price: <span id="flt_price">{{ request('min_price', 0) }} - {{ request('max_price', 5000) }}</span></span>
                                    <input type="hidden" id="price_first" name="min_price" value="{{ request('min_price', 0) }}">
                                    <input type="hidden" id="price_second" name="max_price" value="{{ request('max_price', 5000) }}">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Brand Filter -->
                    <div class="widget">
                        <h5 class="widget_title">Brand</h5>
                        <ul class="list_brand">
                            @foreach($brands as $brand)
                            <li>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" id="brand_{{ $brand->id }}" name="brands[]" value="{{ $brand->id }}">
                                    <label class="form-check-label" for="brand_{{ $brand->id }}">
                                        <span>{{ $brand->brand_name }}</span>
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Size Filter -->
                    <div class="widget">
                        <h5 class="widget_title">Size</h5>
                        <div class="product_size_switch">
                            @foreach($sizes as $size)
                                <span>{{ $size }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color Filter -->
                    <div class="widget">
                        <h5 class="widget_title">Color</h5>
                        <div class="product_color_switch">
                            @foreach($colors as $color)
                                <span data-color="{{ $color }}"></span>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

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
<script>
$(function () {
    let $slider = $("#price_filter");
    let min = parseInt($slider.data('min'));
    let max = parseInt($slider.data('max'));
    let minVal = parseInt($slider.data('min-value'));
    let maxVal = parseInt($slider.data('max-value'));
    let sign = $slider.data('price-sign');

    $slider.slider({
        range: true,
        min: min,
        max: max,
        values: [minVal, maxVal],
        slide: function (event, ui) {
            $("#flt_price").text(sign + ui.values[0] + " - " + sign + ui.values[1]);
            $("#price_first").val(ui.values[0]);
            $("#price_second").val(ui.values[1]);
        },
        stop: function () {
            $("#priceFilterForm").submit();
        }
    });

    // Initial label set
    $("#flt_price").text(sign + $slider.slider("values", 0) +
        " - " + sign + $slider.slider("values", 1));
});
</script>

<!-- START FOOTER -->
@include('frontend.layouts.others_footer')
<!-- END FOOTER -->
@endsection
