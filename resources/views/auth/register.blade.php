<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom-style.css" />
    <style>
      .error-message {
        color: red;
        font-size: 0.9em;
        margin: 0;
      }
      .error-container {
        display: none;
        margin-top: 5px; /* Adjust the spacing for error messages */
      }
      .input-box.invalid input {
        border-color: red;
      }
      /* Adjust spacing for confirm password field when there's an error */
      .gap-added {
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="left-side">
          
        <div style="display: flex; align-items: center; margin-top: 30px;">
            <i class="bx bxl-xing" style="font-size: 32px;"></i>
            <img src="{{ $setting->logo }}" alt="Logo" style="height: 50px; width: auto;" />
        </div>

        <div class="text-left-side" style="margin-top: 20px;">
            <h2>Join Us! {{$seo->meta_title}} <br /><span>Create Your Account</span></h2>
            <p>{{$seo->	meta_description}}</p>
        </div>
  
        <div class="social-icons">
          <a href="#"><i class="bx bxl-facebook"></i></a>
          <a href="#"><i class="bx bxl-gmail"></i></a>
          <a href="#"><i class="bx bxl-instagram"></i></a>
          <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
      <div class="right-side">
        <form method="POST" action="{{ route('register') }}" id="register-form">
          @csrf
          <h1>Register</h1>

          <!-- Full Name -->
          <div class="input-box">
            <input
              type="text"
              name="name"
              placeholder="Full Name"
              required
              value="{{ old('name') }}"
            />
          </div>

          <!-- Email -->
          <div class="input-box">
            <input
              type="email"
              name="email"
              placeholder="Email"
              required
              value="{{ old('email') }}"
            />
          </div>

          <!-- Password -->
          <div class="input-box">
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Password"
              required
            />
            <div id="password-error-container" class="error-container">
              <p class="error-message" id="password-error"></p>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="input-box" id="confirm-password-container">
            <input
              type="password"
              id="confirm-password"
              name="password_confirmation"
              placeholder="Confirm Password"
              required
            />
            <div id="confirm-password-error-container" class="error-container">
              <p class="error-message" id="confirm-password-error"></p>
            </div>
          </div>

          <button type="submit" class="btn">Register</button>

          <div class="register-link">
            <p>Already have an account? <a href="{{ route('login') }}">Login here!</a></p>
          </div>
        </form>
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
  </body>
</html>
