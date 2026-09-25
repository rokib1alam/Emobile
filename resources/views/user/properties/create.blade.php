@extends('layouts.user')
@section('title', 'Add Property')
@section('user_content')

<div class="dashborad-box mb-0">
    <h4 class="heading pt-0">বিক্রয় ফর্ম</h4>
    <div class="section-inforamation">
        <form id="propertyForm" action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <label for="title" class="form-label">শিরোনাম</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="শিরোনাম লিখুন" required>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="description" class="form-label">বিবরণ</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="বিবরণ লিখুন" required></textarea>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="qnty" class="form-label">পরিমাণ (কত শতাংশ)</label>
                    <input type="number" class="form-control" id="qnty" name="qnty" placeholder="পরিমাণ লিখুন" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="address" class="form-label">ঠিকানা</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="ঠিকানা লিখুন" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="zilla" class="form-label">জেলা</label>
                    <input type="text" class="form-control" id="zilla" name="zilla" placeholder="জেলার নাম লিখুন" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="bds" class="form-label">BDS/RSCS</label>
                    <input type="text" class="form-control" id="bds" name="bds" placeholder="BDS/RSCS লিখুন">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="morrja" class="form-label">মৌজা</label>
                    <input type="text" class="form-control" id="morrja" name="morrja" placeholder="মৌজা লিখুন">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="category" class="form-label">জমির ধরন</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="residential">আবাসিক</option>
                        <option value="commercial">বাণিজ্যিক</option>
                        <option value="agricultural">কৃষি</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="road" class="form-label">পাশের রাস্তার পরিমাপ (কত ফিট)</label>
                    <input type="text" class="form-control" id="road" name="road" placeholder="পরিমাপ লিখুন">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="bayna" class="form-label">বায়না</label>
                    <input type="text" class="form-control" id="bayna" name="bayna" placeholder="বায়নার তথ্য লিখুন">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="price" class="form-label">টাকার পরিমাণ</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="টাকার পরিমাণ লিখুন">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="image" class="form-label">ছবি আপলোড করুন</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg mt-2">জমা দিন</button>
        </form>
    </div>
</div>

@endsection
