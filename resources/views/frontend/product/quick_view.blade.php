@php
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
    } else {
        $selectedThumbnail = $product->thumbnail;
        $selectedImages = is_array($product->images) ? $product->images : json_decode($product->images, true) ?? [];
    }
@endphp

<div class="modal-content" style="padding: 20px;">
    <div class="row">
        <!-- =========================================
             PRODUCT IMAGE SECTION
        ========================================== -->
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
            <div class="product-image">
                <div class="product_img_box" style="text-align: center; overflow: hidden;">
                    <img 
                        id="product_img" 
                        src="{{ asset($selectedThumbnail ?? 'frontend/assets/images/no-image.png') }}" 
                        data-zoom-image="{{ asset($selectedThumbnail ?? 'frontend/assets/images/no-image.png') }}" 
                        alt="product_img" 
                        style="max-width: 100%; height: 320px; object-fit: contain; display: inline-block;" 
                    />
                    <a href="#" class="product_img_zoom" title="Zoom">
                        <span class="linearicons-zoom-in"></span>
                    </a>
                </div>

                <!-- PRODUCT GALLERY SLIDER -->
                <div id="pr_item_gallery" class="product_gallery_item mt-3" style="display: flex; gap: 10px; overflow-x: auto;">
                    @if(!empty($selectedImages))
                        @foreach ($selectedImages as $key => $image)
                            <div class="item" style="flex: 0 0 70px;">
                                <a href="#" class="product_gallery_item {{ $key == 0 ? 'active' : '' }}" data-image="{{ asset($image) }}" data-zoom-image="{{ asset($image) }}">
                                    <img src="{{ asset($image) }}" alt="product_small_img{{ $key + 1 }}" style="width: 70px; height: 70px; object-fit: contain; border: 1px solid #ddd; padding: 2px;" />
                                </a>
                            </div>
                        @endforeach
                    @elseif($selectedThumbnail)
                        <div class="item" style="flex: 0 0 70px;">
                            <a href="#" class="product_gallery_item active" data-image="{{ asset($selectedThumbnail) }}" data-zoom-image="{{ asset($selectedThumbnail) }}">
                                <img src="{{ asset($selectedThumbnail) }}" alt="product_thumb" style="width: 70px; height: 70px; object-fit: contain; border: 1px solid #ddd; padding: 2px;" />
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
                <div class="embed-responsive embed-responsive-16by9 mt-2">
                    <iframe
                        width="100%"
                        height="220"
                        src="https://www.youtube.com/embed/{{ $product->video }}"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
            @endif
        </div>

        <!-- =========================================
             PRODUCT DETAILS SECTION
        ========================================== -->
        <div class="col-lg-6 col-md-6">
            <div class="pr_detail">
                <div class="product_description">
                    <h4 class="product_title">
                        <a href="#">{{ $product->product_name }}</a>
                    </h4>

                    <h6>Brand: {{ optional($product->brand)->brand_name }}</h6>

                    <h6>Stock: 
                        @if($product->stock_quantity < 1) 
                            <span class="bg-danger text-white px-2 py-1">Stock Out</span> 
                        @else 
                            <span class="bg-success text-white px-2 py-1">Stock Available</span> 
                        @endif
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
                                $discount = ($product->selling_price - $product->discount_price) / $product->selling_price * 100;
                            @endphp
                            <div class="on_sale">
                                <span>{{ round($discount) }}% Off</span>
                            </div>
                        @endif
                    </div>
                    <br>

                    <!-- SHORT DESCRIPTION -->
                    <div class="pr_desc" style="text-align: justify">
                        <p>{{ $product->short_description ?? Str::limit(strip_tags($product->description), 100) }}</p>
                    </div>

                    <!-- PRODUCT SORT INFO -->
                    <div class="product_sort_info">
                        <ul>
                            <li><i class="linearicons-map-marker"></i><strong>Pickup Point: </strong>{{ optional($product->pickuppoint)->pickup_point_name ?? 'N/A' }}</li>
                            <li><i class="linearicons-shield-check"></i> 1 Year Warranty</li>
                            <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                            <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                        </ul>
                    </div>

                    <!-- =====================================
                        PRODUCT COLORS
                    ====================================== -->
                    <div class="pr_switch_wrap">
                        <span class="switch_lable">Color</span>
                        <div class="product_color_switch">
                            @if($product->colors && $product->colors->count() > 0)
                                @foreach ($product->colors as $key => $colorItem)
                                    @php
                                        $cImages = is_array($colorItem->images) ? $colorItem->images : json_decode($colorItem->images, true);
                                    @endphp
                                    <span class="color_option {{ $key == 0 ? 'active' : '' }}" 
                                        data-color="{{ $colorItem->color }}" 
                                        data-thumbnail="{{ asset($colorItem->thumbnail) }}"
                                        data-images='{!! json_encode($cImages ?? []) !!}'
                                        style="background-color: {{ $colorItem->color }}; cursor: pointer;"
                                        title="{{ $colorItem->color }}">
                                    </span>
                                @endforeach
                            @else
                                <p>No Color available for this product.</p>
                            @endif
                        </div>
                    </div>

                    <!-- =====================================
                        SIZE
                    ====================================== -->
                    @if (!empty($size) && is_array($size))
                        <div class="pr_switch_wrap">
                            <span class="switch_lable">Size</span>
                            <div class="product_size_switch">
                                @foreach ($size as $key => $sizes)
                                    <span class="{{ $key == 0 ? 'active' : '' }}" data-size="{{ $sizes }}" style="cursor: pointer;">
                                        {{ $sizes }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <hr />

                <!-- =====================================
                    BUY NOW SECTION (আপনার চাওয়া স্টাইল অনুযায়ী)
                ====================================== -->
                <div class="cart_extra d-flex align-items-center flex-wrap gap-2">
                    <!-- Quantity Box -->
                    <div class="cart-product-quantity">
                        <div class="quantity">
                            <input type="button" value="-" class="minus">
                            <input type="text" name="qty" value="1" title="Qty" class="qty" id="product-qty" size="4">
                            <input type="button" value="+" class="plus">
                        </div>
                    </div>

                    <!-- Buy Now Button -->
                    <div class="cart_btn">
                        @if($product->stock_quantity < 1)
                            <button class="btn btn-fill-outline-danger" disabled>
                                <i class="icon-bag"></i> Stock Out
                            </button>
                        @else
                            <a href="{{ route('checkout', ['product_id' => $product->id]) }}" id="buy_now_btn" class="btn btn-fill-out buy-now-btn" title="Buy Now">
                                <i class="icon-bag"></i> Buy Now
                            </a>
                        @endif
                    </div>
                </div>

                <hr />

                <!-- PRODUCT META -->
                <ul class="product-meta">
                    <li>Product Code: <a href="#">{{ $product->product_code }}</a></li>
                    <li>Category: <a href="#">{{ optional($product->category)->category_name }}</a></li>
                    <li>Tags:
                        @if(!empty($tags) && is_array($tags))
                            @foreach ($tags as $tag)
                                <a href="#" rel="tag">{{ $tag }}</a>@if (!$loop->last), @endif
                            @endforeach
                        @else
                            <span>No Tags available.</span>
                        @endif
                    </li>
                </ul>

                <!-- SHARE ICONS -->
                <div class="product_share">
                    <span>Share:</span>
                    <ul class="social_icons">
                        <li><a href="{{ $setting->facebook ?? '#' }}"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="{{ $setting->twitter ?? '#' }}"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="{{ $setting->linkedin ?? '#' }}"><i class="ion-social-linkedin"></i></a></li>
                        <li><a href="{{ $setting->youtube ?? '#' }}"><i class="ion-social-youtube-outline"></i></a></li>
                        <li><a href="{{ $setting->instragram ?? '#' }}"><i class="ion-social-instagram-outline"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden inputs for JS values -->
<input type="hidden" id="selected-color" value="{{ optional($product->colors->first())->color ?? '' }}">
<input type="hidden" id="selected-size" value="{{ $size[0] ?? '' }}">

<!-- =========================================
    SCRIPTS & JAVASCRIPT LOGIC
========================================== -->
<script>
    $(document).ready(function() {
        // Color Selection
        $('.color_option').on('click', function() {
            var selectedColor = $(this).data('color');
            var thumbnail = $(this).data('thumbnail');
            var rawImages = $(this).attr('data-images');

            $('#selected-color').val(selectedColor);

            $('.color_option').removeClass('active');
            $(this).addClass('active');

            if (thumbnail) {
                $('#product_img').attr('src', thumbnail);
                $('#product_img').attr('data-zoom-image', thumbnail);
            }
        });

        // Size Selection
        $('.product_size_switch span').on('click', function() {
            var selectedSize = $(this).data('size') || $(this).text().trim();
            $('#selected-size').val(selectedSize);
            $('.product_size_switch span').removeClass('active');
            $(this).addClass('active');
        });

        // Buy Now Button Click Action (Appending color, size, qty to URL)
        $('#buy_now_btn').on('click', function(e) {
            e.preventDefault();

            let color = $('#selected-color').val();
            let size = $('#selected-size').val();
            let qty = $('#product-qty').val();
            let baseCheckoutUrl = $(this).attr('href');

            if ($('.color_option').length > 0 && !color) {
                if (typeof toastr !== 'undefined') {
                    toastr.warning('Please select a color.');
                } else {
                    alert('Please select a color.');
                }
                return false;
            }

            // Construct final URL with query parameters
            let finalUrl = `${baseCheckoutUrl}?color=${encodeURIComponent(color || '')}&size=${encodeURIComponent(size || '')}&qty=${qty}`;
            
            window.location.href = finalUrl;
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>