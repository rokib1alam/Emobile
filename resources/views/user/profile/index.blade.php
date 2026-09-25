@extends('layouts.user')
@section('title', 'profile')
@section('user_content')
{{-- <div class="col-lg-7 col-md-7 col-xs-7 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3">
    <div class="widget-boxed-header">
        <h4>Profile Details</h4>
    </div>
    <div class="sidebar-widget author-widget2">
        <div class="author-box clearfix">
            <img src="{{ asset('/') }}frontend/assets/images/testimonials/ts-1.jpg" alt="author-image" class="author__img">
            <h4 class="author__title">Lisa Clark</h4>
            <p class="author__meta">Agent of Property</p>
        </div>

         <form action="{{ route('profile.update.image') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="user_image">Upload Profile Image:</label>
                <input type="file" name="user_image" id="user_image">
            </div>
            <button type="submit">Update Profile Image</button>
        </form>

        <div class="author-box clearfix">
            <div class="image-wrapper">
                <img src="{{ asset('/') }}frontend/assets/images/testimonials/ts-1.jpg" alt="author-image" class="author__img">
                <a href="#" class="edit-icon">
                    <i class="fa fa-pencil"></i>
                </a>
            </div>

            <style>
                 .image-wrapper {
                 position: relative;
                 display: inline-block;
                }

                .image-wrapper img {
                        display: block;
                    width: 100%;
                }


                .edit-icon {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    background-color: rgba(0, 0, 0, 0.6);
                    color: #fff;
                    padding: 5px 8px;
                    border-radius: 50%;
                    font-size: 16px;
                    text-decoration: none;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                .edit-icon:hover {
                 background-color: #007bff;
            }

            </style>

            <h4 class="author__title">{{ Auth::user()->name }}</h4>
            <p class="author__meta">Agent of Property</p>
        </div>

        <ul class="author__contact">
            <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>302 Av Park, New York</li>
            <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span><a href="#">(234) 0200 17813</a></li>
            <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">lisa@gmail.com</a></li>
        </ul>
         <div class="agent-contact-form-sidebar">
            <h4>Request Inquiry</h4>
            <form name="contact_form" method="post" action="https://code-theme.com/html/findhouses/functions.php">
                <input type="text" id="fname" name="full_name" placeholder="Full Name" required="">
                <input type="number" id="pnumber" name="phone_number" placeholder="Phone Number" required="">
                <input type="email" id="emailid" name="email_address" placeholder="Email Address" required="">
                <textarea placeholder="Message" name="message" required=""></textarea>
                <input type="submit" name="sendmessage" class="multiple-send-message" value="Submit Request">
            </form>
        </div>
    </div>
</div> --}}
<div class="col-lg-7 col-md-7 col-xs-7 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3">
    <div class="widget-boxed-header">
        <h4>Profile Details</h4>
    </div>
    <div class="sidebar-widget author-widget2">
        <div class="author-box clearfix">
            <div class="image-wrapper">
                <img src="{{ asset($user->user_image) }}"
                alt="{{ $user->name ?? 'User Image' }}"
                class="author__img">


                <a href="{{ route('profile.edit', $user->id) }}" class="edit-icon">
                    <i class="fa fa-pencil"></i>
                </a>
            </div>
            {{-- $user->user_image ? asset('storage/' . $user->user_image) : --}}
            <h4 class="author__title">{{ $user->name }}</h4>
            <p class="author__meta">{{ $user->role ?? 'Holder of Property' }}</p>
        </div>

        <ul class="author__contact">
            <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>{{ $user->address }}</li>
            <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span><a href="tel:{{ $user->phonenumber }}">{{ $user->phonenumber }}</a></li>
            <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
        </ul>
    </div>
</div>
      <!-- START PRELOADER -->
      <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>
    <!-- END PRELOADER -->
@endsection
