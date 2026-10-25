@extends('layouts.app')
@section('title','Invoice #'.$order->id)
@section('content')
@include('frontend.layouts.nheader')

<!-- BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Invoice #{{ $order->transaction_id }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main_content">
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow">
                        <!-- HEADER -->
                        <div class="card-header d-flex justify-content-between align-items-center"
                             style="background:#FF324D; color:#fff;">
                            <h4 class="mb-0 text-white">Invoice Details</h4>
                            <button onclick="window.print()" class="btn btn-light btn-sm">
                                <i class="ti-printer"></i> Print
                            </button>
                        </div>
                        <div class="card-body p-4">
                            <!-- COMPANY & TRANSACTION INFO -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="fw-bold">{{ $seo->meta_title }}</h5>
                                    <p class="mb-0">{{ $setting->address }}</p>
                                    <p class="mb-0">{{ $setting->main_email }}</p>
                                    <p class="mb-0">{{ $setting->phone_one }}</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                    <p class="mb-1"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                                    <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                                    <p class="mb-0">
                                        <strong>Status:</strong>
                                        <span class="badge" style="background:#28a745; color:#fff;">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <!-- STEADFAST COURIER TRACKING BOX -->
                            @if($order->steadfast_tracking_code)
                                <div class="alert alert-info border-info my-3 p-3" style="background-color: #f0f8ff; border-radius: 8px;">
                                    <h6 class="text-primary font-weight-bold mb-2">
                                        <i class="fas fa-shipping-fast me-2"></i> কুরিয়ার পার্সেল ট্র্যাকিং
                                    </h6>
                                    <p class="mb-1"><strong>ট্র্যাকিং কোড:</strong> <span class="badge bg-dark fs-6">{{ $order->steadfast_tracking_code }}</span></p>
                                    <p class="mb-0 text-muted">
                                        আপনার পার্সেলের অবস্থান জানতে 
                                        <a href="https://steadfast.com.bd/t/{{ $order->steadfast_tracking_code }}" target="_blank" class="fw-bold text-decoration-underline text-primary">
                                            এখানে ক্লিক করুন (Steadfast Live Tracking)
                                        </a>
                                    </p>
                                </div>
                            @endif

                            <hr>

                            <!-- CUSTOMER INFO -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Billed To:</h6>
                                    <p class="mb-0"><strong>{{ $order->name }}</strong></p>
                                    <p class="mb-0">{{ $order->address }}</p>
                                    <p class="mb-0">Phone: {{ $order->phone }}</p>
                                    <p class="mb-0">Email: {{ $order->email }}</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <h6 class="fw-bold">Total Amount Due:</h6>
                                    <h4 style="color:#FF324D;">
                                        {{ number_format($order->amount, 2) }} {{ $order->currency }}
                                    </h4>
                                </div>
                            </div>

                            <!-- ORDER ITEMS TABLE -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead style="background:#f8f9fa;">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $subtotal = 0; @endphp
                                        @foreach($order->items as $item)
                                            @php
                                                $attributes = json_decode($item->attributes, true) ?? [];
                                                $itemTotal = $item->price * $item->quantity;
                                                $subtotal += $itemTotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $item->product->product_name ?? $item->product->name ?? 'Product' }}</strong>
                                                    @if(!empty($attributes['size']) || !empty($attributes['color']))
                                                        <br>
                                                        <small class="text-muted">
                                                            @if(!empty($attributes['size'])) Size: {{ $attributes['size'] }} @endif
                                                            @if(!empty($attributes['color'])) | Color: {{ $attributes['color'] }} @endif
                                                        </small>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">{{ number_format($item->price, 2) }} ৳</td>
                                                <td class="text-end">{{ number_format($itemTotal, 2) }} ৳</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Subtotal</th>
                                            <td class="text-end">{{ number_format($subtotal, 2) }} ৳</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end">Delivery Charge</th>
                                            <td class="text-end">150.00 ৳</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end">Grand Total</th>
                                            <th class="text-end" style="color:#FF324D;">
                                                {{ number_format($order->amount, 2) }} ৳
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- THANK YOU -->
                            <div class="text-center mt-4">
                                <p class="fw-bold mb-1" style="color:#FF324D;">
                                    Thank you for your purchase!
                                </p>
                                <p class="text-muted mb-0">
                                    For support, contact {{ $setting->main_email }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.layouts.footer')
@endsection
