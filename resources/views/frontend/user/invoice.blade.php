@extends('layouts.app')
@section('title','Invoice #'.$order->id)
@section('content')
@include('frontend.layouts.others_header')

<!-- BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Invoice #{{ $order->id }}</h1>
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
                            <h4 class="mb-0">Invoice Details</h4>
                            <button onclick="window.print()" class="btn btn-light btn-sm">
                                <i class="ti-printer"></i> Print
                            </button>
                        </div>

                        <div class="card-body p-4">
                            <!-- COMPANY & TRANSACTION INFO -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="fw-bold">Shopwise</h5>
                                    <p class="mb-0">Dhaka, Bangladesh</p>
                                    <p class="mb-0">support@shopwise.com</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                    <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        <span class="badge"
                                              style="background:#28a745; color:#fff;">
                                              {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <!-- CUSTOMER INFO -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Billed To:</h6>
                                    <p class="mb-0">{{ $order->name }}</p>
                                    <p class="mb-0">{{ $order->address }}</p>
                                    <p class="mb-0">{{ $order->phone }}</p>
                                    <p class="mb-0">{{ $order->email }}</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <h6 class="fw-bold">Amount Due:</h6>
                                    <h4 style="color:#FF324D;">
                                        {{ number_format($order->amount, 2) }} {{ $order->currency }}
                                    </h4>
                                </div>
                            </div>

                            <!-- ORDER ITEMS -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead style="background:#f8f9fa;">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            @php
                                                $attributes = json_decode($item->attributes, true);
                                                $options = $attributes['options'] ?? [];
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $item->product->name ?? 'Product Deleted' }}
                                                    @if(!empty($options))
                                                        <br>
                                                        <small class="text-muted">
                                                            Size: {{ $options['size'] ?? '-' }},
                                                            Color: {{ $options['color'] ?? '-' }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price, 2) }} ৳</td>
                                                <td>{{ number_format($item->price * $item->quantity, 2) }} ৳</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total</th>
                                            <th style="color:#FF324D;">
                                                {{ number_format($order->amount, 2) }} ৳
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- THANK YOU -->
                            <div class="text-center">
                                <p class="fw-bold mb-1" style="color:#FF324D;">
                                    Thank you for your purchase!
                                </p>
                                <p class="text-muted mb-0">
                                    For support, contact support@shopwise.com
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.layouts.others_footer')
@endsection
