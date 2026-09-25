<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
          <h2>Forgot Password? <br /><span style="font-size: 30px;">No Worries!</span></h2>
          <p>We’ll send a reset link to your email.</p>
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

        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <h1>Forgot Password</h1>

          <!-- Email Input -->
          <div class="input-box">
            <input
              type="email"
              name="email"
              placeholder="Enter your email"
              required
              value="{{ old('email') }}"
            />
            @error('email')
              <span class="error-message" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn">Send Reset Link</button>

          <!-- Back to Login Link -->
          <div class="register-link">
            <p>Remember your password? <a href="{{ route('login') }}">Go back to Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
