@extends('layouts.admin')

@section('admin_content')

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
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
                            <li class="breadcrumb-item" aria-current="page">Page Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- [ breadcrumb ] end -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Edit this page</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('page.update', $page->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Position</label>
                                        <div class="input-group">
                                            <select name="page_position" class="form-control">
                                                <option value="1" {{ $page->page_position == 1 ? 'selected' : '' }}>Line One</option>
                                                <option value="2" {{ $page->page_position == 2 ? 'selected' : '' }}>Line Two</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Name</label>
                                        <div class="input-group">
                                            <input id="page_name" type="text" name="page_name" class="form-control" placeholder="Page Name" value="{{ $page->page_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Title</label>
                                        <div class="input-group">
                                            <input id="page_title" type="text" name="page_title" class="form-control" placeholder="Page Title" value="{{ $page->page_title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Description</label>
                                        <textarea class="form-control textarea" name="page_description" id="summernote">{{ $page->page_description }}</textarea>
                                        <small>This data will show on your webpage.</small>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary">Update Page</button>
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

