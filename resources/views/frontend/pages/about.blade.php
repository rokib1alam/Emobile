@extends('layouts.app')

@section('content')

@include('frontend.layouts.others_header')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>About Us</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
                    <li class="breadcrumb-item active">About</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- STAT SECTION ABOUT --> 
<div class="section">
	<div class="container">
         @foreach ($abouts as $about)
    	<div class="row align-items-center">
        	<div class="col-lg-6">
            	<div class="about_img scene mb-4 mb-lg-0">
                    <img src="{{ asset($about->image) }}" alt="about_img"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="heading_s1">
                    <h2>Who We are</h2>
                </div>
                <p>{{ $about->paragraph_1 }}</p>
                <p>{{ $about->paragraph_2 }}</p>
            </div>
        </div>
    @endforeach
    </div>
</div>
<!-- END SECTION ABOUT --> 

@include('frontend.layouts.others_footer')
@endsection