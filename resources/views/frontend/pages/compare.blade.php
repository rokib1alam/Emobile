@extends('layouts.app')
@section('title','Shopwise|Product')
@section('content')
<!-- START HEADER -->
@include('frontend.layouts.others_header')
<!-- END HEADER -->

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Compare</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Compare</li>
                </ol>
            </div>

        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="compare_box">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="compareTable">
                                <tbody>
                                    <tr class="pr_image">
                                        <td class="row_title">Product Image</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_img" data-product-id="{{ $product->id }}">
                                                <img src="{{ asset($product->thumbnail) }}" alt="compare-img" style="max-width: 100px;">
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_title">
                                        <td class="row_title">Product Name</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="product_name" data-product-id="{{ $product->id }}">
                                                <a href="{{ route('product.details', $product->product_slug) }}">
                                                    {{ $product->product_name }}
                                                </a>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_price">
                                        <td class="row_title">Price</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="product_price" data-product-id="{{ $product->id }}">
                                                <span class="price">{{ $setting->currency }}{{ number_format($product->selling_price, 2) }}</span>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_rating">
                                        <td class="row_title">Rating</td>
                                        @foreach ($compareProducts as $product)
                                            @php
                                                $averageRating = $product->reviews()->avg('rating') ?? 0;
                                                $ratingWidth = ($averageRating / 5) * 100;
                                                $reviewCount = $product->reviews()->count();
                                            @endphp
                                            <td data-product-id="{{ $product->id }}">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width: {{ $ratingWidth }}%"></div>
                                                    </div>
                                                    <span class="rating_num">({{ $reviewCount }})</span>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_add_to_cart">
                                        <td class="row_title">Add To Cart</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_btn" data-product-id="{{ $product->id }}">
                                                <button class="btn btn-fill-out btn-radius add-to-cart"
                                                    data-id="{{ $product->id }}"
                                                    data-price="{{ $product->discount_price ?? $product->selling_price }}"
                                                    data-color="{{ explode(',', $product->color)[0] ?? '' }}"
                                                    data-size="{{ explode(',', $product->size)[0] ?? '' }}"
                                                    data-qty="1">
                                                    <i class="icon-basket-loaded"></i> Add To Cart
                                                </button>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="description">
                                        <td class="row_title">Description</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_text" data-product-id="{{ $product->id }}">
                                                <p>{{ Str::limit(strip_tags($product->description), 100) }}</p>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_color">
                                        <td class="row_title">Color</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_color" data-product-id="{{ $product->id }}">
                                                <div class="product_color_switch">
                                                    @foreach(explode(',', $product->color) as $color)
                                                        <span data-color="{{ trim($color) }}" style="background-color: {{ trim($color) }};"></span>
                                                    @endforeach
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_size">
                                        <td class="row_title">Sizes Available</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_size" data-product-id="{{ $product->id }}">
                                                <span>{{ $product->size }}</span>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_stock">
                                        <td class="row_title">Item Availability</td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_stock" data-product-id="{{ $product->id }}">
                                                @if($product->stock_quantity > 0)
                                                    <span class="in-stock">In Stock</span>
                                                @else
                                                    <span class="out-stock">Out Of Stock</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_remove">
                                        <td class="row_title"></td>
                                        @foreach ($compareProducts as $product)
                                            <td class="row_remove" data-product-id="{{ $product->id }}">
                                                <a href="javascript:void(0);" class="remove-from-compare" data-id="{{ $product->id }}">
                                                    <span>Remove</span> <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>


                            <div id="compare-empty-msg" class="text-center text-danger mt-3 d-none">
                                No products left in compare list.
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
<script>
    function removeFromCompare(productId) {
                axios.get(`/remove-from-compare/${productId}`)
                    .then(function (response) {
                        const data = response.data;
                        if (data.status === 'success') {
                            toastr.success(data.message);

                            // ঐ প্রোডাক্টটি DOM থেকে রিমুভ করো (ধরো row ID আছে `compare_row_{id}`)
                            document.getElementById(`compare_row_${productId}`)?.remove();
                        } else {
                            toastr.warning('Unable to remove product.');
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                        toastr.error('Failed to remove product from compare list.');
                    });
            }

            // Toastr options (optional styling)
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right"
            };

</script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- START FOOTER -->
@include('frontend.layouts.others_footer')
<!-- END FOOTER -->
@endsection
