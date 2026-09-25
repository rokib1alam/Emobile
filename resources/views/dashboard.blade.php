@extends('layouts.app')
@section('title','My Account')
@section('content')

@include('frontend.layouts.others_header')

<!-- BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 style="text-transform: uppercase;">
                        Welcome to, <strong>{{ Str::limit(Auth::user()->name, 12) }}</strong>
                    </h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
                </div>

        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main_content">
    <div class="section">
        <div class="container">
            <div class="row">
                <!-- SIDEBAR MENU -->
                <div class="col-lg-3 col-md-4">
                    <div class="dashboard_menu">
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#dashboard"><i class="ti-layout-grid2"></i>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#orders"><i class="ti-shopping-cart-full"></i>Orders</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wishlist') }}">
                                    <i class="ti-heart"></i> Wishlist
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#returns"><i class="ti-reload"></i>Cancel/Return</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#messages"><i class="ti-comments"></i>Messages</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#address"><i class="ti-location-pin"></i>My Address</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#account-detail"><i class="ti-id-badge"></i>Account Details</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-lock"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- MAIN CONTENT AREA -->
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content dashboard_content">

                        <!-- DASHBOARD -->
                        <div class="tab-pane fade active show" id="dashboard">
                            <x-user.dashboard-summary />
                        </div>

                        <!-- ORDERS -->
                        <div class="tab-pane fade" id="orders">
                            <x-user.orders :orders="$orders" />
                        </div>

                        <!-- WISHLIST -->
                        <div class="tab-pane fade" id="wishlist">
                            <x-user.wishlist />
                        </div>

                        <!-- CANCEL / RETURN -->
                        <div class="tab-pane fade" id="returns">
                            <x-user.return-requests />
                        </div>

                        <!-- MESSAGES -->
                        <div class="tab-pane fade" id="messages">
                            <x-user.messages />
                        </div>

                        <!-- ADDRESS -->
                        <div class="tab-pane fade" id="address">
                            <x-user.address :user="$user" />
                        </div>

                        <!-- ACCOUNT DETAILS -->
                        <div class="tab-pane fade" id="account-detail">
                            <div class="card">
                                <div class="card-header"><h3>Account Details</h3></div>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" action="{{ route('profile.update', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <!-- Name -->
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Full Name *</label>
                                                <input required class="form-control" name="name" value="{{ old('name', $user->name) }}">
                                            </div>

                                            <!-- Phone -->
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Phone Number *</label>
                                                <input required class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Email *</label>
                                                <input required class="form-control" name="email" type="email" value="{{ old('email', $user->email) }}">
                                            </div>

                                            <!-- Profile Image -->
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Profile Picture</label>
                                                <input class="form-control" name="image" type="file" accept="image/*">
                                                @if($user->image)
                                                    <img src="{{ asset($user->image) }}" width="100" class="mt-2 rounded">
                                                @endif
                                            </div>

                                            <!-- 📦 Shipping/Billing Address Section -->
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Division *</label>
                                                <select id="division" name="division" class="form-control" required>
                                                    <option value="">Select Division</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>District *</label>
                                                <select id="district" name="district" class="form-control" required>
                                                    <option value="">Select District</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Upazila *</label>
                                                <select id="upazila" name="upazila" class="form-control" required>
                                                    <option value="">Select Upazila</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Union *</label>
                                                <select id="union" name="union" class="form-control" required>
                                                    <option value="">Select Union</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Postcode *</label>
                                                <input class="form-control" name="postcode" value="{{ old('postcode', $user->postcode) }}">
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Full Address *</label>
                                                <textarea class="form-control" name="address_details" rows="2">{{ old('address_details', $user->address_details) }}</textarea>
                                            </div>

                                            <!-- Current Password -->
                                            <div class="form-group col-md-12 mb-3">
                                                <label for="currentPassword">Current Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="currentPassword" name="password" type="password">
                                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#currentPassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- New Password -->
                                            <div class="form-group col-md-12 mb-3">
                                                <label for="newPassword">New Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="newPassword" name="new_password" type="password">
                                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#newPassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="form-group col-md-12 mb-3">
                                                <label for="confirmPassword">Confirm Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="confirmPassword" name="confirm_password" type="password">
                                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#confirmPassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out">Save</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div><!-- tab content -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetInput = document.querySelector(this.getAttribute('data-target'));
            const icon = this.querySelector('i');

            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>


@include('frontend.layouts.others_footer')
@endsection
