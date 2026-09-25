@extends('layouts.admin')
@section('title','Roles')
@section('admin_content')

<div class="pc-container">
    <div class="pc-content">

        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">All Roles</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Add New</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Roles Table Start -->
            <div class="col-sm-12">
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
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('roles.give-permissions', $role->id) }}" class="btn btn-primary btn-sm me-1 edit">
                                                    Add / Edit Role Permission <i class="fa fa-edit"></i>
                                                </a>
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
                                                <form id="delete-form-{{ $loop->iteration }}" action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
                                        <th>Role Name</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Roles Table End -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
