@extends('layouts.admin')
@section('admin_content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-auto">
                            <div class="page-header-title">
                                <h5 class="mb-0">Admin Profile</h5>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ph-duotone ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $admin->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Profile Card --}}
                <div class="col-lg-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset($admin->image) }}" class="rounded-circle mb-3" width="120" height="120" alt="Admin Image">
                            <h4 class="card-title mb-0">{{ $admin->name }}</h4>
                            <small class="text-muted">{{ $admin->email }}</small>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-outline-primary" title="Edit Profile">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Info Cards --}}
                <div class="col-lg-8">
                    {{-- Personal Info --}}
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user"></i> Personal Info</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="30%">Mobile Number</th>
                                    <td>{{ $admin->mobile_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $admin->gender ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Religion</th>
                                    <td>{{ $admin->religion ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Blood Group</th>
                                    <td>{{ $admin->blood_group ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Profession</th>
                                    <td>{{ $admin->profession ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Address Info --}}
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Address</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="30%">Division</th>
                                    <td>{{ $admin->division->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>{{ $admin->district->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Upazila</th>
                                    <td>{{ $admin->upazila->name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
