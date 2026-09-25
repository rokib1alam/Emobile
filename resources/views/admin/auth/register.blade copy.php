<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom-style.css" />
  <style>
    /* Style for language selector */
    .language-selector {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      align-items: center;
    }

    /* Style for flags */
    .language-selector select {
      margin-right: 10px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .flag-container {
      display: flex;
      gap: 10px;
    }

    .flag-container img {
      width: 24px;
      height: 16px;
      cursor: pointer;
    }

    .container {
      position: relative;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Language Selector with Flags -->
    <div class="language-selector">
      <select id="language-select">
        <option value="en">English</option>
        <option value="bn">বাংলা</option>
      </select>
    </div>

    <!-- Registration Form Section (Right Side) -->
    <div class="right-side">
      <form method="POST" action="{{ route('admin.register') }}" id="register-form" enctype="multipart/form-data">
        @csrf
        <h1 class="form-title">Register</h1>

        <!-- Name -->
        <div class="input-box">
          <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}" />
        </div>

        <!-- Email -->
        <div class="input-box">
          <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />
        </div>

        <div class="two-column">
          <!-- Password -->
          <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password" required />
          </div>

          <!-- Confirm Password -->
          <div class="input-box">
            <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm Password" required />
          </div>
        </div>

        <div class="two-column">
          <!-- Profile Picture -->
          <div class="input-box">
            <input type="file" name="profile_picture" accept="image/*" required />
          </div>

          <!-- Mobile Number -->
          <div class="input-box">
            <input type="tel" name="mobile_number" placeholder="Mobile Number" required />
          </div>
        </div>

        <div class="two-column">
          <!-- Gender -->
          <div class="input">
            <select name="gender" required>
              <option value="">{{ __('gender') }}</option>
              <option value="male">{{ __('male') }}</option>
              <option value="female">{{ __('female') }}</option>
              <option value="other">{{ __('other') }}</option>
            </select>
          </div>

          <!-- Religion -->
          <div class="input">
            <select name="religion" required>
              <option value="">{{ __('selectReligion') }}</option>
              <option value="islam">{{ __('islam') }}</option>
              <option value="hinduism">{{ __('hinduism') }}</option>
              <option value="christianity">{{ __('christianity') }}</option>
              <option value="buddhism">{{ __('buddhism') }}</option>
              <option value="other">{{ __('other') }}</option>
            </select>
          </div>
        </div>

        <div class="two-column">
          <!-- Blood Group -->
          <div class="input">
            <select name="blood_group" required>
              <option value="">{{ __('selectBloodGroup') }}</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>
          </div>

          <!-- Profession -->
          <div class="input">
            <select name="profession_type" required>
              <option value="">{{ __('selectProfession') }}</option>
              <option value="electrician">{{ __('electrician') }}</option>
              <option value="plumber">{{ __('plumber') }}</option>
              <option value="tiles_worker">{{ __('tilesWorker') }}</option>
              <option value="other">{{ __('other') }}</option>
            </select>
          </div>
        </div>

        <div class="two-column">
          <!-- Division -->
          <div class="input">
            <select id="division" name="division" required>
              <option value="">{{ __('selectDivision') }}</option>
            </select>
          </div>

          <!-- District -->
          <div class="input">
            <select id="district" name="district" required>
              <option value="">{{ __('selectDistrict') }}</option>
            </select>
          </div>
        </div>

        <!-- Upazila -->
        <div class="input">
          <select id="upazila" name="upazila" required>
            <option value="">{{ __('selectUpazila') }}</option>
          </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">{{ __('registerBtn') }}</button>

        <div class="register-link">
          <p>{{ __('alreadyAccount') }} <a href="{{ route('admin.login') }}">{{ __('loginHere') }}</a></p>
        </div>
      </form>
    </div>

    <!-- Left Side: Branding + Social Icons -->
    <div class="left-side">
      <h2 class="logo"><i class="bx bxl-xing"></i> {{ __('hashTag') }}</h2>
      <div class="text-left-side">
        <h2>{{ __('joinUs') }} <br /><span>{{ __('createAccount') }}</span></h2>
        <p>{{ __('loremText') }}</p>
      </div>
      <div class="social-icons">
        <a href="#"><i class="bx bxl-facebook"></i></a>
        <a href="#"><i class="bx bxl-gmail"></i></a>
        <a href="#"><i class="bx bxl-instagram"></i></a>
        <a href="#"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </div>

  <script src="{{ asset('/') }}frontend/assets/js/language.js"></script>
  <script src="{{ asset('/') }}frontend/assets/js/script.js"></script>
</body>
</html>
