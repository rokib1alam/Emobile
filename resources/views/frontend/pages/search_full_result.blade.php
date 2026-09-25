@extends('layouts.app')

@section('title','Product')

@section('content')

<!-- START HEADER -->

@include('frontend.layouts.nheader')

<!-- START SECTION -->

<div class="container py-5">

    <h4 class="mb-4">
        Search Results for "{{ $query }}"
    </h4>

    @if($products->count())

        <div class="row">

            @foreach($products as $product)

                @php
                    $productColor = $product->colors
                        ->whereNotNull('thumbnail')
                        ->first();

                    $price = $product->discount_price
                        ?? $product->selling_price;
                @endphp

                <div class="col-md-3 mb-4">

                    <div class="card h-100">

                        <a href="{{ route('product.details', $product->product_slug) }}">

                            @if($productColor && $productColor->thumbnail)

                                <img
                                    src="{{ asset($productColor->thumbnail) }}"
                                    class="card-img-top"
                                    alt="{{ $product->product_name }}"
                                    style="width:100%; height:220px; object-fit:contain;"
                                >

                            @else

                                <img
                                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                                    class="card-img-top"
                                    alt="{{ $product->product_name }}"
                                    style="width:100%; height:220px; object-fit:contain;"
                                >

                            @endif

                        </a>

                        <div class="card-body">

                            <h6 class="product_title">

                                <a href="{{ route('product.details', $product->product_slug) }}">

                                    {{ $product->product_name }}

                                </a>

                            </h6>

                            <div class="product_price">

                                <span class="price">

                                    {{ $setting->currency }}
                                    {{ number_format($price, 2) }}

                                </span>

                                @if($product->discount_price)

                                    <del>

                                        {{ $setting->currency }}
                                        {{ number_format($product->selling_price, 2) }}

                                    </del>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        <div class="mt-4">

            {{ $products->withQueryString()->links() }}

        </div>


    @else

        <p>
            No products found for this search.
        </p>

    @endif


    <div class="row">

        <div class="col-12">

            <div class="mt-3 d-flex justify-content-center">

                {{ $products->links('vendor.pagination.bootstrap-4') }}

            </div>

        </div>

    </div>

</div>

<!-- END SECTION -->


<!-- START FOOTER -->

@include('frontend.layouts.others_footer')

<!-- END FOOTER -->

@endsection