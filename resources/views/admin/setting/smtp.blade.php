@extends('layouts.admin')

@section('admin_content')

<div class="pc-container">
    <div class="pc-content">
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ph-duotone ph-house"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">SMTP Mail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">SMTP Mail Setting</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('smtp.update', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mail Mailer</label>
                                        <div class="input-group">
                                            <input id="mailer" type="text" name="mailer" value="{{ $data->mailer }}" class="form-control" placeholder="Mail Mailer Example: data">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mail Host</label>
                                        <div class="input-group">
                                            <input id="host" type="text" name="host" value="{{ $data->host }}" class="form-control" placeholder="Mail Host">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mail port</label>
                                        <div class="input-group">
                                            <input id="port" type="text" name="port" value="{{ $data->port }}" class="form-control" placeholder="Mail port Example:2525">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mail Username</label>
                                        <div class="input-group">
                                            <input id="user_name" type="text" name="user_name" value="{{ $data->user_name }}" class="form-control" placeholder="Mail Username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mail Password</label>
                                        <div class="input-group">
                                            <input id="password" type="text" name="password" value="{{ $data->password }}" class="form-control" placeholder="Mail Password">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
