<div class="banner_section full_screen staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow carousel_style2" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }} position-relative" style="height: 100vh; overflow: hidden;">

                    @if(!empty($slider->video_url))
                        <video autoplay muted loop playsinline
                            class="w-100 h-100 position-absolute top-0 start-0 object-fit-cover z-0">
                            <source src="{{ asset($slider->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @if(!empty($slider->overlay))
                            <div class="position-absolute top-0 start-0 w-100 h-100 z-1" style="background: rgba(0,0,0,{{ $slider->overlay / 100 }});"></div>
                        @endif
                    @else
                        <div class="background_bg overlay_bg_{{ $slider->overlay ?? '50' }} position-absolute top-0 start-0 w-100 h-100 z-0"
                             style="background-image: url('{{ asset($slider->image_url) }}'); background-size: cover; background-position: center;">
                        </div>
                    @endif

                    <!-- Slide Content -->
                    <div class="banner_slide_content banner_content_inner position-relative z-2 h-100 d-flex align-items-center justify-content-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 col-md-10">
                                    <div class="banner_content text_white text-center">

                                        @if (!empty($slider->heading_text))
                                            <h2 class="staggered-animation"
                                                data-animation="fadeInDown"
                                                data-animation-delay="0.3s">
                                                {{ $slider->heading_text }}
                                            </h2>
                                        @endif

                                        @if (!empty($slider->caption_text))
                                            <p class="staggered-animation"
                                               data-animation="fadeInUp"
                                               data-animation-delay="0.4s">
                                                {{ $slider->caption_text }}
                                            </p>
                                        @endif

                                        <a class="btn btn-white staggered-animation" href="shop-left-sidebar.html" data-animation="fadeInUp" data-animation-delay="0.4s">Shop Now</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <i class="ion-chevron-left"></i>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <i class="ion-chevron-right"></i>
        </a>
    </div>
</div>
