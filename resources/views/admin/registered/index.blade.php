@extends('layouts.admin')
@section('title','Pending Admins')
@section('admin_content')

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Pending Admin Registrations</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>List of Registered Admins (Waiting for Approval)</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('registered-admins.index') }}" class="btn btn-outline-primary btn-sm {{ request('status') === null ? 'active' : '' }}">All</a>
                            <a href="{{ route('registered-admins.index', ['status' => 'pending']) }}" class="btn btn-outline-warning btn-sm {{ request('status') === 'pending' ? 'active' : '' }}">Pending</a>
                            <a href="{{ route('registered-admins.index', ['status' => 'approved']) }}" class="btn btn-outline-success btn-sm {{ request('status') === 'approved' ? 'active' : '' }}">Approved</a>
                            <a href="{{ route('registered-admins.index', ['status' => 'rejected']) }}" class="btn btn-outline-danger btn-sm {{ request('status') === 'rejected' ? 'active' : '' }}">Rejected</a>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-bordered nowrap table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>Profession</th>
                                        <th>Location</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->mobile_number }}</td>
                                            <td>{{ ucfirst($admin->gender) }}</td>
                                            <td>{{ $admin->profession_type }}</td>
                                            <td>{{ $admin->division ?? '' }}, {{ $admin->district ?? '' }}, {{ $admin->upazila ?? '' }}</td>
                                            <td>
                                                <img src="{{ asset($admin->image) }}" alt="profile" width="40" height="40" class="rounded-circle">
                                            </td>
                                            <td>
                                                @if ($admin->is_approved === 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif ($admin->is_approved === 0)
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_null($admin->is_approved))
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ route('registered-admins.approve', $admin->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fa fa-check">Accept</i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('registered-admins.reject', $admin->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-times">Reject</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-muted">No action</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>Profession</th>
                                        <th>Location</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

@endsection
