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

            <!-- [ Statistics Cards ] start -->
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
            </div><!-- [ Statistics Cards ] end -->

            <!-- [ ORDERS TABLE SECTION ] start -->
            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header table-card-header">
                            <h5>List of Customer Orders</h5>
                        </div>
                        <div class="card-body">
                            <!-- Filter Buttons -->
                            <div class="mb-3">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm {{ request('status') === null ? 'active' : '' }}">All</a>
                                <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="btn btn-outline-warning btn-sm {{ request('status') === 'pending' ? 'active' : '' }}">Pending</a>
                                <a href="{{ route('admin.dashboard', ['status' => 'processing']) }}" class="btn btn-outline-info btn-sm {{ request('status') === 'processing' ? 'active' : '' }}">Processing</a>
                                <a href="{{ route('admin.dashboard', ['status' => 'completed']) }}" class="btn btn-outline-success btn-sm {{ request('status') === 'completed' ? 'active' : '' }}">Completed</a>
                                <a href="{{ route('admin.dashboard', ['status' => 'cancelled']) }}" class="btn btn-outline-danger btn-sm {{ request('status') === 'cancelled' ? 'active' : '' }}">Cancelled</a>
                            </div>

                            <!-- DataTable -->
                            <div class="dt-responsive table-responsive">
                                <table id="cbtn-selectors" class="table table-striped table-bordered nowrap table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Transaction ID</th>
                                            <th>Customer Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Amount</th>
                                            <th>Steadfast Tracking</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="fw-bold text-primary">{{ $order->transaction_id }}</span>
                                                </td>
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ number_format($order->amount, 2) }} ৳</td>
                                                <td>
                                                    @if ($order->steadfast_tracking_code)
                                                        <a href="https://steadfast.com.bd/t/{{ $order->steadfast_tracking_code }}" target="_blank" class="badge bg-dark text-decoration-none">
                                                            {{ $order->steadfast_tracking_code }}
                                                        </a>
                                                    @else
                                                        <span class="badge bg-secondary">Not Sent</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($order->status === 'processing')
                                                        <span class="badge bg-info">Processing</span>
                                                    @elseif ($order->status === 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif ($order->status === 'cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($order->steadfast_tracking_code))
                                                        <div class="d-flex gap-2">
                                                            <form action="{{ route('admin.orders.send-steadfast', $order->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Steadfast-এ বুকিং পাঠাতে নিশ্চিত তো?')">
                                                                    <i class="fa fa-check"> Accept & Book</i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Already Booked</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Transaction ID</th>
                                            <th>Customer Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Amount</th>
                                            <th>Steadfast Tracking</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- [ ORDERS TABLE SECTION ] end -->

        </div>
    </div>
@endsection