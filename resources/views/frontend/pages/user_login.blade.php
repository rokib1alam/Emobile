@extends('layouts.app')
@section('title','Shopwise|Login')
@section('content')
<!-- START HEADER -->
@include('frontend.layouts.others_header')
<!-- END HEADER -->
<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Login</h3>
                        </div>
                        @guest
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('login.submit') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <input type="text" required="" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" id="password">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('#password')"><i class="fas fa-eye"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="login_footer form-group mb-3">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="exampleCheckbox1"><span>{{ __('Remember Me') }}</span></label>
                                        </div>
                                    </div>
                                    <a href="#">Forgot password?</a>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="login">Log in</button>
                                </div>
                            </form>
                        @endguest
                        
                        <div class="different_login">
                            <span> or</span>
                        </div>
                        <ul class="btn-login list_none text-center">
                            <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                            <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                        </ul>
                        <div class="form-note text-center">Don't Have an Account? <a href="signup.html">Sign up now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->
<!-- START FOOTER -->
@include('frontend.layouts.others_footer')
<!-- END FOOTER -->

{{-- Script to toggle password visibility --}}
<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.querySelector(fieldId);
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    }
</script>
@endsection
