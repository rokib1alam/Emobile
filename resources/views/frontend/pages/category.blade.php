@extends('layouts.app')
@section('title','Product')
@section('content')
<!-- START HEADER -->
@include('frontend.layouts.nheader')
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

                @foreach ($products as $featur)
                    @php
                        $imgSrc = $featur->colors?->first()?->thumbnail 
                                ?? $featur->thumbnail 
                                ?? $featur->product_thambnail 
                                ?? $featur->image 
                                ?? null;

                        if ($imgSrc) {
                            
                            if (str_starts_with($imgSrc, 'public/')) {
                                $imgSrc = substr($imgSrc, 7);
                            }
                            $finalImage = asset($imgSrc);
                        } else {
                            
                            $finalImage = asset('frontend/assets/images/no-image.png');
                        }
                    @endphp

                <div class="col-md-4 col-6">
                    <div class="product_box text-center">
                        <div class="product_img">
                            <a href="{{ route('product.details', $featur->product_slug) }}">
                                <img src="{{ $finalImage }}" alt="{{ $featur->product_name }}">
                            </a>
                            <div class="product_action_box">
                                <ul class="list_none pr_action_btn">
                                    {{-- Quick View Button --}}
                                    <li>
                                        <a href="#" id="{{ $featur->id }}" class="Quickview" data-bs-toggle="modal" data-bs-target="#quickviewModal" title="Quick View">
                                            <i class="icon-magnifier-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title">
                                <a href="{{ route('product.details', $featur->product_slug) }}">{{ $featur->product_name }}</a>
                            </h6>
                            <div class="product_price">
                                @if ($featur->discount_price == null)
                                    <span class="price">{{ $setting->currency ?? '$' }}{{ number_format((float) $featur->selling_price, 2) }}</span>
                                @else
                                    <span class="price">{{ $setting->currency ?? '$' }}{{ number_format((float) $featur->discount_price, 2) }}</span>
                                    <del>{{ $setting->currency ?? '$' }}{{ number_format((float) $featur->selling_price, 2) }}</del>
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

                            <div class="pr_desc">
                                <p>{{ Str::limit($featur->short_description ?? 'No description available', 100) }}</p>
                            </div>

                            {{-- Buy Now Button (Class changed from add-to-cart to buy-now-wrapper) --}}
                            <div class="buy-now-wrapper mt-3">
                                <a href="{{ route('checkout', ['product_id' => $featur->id, 'qty' => 1]) }}" class="btn btn-fill-out btn-radius w-100">
                                    <i class="icon-bag me-1"></i> Buy Now
                                </a>
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
                   

                    <!-- Brand Filter -->
                    <div class="widget">
                        <h5 class="widget_title">Brand</h5>
                        <ul class="list_brand">
                            @foreach($brands as $brand)
                            <li>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" id="brand_{{ $brand->id }}" name="brands[]" value="{{ $brand->id }}">
                                    <label class="form-check-label" for="brand_{{ $brand->id}}">
                                        <span>{{ $brand->brand_name}}</span>
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
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
