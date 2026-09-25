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
            		<h1>Wishlist</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive wishlist_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-stock-status">Stock Status</th>
                                <th class="product-add-to-cart"></th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                     <tbody>
                        @forelse($wishlists as $item)
                            @if($item->product)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{ route('product.details', $item->product->product_slug) }}">
                                            <img src="{{ asset($item->product->thumbnail) }}" alt="{{ $item->product->product_name }}" width="80">
                                        </a>
                                    </td>
                                    <td class="product-name" data-title="Product">
                                        <a href="{{ route('product.details', $item->product->product_slug) }}">
                                            {{ $item->product->product_name }}
                                        </a>
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        {{ $setting->currency ?? '$' }}{{ number_format((float) ($item->product->discount_price ?? $item->product->selling_price), 2) }}
                                    </td>

                                    <td class="product-stock-status" data-title="Stock Status">
                                        @if($item->product->stock_quantity > 0)
                                            <span class="badge rounded-pill text-bg-success">In Stock</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="product-add-to-cart">
                                        {{-- <a href="{{ route('add.to.cart', $item->product->id) }}" class="btn btn-fill-out">
                                            <i class="icon-basket-loaded"></i> Add to Cart
                                        </a> --}}
                                        <button class="btn btn-fill-out btn-radius add-to-cart"
                                                data-id="{{ $item->product->id }}"
                                                data-price="{{ $item->product->discount_price ?? $item->product->selling_price }}"
                                                data-color="{{ explode(',', $item->product->color)[0] ?? '' }}"
                                                data-size="{{ explode(',', $item->product->size)[0] ?? '' }}"
                                                data-qty="1">
                                            <i class="icon-basket-loaded"></i> Add To Cart
                                        </button>
                                    </td>
                                    <td class="product-remove" data-title="Remove">
                                        <a href="javascript:void(0)" class="wishlist-remove-btn" data-id="{{ $item->id }}">
                                            <i class="ti-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">No items in your wishlist.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

<!-- END SECTION SHOP -->


</div>
<!-- END MAIN CONTENT -->

<!-- START FOOTER -->
@include('frontend.layouts.others_footer')
<!-- END FOOTER -->
@endsection
