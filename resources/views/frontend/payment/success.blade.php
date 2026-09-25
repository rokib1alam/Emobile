@extends('layouts.app')
@section('title','Payment Successful')
@section('content')
<div class="container my-5 text-center">
    <h2>Thank you! Your payment was successful.</h2>
    <p>Your order has been processed.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
