@extends('layouts.admin')
@section('title', 'Add Permission')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-end">
                    <!-- Back to List Button -->
                    <div class="col-sm-auto">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Role: {{ $role->name }}</h5>
                    </div>
                    <div class="card-body">
                        @if(empty($groupedPermissions))
                            <p>No permissions available to assign.</p>
                        @else
                        <form action="{{ route('roles.update-permissions', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @foreach ($groupedPermissions as $moduleName => $permissions)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-primary">{{ $moduleName }}</h6>
                                    <div class="card p-3 border rounded">
                                        <div class="row">
                                            @foreach ($permissions as $permissionGroup)
                                                @foreach ($permissionGroup as $permission)
                                                    <div class="col-md-4 col-sm-6">
                                                        <div class="form-check">
                                                            <input type="checkbox"
                                                                   name="permissions[]"
                                                                   value="{{ $permission }}"
                                                                   id="permission_{{ Str::slug($permission) }}"
                                                                   class="form-check-input"
                                                                   {{ $role->permissions->contains('name', $permission) ? 'checked' : '' }}>
                                                            <label for="permission_{{ Str::slug($permission) }}" class="form-check-label">
                                                                <i class="fas fa-check-circle text-success"></i> {{ ucfirst($permission) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Update Permissions
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
