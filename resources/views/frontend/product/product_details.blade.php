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
          <h1>Product Detail</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">{{ $product->category->category_name }}</a></li>
          <li class="breadcrumb-item"><a href="#">{{ $product->subcategory->subcategory_name }}</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">
  <div class="section">
    <div class="container"> 
      @php 
          $selectedColor = $product->colors->first(); 
          $selectedThumbnail = null; 
          $selectedImages = []; 

          if ($selectedColor) { 
              $selectedThumbnail = $selectedColor->thumbnail; 
              $selectedImages = is_array($selectedColor->images) ? $selectedColor->images : json_decode($selectedColor->images, true); 
              if (!is_array($selectedImages)) { 
                  $selectedImages = []; 
              } 
          } else {
              $selectedThumbnail = $product->thumbnail;
              $selectedImages = is_array($product->images) ? $product->images : json_decode($product->images, true) ?? [];
          }
      @endphp 

      <div class="row">
        <!-- PRODUCT IMAGE SECTION -->
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <div class="product-image">
            <div class="product_img_box"> 
              @if($selectedThumbnail) 
                <img id="product_img" src="{{ asset($selectedThumbnail) }}" data-zoom-image="{{ asset($selectedThumbnail) }}" alt="{{ $product->product_name }}" /> 
              @else 
                <img id="product_img" src="{{ asset('frontend/assets/images/no-image.png') }}" data-zoom-image="{{ asset('frontend/assets/images/no-image.png') }}" alt="{{ $product->product_name }}" /> 
              @endif 
              <a href="#" class="product_img_zoom" title="Zoom">
                <span class="linearicons-zoom-in"></span>
              </a>
            </div>

            <!-- PRODUCT GALLERY -->
            <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false"> 
              @if(!empty($selectedImages)) 
                @foreach ($selectedImages as $key => $image) 
                  <div class="item">
                    <a href="#" class="product_gallery_item {{ $key == 0 ? 'active' : '' }}" data-image="{{ asset($image) }}" data-zoom-image="{{ asset($image) }}">
                      <img src="{{ asset($image) }}" alt="product_small_img{{ $key + 1 }}" />
                    </a>
                  </div> 
                @endforeach 
              @elseif($selectedThumbnail) 
                <div class="item">
                  <a href="#" class="product_gallery_item active" data-image="{{ asset($selectedThumbnail) }}" data-zoom-image="{{ asset($selectedThumbnail) }}">
                    <img src="{{ asset($selectedThumbnail) }}" alt="{{ $product->product_name }}" />
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
              <iframe width="500" height="280" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div> 
          @endif
        </div>

        <!-- PRODUCT DETAILS SECTION -->
        <div class="col-lg-6 col-md-6">
          <div class="pr_detail">
            <div class="product_description">
              <h4 class="product_title">
                <a href="#">{{ $product->product_name }}</a>
              </h4>
              <h6 class="product_title">
                <a href="#">Brand: {{ optional($product->brand)->brand_name }}</a>
              </h6>
              <h6 class="product_title">
                <a href="#">Stock: {{ $product->stock_quantity }}</a>
              </h6>

              <!-- PRICE -->
              <div class="product_price"> 
                @if ($product->discount_price == Null) 
                  <span class="price">{{ $setting->currency }}{{ $product->selling_price }}</span>
                  <del></del> 
                @else 
                  <span class="price">{{ $setting->currency }}{{ $product->discount_price }}</span>
                  <del>{{ $setting->currency }}{{ $product->selling_price }}</del> 
                  @php $discount = ($product->selling_price - $product->discount_price) / $product->selling_price * 100; @endphp 
                  <div class="on_sale">
                    <span>{{ round($discount) }}% Off</span>
                  </div> 
                @endif
              </div>
              <br>

              <!-- SHORT DESCRIPTION -->
              <div class="pr_desc" style="text-align: justify">
                <p>{{ $product->short_description }}</p>
              </div>

              <!-- PRODUCT INFO -->
              <div class="product_sort_info">
                <ul>
                  <li><i class="linearicons-map-marker"></i><strong>Pickup Point:</strong> {{ optional($product->pickuppoint)->pickup_point_name ?? 'N/A' }}</li>
                  <li><i class="linearicons-shield-check"></i> 1 Year Warranty</li>
                  <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                  <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                </ul>
              </div>

              <!-- PRODUCT COLORS -->
              <div class="pr_switch_wrap">
                <span class="switch_lable">Color</span>
                <div class="product_color_switch"> 
                  @if($product->colors->count() > 0) 
                    @foreach ($product->colors as $productColor) 
                      <span class="color_option {{ $loop->first ? 'active' : '' }}" 
                            data-color-id="{{ $productColor->id }}" 
                            data-color="{{ $productColor->color }}" 
                            data-thumbnail="{{ $productColor->thumbnail }}" 
                            data-images='@json($productColor->images)' 
                            title="{{ $productColor->color }}" 
                            style="background-color: {{ $productColor->color }}; cursor: pointer;">
                      </span> 
                    @endforeach 
                  @else 
                    <p>No Color available for this product.</p> 
                  @endif 
                </div>
              </div>

              <!-- SIZE -->
              @if (!empty($size) && is_array($size)) 
                <div class="pr_switch_wrap">
                  <span class="switch_lable">Size</span>
                  <div class="product_size_switch"> 
                    @foreach ($size as $key => $sizes) 
                      <span class="{{ $key == 0 ? 'active' : '' }}" data-size="{{ $sizes }}" style="cursor: pointer; padding: 5px 10px; border: 1px solid #ddd; margin-right: 5px; display: inline-block;">
                        {{ $sizes }}
                      </span> 
                    @endforeach 
                  </div>
                </div> 
              @endif
            </div>

            <hr />

            <!-- BUY NOW SECTION -->
            <form action="{{ route('checkout') }}" method="GET" id="buy_now_form">
              <div class="cart_extra">
                <div class="cart-product-quantity">
                  <div class="quantity">
                    <input type="button" value="-" class="minus">
                    <input type="text" name="qty" value="1" title="Qty" class="qty" id="product-qty" size="4">
                    <input type="button" value="+" class="plus">
                  </div>
                </div>

                <!-- Hidden Fields for Color, Size & Product ID -->
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="color" value="{{ optional($product->colors->first())->color ?? '' }}" id="product-color">
                <input type="hidden" name="size" value="{{ is_array($size) && count($size) > 0 ? $size[0] : '' }}" id="product-size">

                <div class="cart_btn"> 
                  @if($product->stock_quantity < 1) 
                    <button class="btn btn-fill-outline-danger" disabled>
                      <i class="icon-bag"></i> Stock Out
                    </button> 
                  @else 
                    <button class="btn btn-fill-out buy-now-btn" type="submit" id="buy_now_btn">
                      <i class="icon-bag"></i> Buy Now
                    </button> 
                  @endif 
                </div>
              </div>
            </form>

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

            <!-- SHARE -->
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

      <!-- TABS SECTION -->
      <div class="row">
        <div class="col-12">
          <div class="large_divider clearfix"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="tab-style3">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
              </li>
            </ul>
            <div class="tab-content shop_info_tab">
              <style>
                #Description p { text-align: justify; }
              </style>
              <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                <p>{!! $product->description !!}</p>
              </div>
              <div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                <table class="table table-bordered">
                  <tr>
                    <td>Stock:</td>
                    <td>{{ $product->stock_quantity }}</td>
                  </tr>
                  <tr>
                    <td>Unit:</td>
                    <td>{{ $product->unit }}</td>
                  </tr>
                  <tr>
                    <td>Color:</td>
                    <td>
                      @if($product->colors->count() > 0) 
                        @foreach($product->colors as $productColor) 
                          {{ $productColor->color }}@if(!$loop->last), @endif 
                        @endforeach 
                      @else 
                        N/A 
                      @endif
                    </td>
                  </tr> 
                  @if (!empty($product->size)) 
                    <tr>
                      <td>Size:</td>
                      <td>{{ $product->size }}</td>
                    </tr> 
                  @endif
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- END SECTION SHOP -->

<!-- START SECTION SUBSCRIBE NEWSLETTER --> 
@include('frontend.layouts.subscribe')
<!-- END SECTION SUBSCRIBE NEWSLETTER -->

<!-- START FOOTER --> 
@include('frontend.layouts.footer')
<!-- END FOOTER -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- =====================================
    COLOR, SIZE & GALLERY SCRIPT
====================================== -->
<script>
  $(document).ready(function() {
      // Color Selection & Dynamic Image Switch
      $('.color_option').on('click', function(e) {
          e.preventDefault();
          let colorId = $(this).data('color-id');
          let colorName = $(this).data('color');
          let thumbnail = $(this).data('thumbnail');
          let images = $(this).attr('data-images');

          $('.color_option').removeClass('active');
          $(this).addClass('active');

          $('#product-color-id').val(colorId);
          $('#product-color').val(colorName);

          if (thumbnail) {
              $('#product_img').attr('src', '{{ asset("") }}' + thumbnail).attr('data-zoom-image', '{{ asset("") }}' + thumbnail);
          }

          let gallery = $('#pr_item_gallery');
          if (gallery.hasClass('slick-initialized')) {
              gallery.slick('unslick');
          }
          gallery.empty();

          let imageArray = [];
          try {
              imageArray = JSON.parse(images);
          } catch (error) {
              imageArray = [];
          }

          if (!Array.isArray(imageArray) || imageArray.length === 0) {
              if (thumbnail) {
                  gallery.append(`
                      <div class="item">
                          <a href="#" class="product_gallery_item active" data-image="{{ asset('') }}${thumbnail}" data-zoom-image="{{ asset('') }}${thumbnail}">
                              <img src="{{ asset('') }}${thumbnail}" alt="{{ $product->product_name }}" />
                          </a>
                      </div>
                  `);
              }
          } else {
              imageArray.forEach(function(image, index) {
                  gallery.append(`
                      <div class="item">
                          <a href="#" class="product_gallery_item ${index === 0 ? 'active' : ''}" data-image="{{ asset('') }}${image}" data-zoom-image="{{ asset('') }}${image}">
                              <img src="{{ asset('') }}${image}" alt="product_small_img${index + 1}" />
                          </a>
                      </div>
                  `);
              });
          }

          gallery.slick({
              slidesToShow: 4,
              slidesToScroll: 1,
              infinite: false,
              responsive: [
                  { breakpoint: 768, settings: { slidesToShow: 3 } },
                  { breakpoint: 480, settings: { slidesToShow: 2 } }
              ]
          });
      });

      // Size Selection Handler
      $('.product_size_switch span').on('click', function() {
          let selectedSize = $(this).data('size') || $(this).text().trim();
          $('#product-size').val(selectedSize);
          $('.product_size_switch span').removeClass('active');
          $(this).addClass('active');
      });

      // Gallery Image Click
      $(document).on('click', '.product_gallery_item', function(e) {
          e.preventDefault();
          let image = $(this).data('image');
          let zoomImage = $(this).data('zoom-image');
          $('.product_gallery_item').removeClass('active');
          $(this).addClass('active');
          $('#product_img').attr('src', image).attr('data-zoom-image', zoomImage);
      });

      // Form Submit Validation for Color
      $('#buy_now_form').on('submit', function(e) {
          let color = $('#product-color').val();
          if ($('.color_option').length > 0 && !color) {
              e.preventDefault();
              alert('Please select a color.');
              return false;
          }
      });
  });
</script>

@endsection