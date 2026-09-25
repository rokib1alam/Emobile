@extends('layouts.app')
@section('title','Payment Canceled')
@section('content')
<div class="container my-5 text-center">
    <h2>Payment Canceled</h2>
    <p>You have canceled the payment.</p>
    <a href="{{ url('/checkout') }}" class="btn btn-warning mt-3">Back to Checkout</a>
</div>
@endsection
