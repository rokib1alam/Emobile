
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
                            <li class="breadcrumb-item" aria-current="page">Website Setting</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Settings</h5>
                    </div>
                    <div class="list-group">
                        <a href="#general" class="list-group-item list-group-item-action">General</a>
                        <a href="#gender-setup" class="list-group-item list-group-item-action">Gender Setup</a>
                    </div>
            </div>
        </div> --}}
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Website Setting</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('website.update', $website->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Currency</label>
                                        <select name="currency" class="form-control" id="">
                                            <option value="৳" {{ isset($website) && $website->currency == '৳' ? 'selected' : '' }}>Taka (৳)</option>
                                            <option value="$" {{ isset($website) && $website->currency == '$' ? 'selected' : '' }}>USD ($)</option>
                                            <option value="₹" {{ isset($website) && $website->currency == '₹' ? 'selected' : '' }}>Rupee (₹)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone One</label>
                                        <div class="input-group">
                                            <input id="phone_one" type="text" name="phone_one" value="{{ $website->phone_one ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Two</label>
                                        <div class="input-group">
                                            <input id="phone_two" type="text" name="phone_two" value="{{ $website->phone_two ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Main Email</label>
                                        <div class="input-group">
                                            <input id="main_email" type="text" name="main_email" value="{{ $website->main_email ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Support Email</label>
                                        <div class="input-group">
                                            <input id="support_email" type="text" name="support_email" value="{{ $website->support_email ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <div class="input-group">
                                            <input id="address" type="text" name="address" value="{{ $website->address ?? '' }}" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Opening Time</label>
                                        <div class="input-group">
                                            <input id="opening_time" type="text" name="opening_time" value="{{ $website->opening_time ?? '' }}" class="form-control" placeholder="Opening Time">
                                        </div>
                                    </div>
                                </div>

                                <strong class="text-center text-success"> -- Social Link -- </strong> <br>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Facebook</label>
                                        <div class="input-group">
                                            <input id="facebook" type="text" name="facebook" value="{{ $website->facebook ?? '' }}" class="form-control" placeholder="Facebook">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Twitter</label>
                                        <div class="input-group">
                                            <input id="twitter" type="text" name="twitter" value="{{ $website->twitter ?? '' }}" class="form-control" placeholder="Twitter">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Instragram</label>
                                        <div class="input-group">
                                            <input id="instragram" type="text" name="instragram" value="{{ $website->instragram ?? '' }}" class="form-control" placeholder="Instragram">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Linkedin</label>
                                        <div class="input-group">
                                            <input id="linkedin" type="text" name="linkedin" value="{{ $website->linkedin ?? '' }}" class="form-control" placeholder="Linkedin">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Youtube</label>
                                        <div class="input-group">
                                            <input id="youtube" type="text" name="youtube" value="{{ $website->youtube ?? '' }}" class="form-control" placeholder="Youtube">
                                        </div>
                                    </div>
                                </div>

                                <strong class="text-center text-success"> -- Logo and Favicon -- </strong> <br>
                                <div class="col-md-6">
                                    @if(isset($website) && $website->logo)
                                        <img src="{{ asset($website->logo) }}" alt="Logo" class="img-fluid" style="max-width: 100px;">
                                    @else
                                        <p>Logo is not uploaded.</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if(isset($website) && $website->favicon)
                                        <img src="{{ asset($website->favicon) }}" alt="Favicon" class="img-fluid" style="max-width: 100px;">
                                    @else
                                        <p>Favicon is not uploaded.</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Logo</label>
                                        <div class="input-group">
                                            <input id="logo" type="file" name="logo" class="form-control">
                                            <input type="hidden" name="old_logo" value="{{ $website->logo ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Favicon</label>
                                        <div class="input-group">
                                            <input id="favicon" type="file" name="favicon" class="form-control">
                                            <input type="hidden" name="old_favicon" value="{{ $website->favicon ?? '' }}">
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
