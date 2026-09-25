@extends('layouts.app')
@section('title', 'Order #'.$order->id)

@section('content')
@include('frontend.layouts.others_header')

<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Order #{{ $order->id }}</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="main_content">
    <div class="section">
        <div class="container">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center"
                                            style="background:#FF324D; color:#fff;">
                    <h4 class="mb-0">Order Details</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">Back</a>
                </div>

                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold">Customer Info</h5>
                            <p class="mb-0">{{ $order->name }}</p>
                            <p class="mb-0">{{ $order->phone }}</p>
                            <p class="mb-0">{{ $order->email }}</p>
                            <p class="mb-0">{{ $order->address }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                            </p>
                            <p><strong>Total Amount:</strong> {{ number_format($order->amount, 2) }} {{ $order->currency }}</p>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
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
                                    <th>{{ number_format($order->amount, 2) }} ৳</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <p class="fw-bold">Thank you for your purchase!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.layouts.others_footer')
@endsection
