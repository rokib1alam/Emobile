<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom-style.css" />
  </head>
  <body>
    <div class="container">
      <div class="left-side">
        <div style="display: flex; align-items: center; margin-top: 30px;">
            <i class="bx bxl-xing" style="font-size: 32px;"></i>
            <img src="{{ $setting->logo }}" alt="Logo" style="height: 50px; width: auto;" />
        </div>

        <div class="text-left-side">
          <h2>Reset Password <br /><span style="font-size: 30px;">For {{$seo->meta_title}}!</span></h2>
          <p>Please create a new password to regain access to your account.</p>
        </div>

        <div class="social-icons">
          <a href="#"><i class="bx bxl-facebook"></i></a>
          <a href="#"><i class="bx bxl-gmail"></i></a>
          <a href="#"><i class="bx bxl-instagram"></i></a>
          <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
      <div class="right-side">
        @if (session('status'))
          <div class="success-message" style="color: green; margin-bottom: 10px;">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          @method('PUT')
            
          <h1>Reset Password</h1>

          <!-- Token (Hidden Input) -->
          <input type="hidden" name="token" value="{{ $request->route('token') }}">

          <!-- Email Input -->
          <div class="input-box">
            <input
              type="email"
              name="email"
              placeholder="Enter your email"
              required
              value="{{ old('email', $request->email) }}"
            />
            @error('email')
              <span class="error-message" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>

          <!-- New Password Input -->
          <div class="input-box">
            <input
              type="password"
              name="password"
              placeholder="New Password"
              required
            />
            @error('password')
              <span class="error-message" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>

          <!-- Confirm Password Input -->
          <div class="input-box">
            <input
              type="password"
              name="password_confirmation"
              placeholder="Confirm Password"
              required
            />
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn">Reset Password</button>

          <!-- Back to Login Link -->
          <div class="register-link">
            <p>Remember your password? <a href="{{ route('login') }}">Go back to Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
