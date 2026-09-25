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
                            <li class="breadcrumb-item" aria-current="page">OnPage SEO</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Your SEO Setting</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('seo.update', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <div class="input-group">
                                            <input id="meta_title" type="text" name="meta_title" value="{{ $data->meta_title }}" class="form-control" placeholder="Meta Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Author</label>
                                        <div class="input-group">
                                            <input id="meta_author" type="text" name="meta_author" value="{{ $data->meta_author }}" class="form-control" placeholder="Meta Author">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Tags</label>
                                        <div class="input-group">
                                            <input id="meta_tag" type="text" name="meta_tag" value="{{ $data->meta_tag }}" class="form-control" placeholder="Meta Tags">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Keyword</label>
                                        <div class="input-group">
                                            <input id="meta_keyword" type="text" name="meta_keyword" value="{{ $data->meta_keyword }}" class="form-control" placeholder="Meta Keyword">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <div class="input-group">
                                            <textarea name="meta_description" id="meta_description" class="form-control">{{ $data->meta_description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <strong class="text-center text-success"> -- Others Option -- </strong> <br>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Google Verification</label>
                                        <div class="input-group">
                                            <input id="google_verification" type="text" name="google_verification" value="{{ $data->google_verification }}" class="form-control" placeholder="Google Verification">
                                        </div>
                                        <small>Put here only verification code</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Alexa Verification</label>
                                        <div class="input-group">
                                            <input id="alexa_verification" type="text" name="alexa_verification" value="{{ $data->alexa_verification }}" class="form-control" placeholder="Alexa Verification">
                                        </div>
                                        <small>Put here only verification code</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Google Analytics</label>
                                        <div class="input-group">
                                            <textarea name="google_analytics" id="google_analytics" class="form-control">{{ $data->google_analytics }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Google Adsense</label>
                                        <div class="input-group">
                                            <textarea name="google_adsense" id="google_adsense" class="form-control">{{ $data->google_adsense }}</textarea>
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
