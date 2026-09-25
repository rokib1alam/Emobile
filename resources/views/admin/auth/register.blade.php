<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom-style.css" />
</head>
<body>
  <div class="container">
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
            <input type="file" name="image" accept="image/*" required />
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
              <option value="">Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          <!-- Religion -->
          <div class="input">
            <select name="religion" required>
              <option value="">Select Religion</option>
              <option value="islam">Islam</option>
              <option value="hinduism">Hinduism</option>
              <option value="christianity">Christianity</option>
              <option value="buddhism">Buddhism</option>
              <option value="other">Other</option>
            </select>
          </div>
        </div>

        <div class="two-column">
          <!-- Blood Group -->
          <div class="input">
            <select name="blood_group" required>
              <option value="">Select Blood Group</option>
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
              <option value="">Select Profession Type</option>
              <option value="electrician">Electrician</option>
              <option value="plumber">Plumber</option>
              <option value="tiles_worker">Tiles Worker</option>
              <option value="other">Other</option>
            </select>
          </div>
        </div>

        <div class="two-column">
          <!-- Division -->
          <div class="input">
            <select id="division" name="division" required>
              <option value="">Select Division</option>
            </select>
          </div>

          <!-- District -->
          <div class="input">
            <select id="district" name="district" required>
              <option value="">Select District</option>
            </select>
          </div>
        </div>

        <!-- Upazila -->
        <div class="input">
          <select id="upazila" name="upazila" required>
            <option value="">Select Upazila</option>
          </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Register</button>

        <div class="register-link">
          <p>Already have an account? <a href="{{ route('admin.login') }}">Login here!</a></p>
        </div>
      </form>
    </div>

    <!-- Left Side: Branding + Social Icons -->
    <div class="left-side">
        <h2 class="logo" style="font-family: 'Poppins', sans-serif;">
            <i class="bx bxl-xing"></i> Mistri Ltd.
        </h2>
      <div class="text-left-side">
        <h2>Join Us! <br /><span>Create Your Account</span></h2>
        <p>{{$seo->	meta_description}}</p>
      </div>
      <div class="social-icons">
        <a href="#"><i class="bx bxl-facebook"></i></a>
        <a href="#"><i class="bx bxl-gmail"></i></a>
        <a href="#"><i class="bx bxl-instagram"></i></a>
        <a href="#"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </div>
  <script>
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirm-password");
    const passwordError = document.getElementById("password-error");
    const confirmPasswordError = document.getElementById("confirm-password-error");
    const passwordErrorContainer = document.getElementById("password-error-container");
    const confirmPasswordErrorContainer = document.getElementById("confirm-password-error-container");
    const confirmPasswordContainer = document.getElementById("confirm-password-container");
    const form = document.getElementById("register-form");

    // Password validation function
    function validatePassword() {
      const password = passwordField.value;
      const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;

      if (!regex.test(password)) {
        passwordError.textContent =
          "Password must be at least 8 characters long, include a capital letter, a number, and a special character.";
        passwordErrorContainer.style.display = "block";
        passwordField.parentElement.classList.add("invalid");
        confirmPasswordContainer.classList.add("gap-added"); // Add gap
        return false;
      } else {
        passwordErrorContainer.style.display = "none";
        passwordField.parentElement.classList.remove("invalid");
        confirmPasswordContainer.classList.remove("gap-added"); // Remove gap
        return true;
      }
    }

    // Confirm password validation function
    function validateConfirmPassword() {
      const password = passwordField.value;
      const confirmPassword = confirmPasswordField.value;

      if (password !== confirmPassword) {
        confirmPasswordError.textContent = "Passwords do not match.";
        confirmPasswordErrorContainer.style.display = "block";
        confirmPasswordField.parentElement.classList.add("invalid");
        return false;
      } else {
        confirmPasswordErrorContainer.style.display = "none";
        confirmPasswordField.parentElement.classList.remove("invalid");
        return true;
      }
    }

    // Attach event listeners
    passwordField.addEventListener("input", validatePassword);
    confirmPasswordField.addEventListener("input", validateConfirmPassword);

    // Final validation before form submission
    form.addEventListener("submit", (e) => {
      if (!validatePassword() || !validateConfirmPassword()) {
        e.preventDefault();
      }
    });
  </script>
  <script src="{{ asset('/') }}frontend/assets/js/script.js"></script>
</body>
</html>
