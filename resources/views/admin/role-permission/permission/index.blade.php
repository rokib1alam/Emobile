@extends('layouts.admin')
@section('title','Permissions')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm-auto">
                    <div class="page-header-title">
                        <h5 class="mb-0">Users & Roles Management</h5>
                    </div>
                </div>
                <div class="col-sm-auto d-flex justify-content-end">
                    <a href="{{ route('users.create') }}" class="btn btn-primary me-2">+ Add New User</a>
                    <a href="{{ route('permissions.create') }}" class="btn btn-secondary">+ Add New Permission</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ph-duotone ph-house"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- Users Table Start -->
                     <!-- Users Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Users</h5>
                       <!--<div class="datatable-search">-->
                       <!--     <input type="text" class="datatable-input form-control border-primary rounded-pill" placeholder="Search">-->
                       <!-- </div>-->

                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($users as $user)
                                @if ($user->name !== 'Super Admin' || auth()->user()->name === 'Super Admin') <!-- Show Super Admin only if logged in user is Super Admin -->
                                    <div class="list-group-item d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Display Roles -->
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-success">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="d-flex">
                                            <!-- Edit Button -->
                                            @can('update user')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm me-1">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                            <!-- Delete Button -->
                                            @can('delete user')
                                            <button class="btn btn-danger btn-sm delete" data-id="{{ $loop->iteration }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            <!-- Delete Form -->
                                            <form id="delete-form-{{ $loop->iteration }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>

                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>

                </div>

                 <!-- Roles Table Start -->
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>Role List</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="roles-table" class="table table-striped table-bordered nowrap table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Role Name</th>
                                        {{-- <th>Guard Name</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($roles as $role)
                                    @if ($role->name !== 'super-admin' || auth()->user()->name === 'Super Admin')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td class="d-flex">
                                                @can('give permissions')
                                                    <a href="{{ route('roles.give-permissions', $role->id) }}" class="btn btn-primary btn-sm me-1 edit">
                                                        <i class="fa fa-plus me-1"></i> <span class="fs-6">+ / - Role Permission</span>
                                                    </a>
                                                @endcan

                                                @can('update role')
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm me-1 edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('delete role')
                                                    <button class="btn btn-danger btn-sm delete" data-id="{{ $loop->iteration }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan

                                                <form id="delete-form-{{ $loop->iteration }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Role Name</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            <!-- Roles Table End -->
            </div>
        <!-- Users Table End -->

        <!-- Permissions Table Start -->
        <div class="col-sm-6">
            <div class="card">
              <div class="card-header table-card-header">
                <h5>Permission List</h5>
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">
                  <table id="cbtn-selectors" class="table table-striped table-bordered nowrap table-sm">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Permission Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <td class="d-flex">
                                    @can('update permission')
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete permission')
                                        <button class="btn btn-danger btn-sm delete" data-id="{{ $loop->iteration }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endcan
                                    <form id="delete-form-{{ $loop->iteration }}" action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Permission Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>

        <!-- Permissions Table End -->
    </div>
    <!-- [ Main Content ] end -->

    </div>
</div>
@endsection
