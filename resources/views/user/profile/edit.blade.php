@extends('layouts.user')
@section('title', 'Edit Profile')
@section('user_content')
<div class="dashborad-box mb-0">
    <h4 class="heading pt-0">Personal Information</h4>
    <div class="section-inforamation">
        <form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" name="image" class="form-control">
                        @if ($user->user_image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="mt-2" style="width: 150px;">
                        @endif
                    </div>
                </div>
            </div>
            <div class="password-section">
                <h6>Update Password</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Write new password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Write same password again">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg mt-2">Submit</button>
        </form>
    </div>
</div>

@endsection
