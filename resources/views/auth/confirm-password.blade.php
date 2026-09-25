<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom-style.css">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div style="display: flex; align-items: center; margin-top: 30px;">
                <i class="bx bxl-xing" style="font-size: 32px;"></i>
                <img src="{{ $setting->logo }}" alt="Logo" style="height: 50px; width: auto;" />
            </div>
            <div class="text-left-side">
                <h2>Update Your Password <br><span style="font-size: 30px;">Secure Your Account</span></h2>
                <p>Use the form below to update your password.</p>
            </div>
        </div>
        <div class="right-side">
            @if (session('status'))
                <div class="status-message" style="color: green; margin-bottom: 10px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                     @csrf
                <input type="hidden" name="_method" value="PUT">

                <h1>Update Password</h1>

                <!-- Current Password -->
                <div class="input-box">
                    <input
                        type="password"
                        name="current_password"
                        placeholder="Enter Current Password"
                        required
                    />
                    @error('current_password')
                        <span class="error-message" style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="input-box">
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter New Password"
                        required
                    />
                    @error('password')
                        <span class="error-message" style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="input-box">
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm New Password"
                        required
                    />
                    @error('password_confirmation')
                        <span class="error-message" style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn">Update Password</button>
            </form>
        </div>
    </div>
</body>
</html>
