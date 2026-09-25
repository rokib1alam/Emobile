@extends('layouts.admin')

@section('title', 'Edit User')

@section('admin_content')
<div class="pc-container">
  <div class="pc-content">

    <!-- Breadcrumb -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center justify-content-between">
          <div class="col-sm-auto">
            <div class="page-header-title">
              <h5 class="mb-0">Edit User</h5>
            </div>
          </div>
          <div class="col-sm-auto">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Card -->
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5 class="mb-0">Update User Details</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row">
                @php
                  $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                  $professions = ['electrician' => 'Electrician', 'plumber' => 'Plumber', 'tiles_worker' => 'Tiles Worker', 'other' => 'Other'];
                  $religions = ['islam' => 'Islam', 'hinduism' => 'Hinduism', 'christianity' => 'Christianity', 'buddhism' => 'Buddhism', 'other' => 'Other'];
                @endphp

                <!-- Name -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>

                <!-- Mobile Number -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Mobile Number</label>
                  <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number) }}">
                </div>

                <!-- Gender -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Gender</label>
                  <select name="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                  </select>
                </div>

                <!-- Religion -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Religion</label>
                  <select name="religion" class="form-select">
                    <option value="">Select Religion</option>
                    @foreach ($religions as $key => $value)
                      <option value="{{ $key }}" {{ $user->religion == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Blood Group -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Blood Group</label>
                  <select name="blood_group" class="form-select">
                    <option value="">Select Blood Group</option>
                    @foreach ($bloodGroups as $bg)
                      <option value="{{ $bg }}" {{ $user->blood_group == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Profession -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Profession</label>
                  <select name="profession_type" class="form-select">
                    <option value="">Select Profession</option>
                    @foreach ($professions as $key => $label)
                      <option value="{{ $key }}" {{ $user->profession_type == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Division -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Division</label>
                  <select name="division" id="division" class="form-select">
                    <option value="">Select Division</option>
                    <!-- Dynamic options via JS -->
                  </select>
                </div>

                <!-- District -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">District</label>
                  <select name="district" id="district" class="form-select">
                    <option value="">Select District</option>
                    <!-- Dynamic options via JS -->
                  </select>
                </div>

                <!-- Upazila -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Upazila</label>
                  <select name="upazila" id="upazila" class="form-select">
                    <option value="">Select Upazila</option>
                    <!-- Dynamic options via JS -->
                  </select>
                </div>

                <!-- Roles -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Roles</label>
                  <select name="roles[]" class="form-select" multiple>
                    @foreach ($roles as $role)
                      <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <!-- Profile Image -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Profile Image</label>
                  <input type="file" name="image" class="form-control" accept="image/*">
                  @if ($user->image)
                    <img src="{{ asset( $user->image) }}" class="img-thumbnail mt-2" width="150" alt="User Image">
                  @endif
                </div>

                <!-- Password -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Optional">
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Optional">
                </div>

              </div>

              <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save me-1"></i> Update User
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<script src="{{ asset('/') }}frontend/assets/js/script.js"></script>
@endsection
