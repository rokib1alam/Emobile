@extends('layouts.admin')

@section('admin_content')

    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-auto">
                            <div class="page-header-title">
                                <h5 class="mb-0">Admin Dashboard</h5>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}"><i
                                            class="ph-duotone ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Password Change</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- [ breadcrumb ] end -->
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="mb-0">Change Your Password</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('admin.password.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Old Password</label>
                                        <div class="input-group">
                                            <input id="old_password" type="password" name="old_password" class="form-control" placeholder="Old Password">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('#old_password')">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('#password')">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('#password_confirmation')">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
{{-- to view password  --}}
    <script>
        function togglePasswordVisibility(fieldId) {
            const field = document.querySelector(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
@endsection
