@extends('layouts.user')
@section('title', 'Edit Property')
@section('user_content')
<div class="dashborad-box mb-0">
    <h4 class="heading pt-0">সম্পাদনা ফর্ম</h4>
    <div class="section-inforamation">
        <form id="propertyForm" action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <label for="title" class="form-label">শিরোনাম</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $property->title }}" required>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="description" class="form-label">বিবরণ</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $property->description }}</textarea>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="qnty" class="form-label">পরিমাণ (কত শতাংশ)</label>
                    <input type="number" class="form-control" id="qnty" name="qnty" value="{{ $property->qnty }}" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="address" class="form-label">ঠিকানা</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $property->address }}" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="zilla" class="form-label">জেলা</label>
                    <input type="text" class="form-control" id="zilla" name="zilla" value="{{ $property->zilla }}" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="bds" class="form-label">BDS/RSCS</label>
                    <input type="text" class="form-control" id="bds" name="bds" value="{{ $property->bds }}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="morrja" class="form-label">মৌজা</label>
                    <input type="text" class="form-control" id="morrja" name="morrja" value="{{ $property->morrja }}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="category" class="form-label">জমির ধরন</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="residential" {{ $property->category == 'residential' ? 'selected' : '' }}>আবাসিক</option>
                        <option value="commercial" {{ $property->category == 'commercial' ? 'selected' : '' }}>বাণিজ্যিক</option>
                        <option value="agricultural" {{ $property->category == 'agricultural' ? 'selected' : '' }}>কৃষি</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="road" class="form-label">পাশের রাস্তার পরিমাপ (কত ফিট)</label>
                    <input type="text" class="form-control" id="road" name="road" value="{{ $property->road }}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="bayna" class="form-label">বায়না</label>
                    <input type="text" class="form-control" id="bayna" name="bayna" value="{{ $property->bayna }}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="price" class="form-label">টাকার পরিমাণ</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $property->price }}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="image" class="form-label">ছবি আপলোড করুন</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @if($property->image)
                        <div class="mt-2">
                            <img src="{{ asset($property->image) }}" alt="Property Image" class="img-thumbnail" width="200">
                        </div>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg mt-2">সংরক্ষণ করুন</button>
        </form>
    </div>
</div>


@endsection
