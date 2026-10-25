
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Anil z" name="author">
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

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>
<!-- Start JS -->
@include('frontend.layouts.script')
<!-- END JS -->
</body>
</html>
