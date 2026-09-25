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
            		<h1>Shopping Cart</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    {{-- <li class="breadcrumb-item"><a href="#">{{$product->category->category_name}}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{$product->subcategory->subcategory_name}}</a></li>
                    <li class="breadcrumb-item active">{{$product->childcategory->childcategory_name}}</li> --}}
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
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-color">Color</th>
                                    <th class="product-size">Size</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sum = 0; @endphp

                                @if($products->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No items in cart.</td>
                                    </tr>
                                @else
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="{{ asset($product->options->thumbnail) }}" alt="img"></a>
                                            </td>
                                            <td class="product-name" data-title="Product">
                                                <a href="#" target="_blank">{{ $product->name }}</a>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                {{ $product->price }}
                                            </td>
                                            <td class="product-color" data-title="Color">
                                                @php
                                                    $dbProduct = $product->db_product ?? null;
                                                    $dbColors = [];
                                                    if ($dbProduct && !empty($dbProduct->color)) {
                                                        $dbColors = explode(',', $dbProduct->color);
                                                        $dbColors = array_filter(array_map('trim', $dbColors));
                                                    }
                                                    $selectedColor = $product->options->color ?? '';
                                                @endphp

                                                @if(count($dbColors) > 0)
                                                    <select style="min-width: 100px; background-color: white; height: 38px; padding: 4px 8px; border: 1px solid #ccc; border-radius: 4px;">
                                                        @foreach ($dbColors as $color)
                                                            <option value="{{ $color }}" {{ $color == $selectedColor ? 'selected' : '' }}>
                                                                {{ ucfirst($color) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>

                                            <td class="product-size" data-title="Size">
                                                @php
                                                    $dbProduct = $product->db_product ?? null;
                                                    $dbSizes = [];
                                                    if ($dbProduct && !empty($dbProduct->size)) {
                                                        $dbSizes = explode(',', $dbProduct->size);
                                                        $dbSizes = array_filter(array_map('trim', $dbSizes));
                                                    }
                                                    $selectedSize = $product->options->size ?? '';
                                                @endphp

                                                @if(count($dbSizes) > 0)
                                                    <select style="min-width: 60px; background-color: white; height: 38px; padding: 4px 8px; border: 1px solid #ccc; border-radius: 4px;">
                                                        @foreach ($dbSizes as $size)
                                                            <option value="{{ $size }}" {{ $size == $selectedSize ? 'selected' : '' }}>
                                                                {{ strtoupper($size) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>


                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity">
                                                    <input type="button" value="-" class="minus">
                                                    <input type="number" name="data[{{ $key }}][qty]" value="{{ $product->qty }}" title="Qty" class="qty" size="4" data-id="{{ $product->rowId }}">
                                                    <input type="button" value="+" class="plus">
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                <span class="product-subtotal-text" data-currency="{{ $setting->currency }}">{{ $setting->currency }}{{ $product->subtotal }}</span>
                                            </td>
                                            <td class="product-remove" data-title="Remove">
                                                <a href="javascript:void(0);" class="item_remove remove-cart-item" data-id="{{ $product->rowId }}">
                                                    <i class="ti-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- @php $sum += $product->subtotal; @endphp --}}
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="border p-3 p-md-4">
                        <div class="heading_s1 mb-3">
                            <h6>Cart Totals</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td id="cart-subtotal" data-currency="{{ $setting->currency }}">
                                            {{-- {{ $setting->currency }}{{ $cartSubtotal }} --}}
{{ $setting->currency }}{{ Cart::subtotal() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td id="cart-tax" data-currency="{{ $setting->currency }}">
                                            {{-- {{ $setting->currency }}{{ $cartTax }} --}}
{{ $setting->currency }}{{ Cart::tax() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td id="cart-shipping" data-currency="{{ $setting->currency }}">
                                            @if((float) $shipping == 0)
                                                <strong>Free Shipping</strong>
                                            @else
                                                {{ $setting->currency }}{{ $shipping }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td class="cart_total_amount" data-currency="{{ $setting->currency }}">
                                            <strong><span id="cart-amount">
                                                {{-- {{ $setting->currency }}{{ $cartTotal }} --}}
                                                {{ $setting->currency }}{{ Cart::total() }}
                                                </span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ Auth::check() ? route('checkout') : route('login') }}" class="btn btn-fill-out">
                            Proceed To Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- END SECTION SHOP -->

    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    @include('frontend.layouts.subscribe')
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->

<!-- START FOOTER -->
@include('frontend.layouts.others_footer')
<!-- END FOOTER -->
<!-- Rating System code -->
<script>
    document.querySelectorAll('.star_rating span').forEach(function(star) {
        star.addEventListener('click', function() {
            document.querySelectorAll('.star_rating span').forEach(function(otherStar) {
                otherStar.classList.remove('selected');
            });
            this.classList.add('selected');
            document.querySelector('input[name="rating"]').value = this.getAttribute('data-value');
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(.loader).ready(function(){
    setTimeout(function() {
        $('.product_view').removeClass("d-none")
        $('.loader').css("display", "none");
    }, 500);
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.remove-cart-item', function(e) {
        e.preventDefault();

        var $this = $(this);
        var rowId = $this.data('id');

        if (!rowId) {
            toastr.error('Invalid product selected.');
            return;
        }

        $.ajax({
            url: '{{ route("cart.remove", ":rowId") }}'.replace(':rowId', rowId),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success) {
                    toastr.success(data.message);

                    // Row remove
                    $this.closest('tr').remove();

                    // Update totals
                    updateCartTotals();
                } else {
                    toastr.error('Something went wrong!');
                }
            },
            error: function() {
                toastr.error('Server error occurred!');
            }
        });
    });

    function updateCartTotals() {
        $.ajax({
            url: '{{ route("cart.update") }}',
            type: 'GET',
            success: function(response) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(response, 'text/html');

                var currency = $('#cart-subtotal').data('currency') || '';

                // Cart total elements update
                $('#cart-subtotal').text(currency + $(doc).find('#cart-subtotal').text().replace(currency, ''));
                $('#cart-tax').text(currency + $(doc).find('#cart-tax').text().replace(currency, ''));
                $('#cart-shipping').text(currency + $(doc).find('#cart-shipping').text().replace(currency, ''));
                $('#cart-amount').text(currency + $(doc).find('#cart-amount').text().replace(currency, ''));
            }
        });
    }
</script>


<script>
    function numberWithCommas(x) {
        if (!x) return '0';
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(document).on('change', '.qty', function(e) {
        e.preventDefault();

        var $this = $(this);
        var rowId = $this.closest('tr').find('.remove-cart-item').data('id');
        var qty = $this.val();

        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                rowId: rowId,
                qty: qty
            },

            success: function(data) {
                if (data.success) {
                    toastr.success(data.message);

                    var currency = $('#cart-subtotal').data('currency');
                    console.log("currency:", currency);
                    console.log("data.cartSubtotal:", data.cartSubtotal);
                    console.log("data.cartTax:", data.cartTax);
                    console.log("data.cartShipping:", data.cartShipping);
                    console.log("data.cartTotal:", data.cartTotal);
                    console.log("data.updatedSubtotal:", data.updatedSubtotal);

                    // Update view
                    $('#cart-subtotal').text(currency + numberWithCommas(data.cartSubtotal));
                    $('#cart-tax').text(currency + numberWithCommas(data.cartTax));
                    $('#cart-shipping').text(currency + numberWithCommas(data.cartShipping));

                    $('#cart-amount').text(currency + numberWithCommas(data.cartTotal));


                    $this.closest('tr').find('.product-subtotal-text').text(currency + numberWithCommas(data.updatedSubtotal));

                    updateCart();
                } else {
                    toastr.error('Something went wrong updating quantity.');
                }
            },

            error: function() {
                toastr.error('Server error occurred!');
            }
        });
    });
</script>


@endsection
