
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <!-- Meta -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="Anil z" name="author">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="Shopwise is Powerful features and You Can Use The Perfect Build this Template For Any eCommerce Website. The template is built for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
   <meta name="keywords" content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- SITE TITLE -->
   <title>{{ config('app.name', 'Laravel') }}</title>
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
