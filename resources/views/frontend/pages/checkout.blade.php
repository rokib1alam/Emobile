@extends('layouts.app')
@section('title','Checkout')
@section('content')

@include('frontend.layouts.nheader')

<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container-fluid px-md-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="main_content">
    <div class="section">
        <div class="container-fluid px-md-5">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('checkout.submit') }}">
                @csrf
                
                {{-- Hidden inputs for Direct Buy Now Product --}}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                @php
                    $unitPrice = $product->discount_price ?? $product->selling_price;
                    $shippingCharge = 150; // ডেলিভারি চার্জ ১৫০ টাকা
                    $totalAmount = $unitPrice + $shippingCharge;
                @endphp
                <input type="hidden" name="amount" value="{{ $totalAmount }}">
                <input type="hidden" name="delivery_charge" value="{{ $shippingCharge }}">

                <div class="row">
                    <div class="col-12">
                        {{-- Full Width Card with Soft Shadow --}}
                        <div class="card border-0 p-4 p-md-5 mb-5" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);">
                            <div class="row">
                                {{-- Billing Details --}}
                                <div class="col-md-6 border-end pe-md-5">
                                    <div class="heading_s1 mb-4"><h4>Billing details</h4></div>
                                    
                                    <div class="form-group mb-3">
                                        <label class="fw-bold">নাম *</label>
                                        <input type="text" name="billing_fname" placeholder="আপনার সম্পূর্ণ নাম লিখুন"
                                             value="{{ old('billing_fname', auth()->user()->name ?? '') }}"
                                             class="form-control @error('billing_fname') is-invalid @enderror" required>
                                        @error('billing_fname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="fw-bold">ঠিকানা *</label>
                                        <textarea name="billing_address" placeholder="বাসার নম্বর, রোড, এলাকা, থানা, জেলা" rows="3"
                                             class="form-control @error('billing_address') is-invalid @enderror" required>{{ old('billing_address', auth()->user()->address_details ?? '') }}</textarea>
                                        @error('billing_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="fw-bold">ফোন নম্বর *</label>
                                        <input type="tel" name="billing_phone" placeholder="017XXXXXXXX"
                                             value="{{ old('billing_phone', auth()->user()->phone ?? '') }}"
                                             maxlength="14"
                                             oninput="this.value = this.value.replace(/[^0-9+]/g, '')"
                                             class="form-control @error('billing_phone') is-invalid @enderror" required>
                                        @error('billing_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="fw-bold">ইমেইল অ্যাড্রেস *</label>
                                        <input type="email" name="billing_email" placeholder="example@domain.com"
                                            value="{{ old('billing_email', auth()->user()->email ?? '') }}"
                                            class="form-control @error('billing_email') is-invalid @enderror" required>
                                        @error('billing_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="fw-bold">Country / Region *</label>
                                        <input type="text" name="country" value="Bangladesh" class="form-control bg-light" readonly>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="fw-bold">ডেলিভারি চার্জ</label>
                                        <input type="text" value="Standard Delivery - ৳{{ $shippingCharge }}" class="form-control bg-light" readonly>
                                    </div>
                                </div>

                                {{-- Order Summary + Payment Method --}}
                                <div class="col-md-6 ps-md-5">
                                    <div class="order_review mb-4">
                                        <div class="heading_s1 mb-4"><h4>Your order</h4></div>
                                        <div class="table-responsive order_table">
                                            <table class="table align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th class="text-end">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @php
                                                                    $thumbnail = $product->thumbnail ?? ($product->colors->first()->thumbnail ?? 'frontend/assets/images/no-image.png');
                                                                @endphp
                                                                <img src="{{ asset($thumbnail) }}" alt="{{ $product->product_name }}" width="60" class="img-thumbnail me-3" style="margin-right: 15px;">
                                                                <span class="fw-bold">{{ $product->product_name }} <span class="text-muted fw-normal">× 1</span></span>
                                                            </div>
                                                        </td>
                                                        <td class="text-end fw-bold">৳{{ number_format($unitPrice, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Subtotal</th>
                                                        <td class="text-end fw-bold">৳{{ number_format($unitPrice, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping</th>
                                                        <td class="text-end fw-bold">৳{{ $shippingCharge }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total</th>
                                                        <td class="text-end text-danger fw-bold fs-5"><strong>৳{{ number_format($totalAmount, 2) }}</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="payment_method mb-4">
                                        <div class="heading_s1 mb-3"><h4>ক্যাশ অন ডেলিভারি</h4></div>
                                        <div class="p-3 bg-light border rounded mb-3">
                                            <p class="mb-0 text-muted"><i class="fas fa-truck me-2"></i> পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।</p>
                                        </div>
                                        <input type="hidden" name="payment_method" value="cod">
                                    </div>

                                    <button type="submit" class="btn btn-fill-out btn-addtocart" >
                                        <i class="fas fa-lock me-2"></i> এখানে ক্লিক করে অর্ডার কনফার্ম করুন ৳{{ number_format($totalAmount, 2) }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('frontend.layouts.footer')

@endsection