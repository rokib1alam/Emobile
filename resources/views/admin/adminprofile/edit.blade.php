@extends('layouts.admin')
@section('title', 'Profile Edit')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Edit Admin Profile</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="ph-duotone ph-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.profile') }}">Back</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Profile Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                      </div>

                      <!-- Email -->
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                      </div>

                      <!-- Mobile Number -->
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $admin->mobile_number) }}">
                      </div>

                      <!-- Gender -->
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                          <option value="">Select Gender</option>
                          <option value="male" {{ $admin->gender == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ $admin->gender == 'female' ? 'selected' : '' }}>Female</option>
                          <option value="other" {{ $admin->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                      </div>

                      <!-- Religion -->
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Religion</label>
                        <select name="religion" class="form-select">
                          <option value="">Select Religion</option>
                          @foreach ($religions as $key => $value)
                            <option value="{{ $key }}" {{ $admin->religion == $key ? 'selected' : '' }}>{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>

                      <!-- Blood Group -->
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-select">
                          <option value="">Select Blood Group</option>
                          @foreach ($bloodGroups as $bg)
                            <option value="{{ $bg }}" {{ $admin->blood_group == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                          @endforeach
                        </select>
                      </div>

                      <!-- Profession -->
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Profession</label>
                        <select name="profession_type" class="form-select">
                          <option value="">Select Profession</option>
                          @foreach ($professions as $key => $label)
                            <option value="{{ $key }}" {{ $admin->profession_type == $key ? 'selected' : '' }}>{{ $label }}</option>
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



                      <!-- Profile Image -->
                      <div class="col-md-12 mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @if ($admin->image)
                          <img src="{{ asset( $admin->image) }}" class="img-thumbnail mt-2" width="150" alt="User Image">
                        @endif
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


@endsection
