@extends('layouts.app')
@section('title','Payment Failed')
@section('content')
<div class="container my-5 text-center">
    <h2>Sorry! Your payment failed.</h2>
    <p>Please try again or contact support.</p>
    <a href="{{ url('/checkout') }}" class="btn btn-danger mt-3">Try Again</a>
</div>
@endsection
