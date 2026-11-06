<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Anil z" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ $seo->meta_author ?? '' }}">
    <meta name="keywords" content="{{ $seo->meta_keyword ?? '' }}">
    <meta name="description" content="@yield('meta_description', $seo->meta_description ?? '')">
    <meta name="tags" content="{{ $seo->meta_tag ?? '' }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SITE TITLE -->
    <title>{{ $seo->meta_title ?? config('app.name') }}</title>
    <!-- Google Site Verification -->
    @if(!empty($seo->google_verification))
        <meta name="google-site-verification" content="{{ $seo->google_verification }}" />
    @endif
    <!-- Alexa Site Verification -->
    @if(!empty($seo->alexa_verification))
        <meta name="alexaVerifyID" content="{{ $seo->alexa_verification }}" />
    @endif
    <!-- Google AdSense Code -->
    @if(!empty($seo->google_adsense))
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $seo->google_adsense }}" crossorigin="anonymous"></script>
    @endif
    <!-- Google Analytics (GA4) Code -->
    @if(!empty($seo->google_analytics))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics }}"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{{ $seo->google_analytics }}');
        </script>
    @endif
   <!-- CSS File Start -->
   @include('frontend.layouts.style')
   <!-- CSS File End -->
    <!-- WhatsApp Floating Button CSS Style -->
<!-- CSS Style -->
<style>
    .whatsapp-widget {
        position: fixed !important;
        bottom: 105px !important;
        left: 25px !important; /* Icon-ti left side- e rakhar jonno */
        z-index: 99999 !important;
    }

    .whatsapp-float-btn {
        background-color: #25d366 !important;
        color: #ffffff !important;
        height: 50px !important;
        border-radius: 50px !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        overflow: hidden !important;
        white-space: nowrap !important;
        transition: all 0.3s ease !important;
    }
    
    .whatsapp-float-btn i {
        font-size: 26px !important;
        min-width: 50px !important;
        height: 50px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        color: #ffffff !important;
    }
    
    .whatsapp-text {
        font-weight: 600 !important;
        font-size: 14px !important;
        padding-right: 20px !important;
        color: #ffffff !important;
        opacity: 0 !important;
        max-width: 0 !important;
        visibility: hidden !important;
        transition: all 0.3s ease !important;
    }

    /* Desktop View: Mouse hover korle text beriye ashbe */
    @media (min-width: 769px) {
        .whatsapp-float-btn:hover {
            background-color: #20ba5a !important;
        }
        .whatsapp-float-btn:hover .whatsapp-text {
            opacity: 1 !important;
            max-width: 150px !important;
            visibility: visible !important;
        }
    }

    /* Mobile View: Mobile-e hover-er dorkar nei, tai click ba touch korle ba normally icon-er pashe lekha show korar jonno ba shudhu gol icon rakhte chaile ekhane control korte paren */
    @media (max-width: 768px) {
        /* Jodi mobile-e shudhu gol icon rakhte chan, tahole nicher line gulo thakbe */
        .whatsapp-float-btn {
            width: 50px !important;
        }
        .whatsapp-text {
            display: none !important;
        }
    }
</style>

</head>
<body>
<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->
<!-- Home Popup Section -->
{{-- @include('frontend.layouts.popupwindow')  --}}
<!-- End Screen Load Popup Section -->
<!-- START MAIN CONTENT -->
@yield('content')
<!-- END MAIN CONTENT -->

<!-- WhatsApp Floating Button HTML with your number -->
<div class="whatsapp-widget">
    <a href="https://wa.me/8801922933193?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20products." target="_blank" class="whatsapp-float-btn" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-text">Chat on WhatsApp</span>
    </a>
</div>
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>
<!-- Start JS -->
@include('frontend.layouts.script')
<!-- Mobile Bottom Navigation Bar -->
<div class="mobile-bottom-nav">
    <a href="tel:01922933193" class="nav-item">
        <i class="fas fa-phone"></i>
        <span>Phone</span>
    </a>
    <a href="{{ url('/') }}" class="nav-item">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="https://m.me/61564934893680" target="_blank" class="nav-item messenger-link">
        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        <span>Messenger</span>
    </a>
    {{-- <a href="{{ route('cart.view') }}" class="nav-item cart-item">
        <div class="icon-wrapper">
            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="cart-badge">0</span>
        </div>
        <span>Cart</span>
    </a> --}}
</div>
<!-- END JS -->
</body>
</html>