<footer class="footer_dark">
	<div class="footer_top small_pt pb_20">
        <div class="custom-container">
            <div class="row">
                @foreach($settings as $setting)
                <div class="col-lg-4 col-md-12 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="/">
                        <img src="{{asset($setting->logo)}}" alt="logo" style="max-height: 70px; width: auto;"/>
                    </a>
                        </div>

            
                        <p class="mb-3">If you are going to use of Lorem Ipsum need to be sure there isn't anything hidden of text</p>
                        <ul class="contact_info">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{ $setting->address }}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="#">{{ $setting->main_email }}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>{{ $setting->phone_one }}</p>
                            </li>
                        </ul>
                    </div>
        		</div>
                @endforeach
                <div class="col-lg-2 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Useful Links</h6>
                        <ul class="widget_links">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                	<div class="widget">
                        <h6 class="widget_title">Facebook Image</h6>
                        <ul class="widget_instafeed instafeed_col4">
                             @foreach ($featured as $featur)
                            <li><a href="{{ route('product.details', $featur->product_slug) }}"><img src="{{asset($featur->thumbnail)}}" alt="insta_img"></a></li>
                           @endforeach
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-12">
                	<div class="widget">
                        <h6 class="widget_title">Product Image</h6>
                        <ul class="widget_instafeed instafeed_col4">
                             @foreach ($featured as $featur)
                            <li><a href="{{ route('product.details', $featur->product_slug) }}"><img src="{{asset($featur->thumbnail)}}" alt="insta_img"></a></li>
                           @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_footer">
    	<div class="custom-container">
        	<div class="row">
            	<div class="col-12">
                	<div class="shopping_info">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-shipped"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>Free Delivery</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-money-back"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>30 Day Returns Guarantee</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>27/4 Online Support</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4">
                    <p class="mb-lg-0 text-center">© {{ date('Y') }} All Rights Reserved by Bestwebcreator</p>
                </div>
                <div class="col-lg-4 order-lg-first">
                    <div class="widget mb-lg-0">
                        <ul class="social_icons text-center text-lg-start">
                            <li><a href="#" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#" class="sc_google"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#" class="sc_youtube"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
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