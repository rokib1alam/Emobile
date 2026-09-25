@extends('layouts.admin')
@section('title','Create Permission')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Create Permission</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back to List</a>
                        </ul>
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
                        <h5>Create New Permission</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter permission name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <label for="guard_name" class="form-label">Guard Name</label>
                                    <input type="text" name="guard_name" id="guard_name" class="form-control @error('guard_name') is-invalid @enderror" placeholder="Enter guard name" value="{{ old('guard_name', 'web') }}">
                                    @error('guard_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
