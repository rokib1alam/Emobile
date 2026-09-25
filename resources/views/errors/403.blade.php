@extends('layouts.admin')

@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card border-danger shadow">
                    <div class="card-body text-center">
                        <h1 class="text-danger display-4">403</h1>
                        <h4 class="text-dark">{{ $message ?? 'You do not have permission.' }}</h4>
                        <p class="text-muted">You do not have permission to access this page.</p>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-home me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
