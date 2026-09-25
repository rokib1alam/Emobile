@extends('layouts.admin')
@section('title', 'Dashboard')
@section('admin_content')

    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-auto">
                            <div class="page-header-title">
                                <h5 class="mb-0">Dashboard</h5>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}"><i
                                            class="ph-duotone ph-house"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Main Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card statistics-card-1">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5>Total Editor</h5>
                        </div>
                        <div class="card-body text-center">
                            <i class="fa fa-wrench fa-3x text-warning mb-3"></i>
                            <div class="d-flex justify-content-center align-items-center">
                                <h3 class="f-w-300 m-b-0">{{ $totalEditor }}</h3>
                            </div>
                            <h4 class="text-muted mb-0 mt-2">Editor</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card statistics-card-1">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5>Total Admin</h5>
                        </div>
                        <div class="card-body text-center">
                            <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                            <div class="d-flex justify-content-center align-items-center">
                                <h3 class="f-w-300 m-b-0">{{ $totalAdmin }}</h3>
                            </div>
                            <h4 class="text-muted mb-0 mt-2">Admin Users</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card statistics-card-1">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h5>Total Superadmin</h5>
                        </div>
                        <div class="card-body text-center">
                            <i class="fas fa-user-shield fa-3x text-danger mb-3"></i>
                            <div class="d-flex justify-content-center align-items-center">
                                <h3 class="f-w-300 m-b-0">{{ $totalSuperadmin }}</h3>
                            </div>
                            <h4 class="text-muted mb-0 mt-2">Superadmin Users</h4>
                        </div>
                    </div>
                </div>


            </div><!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
