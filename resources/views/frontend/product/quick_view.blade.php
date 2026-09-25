<div class="modal-content"  style="padding: 20px;">
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
        <div class="product-image">
                <div class="product_img_box">
                    <img id="product_img" src='{{asset($product->thumbnail)}}' data-zoom-image="{{asset($product->thumbnail)}}" alt="product_img1" />
                    {{-- <a href="#" class="product_img_zoom" title="Zoom">
                        <span class="linearicons-zoom-in"></span>
                    </a> --}}
                </div>

                <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false" >
                    @if(!empty($product->images) && is_array($product->images))
                        @foreach ($product->images as $key => $image)
                            <div class="item">
                                <a href="#" class="product_gallery_item {{ $key == 0 ? 'active' : '' }}" data-image="{{ asset('/' . $image) }}" data-zoom-image="{{ asset('/' . $image) }}">
                                    <img src="{{ asset('/' . $image) }}" alt="product_small_img{{ $key + 1 }}" />
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No images available for this product.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="pr_detail">
                <div class="product_description">
                    <h4 class="product_title"><a href="#">{{$product->product_name}}</a></h4>
                    <h6>Brand:{{$product->brand->brand_name}}</h6>
                    <h6>Stock: @if($product->stock_quantity<1) <span class="bg-danger text-white">Stock Out</span> @else <span class="bg-success text-white">Stock Available</span> @endif  </p>
                    <div class="product_price">
                        @if ($product->discount_price==Null)
                            <span class="price">{{$setting->currency}}{{$product->selling_price}}</span>
                            <del></del>
                        @else
                            <span class="price">{{$setting->currency}}{{$product->discount_price}}</span>
                            <del>{{$setting->currency}}{{$product->selling_price}}</del>
                                @php
                                    $discount = ($product->selling_price - $product->discount_price) / $product->selling_price * 100;
                                @endphp
                                <div class="on_sale">
                                    <span>{{ round($discount) }}% Off</span>
                                </div>
                        @endif
                    </div>
                    <div class="rating_wrap">
                            <div class="rating">
                                <div class="product_rate" style="width:{{ $averageRating / 5 * 100 }}%"></div>
                            </div>
                            <span class="rating_num">({{ $reviewCount }})</span>
                        </div><br><br><br>
                    <div class="product_sort_info">
                        <ul>
                            <li><i class="linearicons-map-marker"></i><strong>Pickup Point: </strong>{{$product->pickuppoint->pickup_point_name}}</li>
                            <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty</li>
                            <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                            <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                        </ul>
                    </div>
                    <div class="pr_switch_wrap">
                        <span class="switch_lable">Color</span>
                        <div class="product_color_switch">
                            @if(!empty($color) && is_array($color))
                                @foreach ($color as $colors)
                                <span class="active" data-color="{{$colors}}"></span>@if (!$loop->last) @endif
                                @endforeach
                            @else
                                <p>No Color available for this product.</p>
                            @endif
                        </div>
                    </div>

                    @if ($product->size==Null)

                    @else
                        <div class="pr_switch_wrap">
                            <span class="switch_lable">Size</span>
                            <div class="product_size_switch">
                                @if(!empty($size) && is_array($size))
                                    @foreach ($size as $sizes)
                                    <span>{{ $sizes }}</span>@if (!$loop->last) @endif
                                    @endforeach
                                @else
                                    <p>No Color available for this product.</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <hr />
                <form action="{{ route('add.to.cart.quickview') }}" method="POST" id="add_cart_form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="price" value="{{ $product->discount_price ?? $product->selling_price }}">
                    <input type="hidden" name="color" value="{{ $defaultColor ?? '' }}" id="product-color">
                    <input type="hidden" name="size" value="{{ $defaultSize ?? '' }}" id="product-size">

                    <!-- Quantity -->
                    <input type="text" name="qty" value="1" class="qty" size="4">

                    <button type="submit" class="btn btn-fill-out btn-addtocart add-to-cart-button">
                        <i class="icon-basket-loaded"></i> Add to cart
                    </button>
                </form>

                <hr />
                <ul class="product-meta">
                    <li>product_code: <a href="#">{{ $product->product_code }}</a></li>
                    <li>Category: <a href="#">{{ $product->category->category_name }}</a></li>
                    <li>Tags:
                        @if(!empty($tags) && is_array($tags))
                            @foreach ($tags as $tag)
                                <a href="#" rel="tag">{{ $tag }}</a>@if (!$loop->last), @endif
                            @endforeach
                        @else
                            <p>No Tags available for this product.</p>
                        @endif
                    </li>
                </ul>

                <div class="product_share">
                    <span>Share:</span>
                    <ul class="social_icons">
                        <li><a href="{{$setting->facebook}}"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="{{$setting->twitter}}"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="{{$setting->linkedin}}"><i class="ion-social-linkedin"></i></a></li>
                        <li><a href="{{$setting->youtube}}"><i class="ion-social-youtube-outline"></i></a></li>
                        <li><a href="{{$setting->instragram}}"><i class="ion-social-instagram-outline"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- scripts js -->
<script src="{{asset('/')}}frontend/assets/js/scripts.js"></script>
<script>
    $('#add_cart_form').submit(function(e) {
        e.preventDefault();

        let color = $('#product-color').val();
        let size = $('#product-size').val();

        if (!color || !size) {
            toastr.warning('Please select color and size.');
            return false;
        }

        var url = $(this).attr('action');
        var request = $(this).serialize();

        $('.loading').removeClass('d-none');

        $.ajax({
            url: url,
            type: 'POST',
            data: request,
            success: function(data) {
                toastr.options = {
                    "positionClass": "toast-top-right",
                    "zIndex": 99999
                };

                if (data.status === 'success') {
                    toastr.success(data.message);
                    $('#add_cart_form')[0].reset();

                    // ✅ Close modal and fix screen freeze
                    $('#quickviewModal').modal('hide');

                    setTimeout(function () {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('body').css('overflow', 'auto'); // ✅ unlock scrolling
                    }, 500);

                    updateCart();
                } else {
                    toastr.error(data.message || 'Something went wrong!');
                }

                $('.loading').addClass('d-none');
            },
            error: function() {
                toastr.error('Something went wrong!');
                $('.loading').addClass('d-none');
            }
        });
    });

    function updateCart() {
        $.ajax({
            url: '{{ route("cart.items") }}',
            type: 'GET',
            success: function(data) {
                $('#cart-count').text(data.cartCount);
                $('#cart-total').html('<span class="currency_symbol">{{ $setting->currency }}</span>' + data.subtotal);
                $('#cart-list').empty();

                $.each(data.cartItems, function(index, item) {
                    $('#cart-list').append(
                        `<li id="cart-item-${item.rowId}">
                            <a href="javascript:void(0);" class="item_remove remove-cart-item" data-id="${item.rowId}">
                                <i class="ion-close"></i>
                            </a>
                            <a href="#">
                                <img src="{{ asset('') }}${item.options.thumbnail}" alt="cart_thumb">
                                ${item.name.substring(0, 20)}...
                            </a>
                            <span class="cart_quantity">
                                ${item.qty} x
                                <span class="cart_amount">
                                    <span class="price_symbole">{{ $setting->currency }}</span>${item.price}
                                </span>
                            </span>
                        </li>`
                    );
                });
            },
            error: function() {
                toastr.error('Failed to update cart.');
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        // Color selection
        $('.product_color_switch span').click(function() {
            var selectedColor = $(this).data('color');
            $('#product-color').val(selectedColor);
            $('.product_color_switch span').removeClass('active');
            $(this).addClass('active');
        });

        // Size selection
        $('.product_size_switch span').click(function() {
            var selectedSize = $(this).text();
            $('#product-size').val(selectedSize);
            $('.product_size_switch span').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
