<footer class="footer_dark">
	<div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="#"><img src="{{asset($setting->logo)}}" alt="logo"/></a>
                        </div>
                        <p>If you are going to use of Lorem Ipsum need to be sure there isn't hidden of text</p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li><a href="{{ $setting->facebook }}"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="{{ $setting->twitter }}"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="{{ $setting->youtube }}"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="{{ $setting->instragram }}"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
        		</div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Useful Links</h6>
                        <ul class="widget_links">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Category</h6>
                        @foreach($categories as $category)
                        <ul class="widget_links">
                            <li><a href="{{ route('slug.handler', $category->category_slug) }}">{{ $category->category_name }}</a></li>
                        </ul>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Contact Info</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{ $setting->address }}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="{{ $setting->main_email }}">{{ $setting->main_email }}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>+{{ $setting->phone_one }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0 text-center text-md-start">© {{ date('Y') }} All Rights Reserved by Bestwebcreator</p>
                </div>
                <div class="col-md-6">
                    <ul class="footer_payment text-center text-lg-end">
                        <li><a href="#"><img src="{{asset('/')}}frontend/assets/images/visa.png" alt="visa"></a></li>
                        <li><a href="#"><img src="{{asset('/')}}frontend/assets/images/discover.png" alt="discover"></a></li>
                        <li><a href="#"><img src="{{asset('/')}}frontend/assets/images/master_card.png" alt="master_card"></a></li>
                        <li><a href="#"><img src="{{asset('/')}}frontend/assets/images/paypal.png" alt="paypal"></a></li>
                        <li><a href="#"><img src="{{asset('/')}}frontend/assets/images/amarican_express.png" alt="amarican_express"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>