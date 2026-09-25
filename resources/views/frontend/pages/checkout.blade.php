@extends('layouts.app')
@section('title','Shopwise | Checkout')
@section('content')

@include('frontend.layouts.others_header')

<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
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
    <div class="container">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('checkout.submit') }}">
            @csrf

            {{-- Cart::total() returns formatted string, so use Cart::totalFloat() for numeric --}}
            <input type="hidden" name="amount" value="{{ Cart::totalFloat() }}">

            <div class="row">

                {{-- Billing Details --}}
                <div class="col-md-6">
                    <div class="heading_s1"><h4>Billing Details</h4></div>

                    <div class="form-group mb-3">
                        <input type="text" name="billing_fname" placeholder="Full Name *"
                            value="{{ old('billing_fname', auth()->user()->name ?? '') }}"
                            class="form-control @error('billing_fname') is-invalid @enderror" required>
                        @error('billing_fname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="billing_address" placeholder="Address *"
                            value="{{ old('billing_address', auth()->user()->address_details ?? '') }}"
                            class="form-control @error('billing_address') is-invalid @enderror" required>
                        @error('billing_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Dropdowns for division/district/upazila/union --}}
                    <div class="form-group mb-3">
                        <label for="division">Division *</label>
                        <select id="division" name="division" class="form-control @error('division') is-invalid @enderror" required>
                            <option value="">Select Division</option>
                        </select>
                        @error('division')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="district">District *</label>
                        <select id="district" name="district" class="form-control @error('district') is-invalid @enderror" required>
                            <option value="">Select District</option>
                        </select>
                        @error('district')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="upazila">Upazila *</label>
                        <select id="upazila" name="upazila" class="form-control @error('upazila') is-invalid @enderror" required>
                            <option value="">Select Upazila</option>
                        </select>
                        @error('upazila')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="union">Union *</label>
                        <select id="union" name="union" class="form-control @error('union') is-invalid @enderror" required>
                            <option value="">Select Union</option>
                        </select>
                        @error('union')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="billing_zipcode" placeholder="Postcode / ZIP *"
                            value="{{ old('billing_zipcode', auth()->user()->postcode ?? '') }}"
                            class="form-control @error('billing_zipcode') is-invalid @enderror" required>
                        @error('billing_zipcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="billing_phone" placeholder="Phone *"
                            value="{{ old('billing_phone', auth()->user()->phone ?? '') }}"
                            class="form-control @error('billing_phone') is-invalid @enderror" required>
                        @error('billing_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="email" name="billing_email" placeholder="Email address *"
                            value="{{ old('billing_email', auth()->user()->email ?? '') }}"
                            class="form-control @error('billing_email') is-invalid @enderror" required>
                        @error('billing_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Order Summary + Payment Method --}}
                <div class="col-md-6">
                    <div class="order_review mb-4">
                        <div class="heading_s1"><h4>My Orders</h4></div>
                        <div class="table-responsive order_table">
                            <table class="table">
                                <thead>
                                    <tr><th>Product</th><th>Total</th></tr>
                                </thead>
                                <tbody>
                                    @foreach(Cart::content() as $item)
                                    <tr>
                                        <td>{{ $item->name }} <span class="product-qty">x {{ $item->qty }}</span></td>
                                        <td>{{ number_format($item->price * $item->qty, 2) }} ৳</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr><th>SubTotal</th><td>{{ Cart::subtotal() }} ৳</td></tr>
                                    <tr><th>Tax</th><td>{{ Cart::tax() }} ৳</td></tr>
                                    <tr><th>Shipping</th><td>Free</td></tr>
                                    <tr><th>Total</th><td><strong>{{ Cart::total() }} ৳</strong></td></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="payment_method">
                        <div class="heading_s1"><h4>Payment Method</h4></div>
                        <div class="custome-radio mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="sslcommerz" value="sslcommerz" checked required>
                            <label for="sslcommerz">Pay with SSLCommerz</label>
                        </div>
                        @error('payment_method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-fill-out btn-block mt-3">Proceed to Payment</button>
                </div>

            </div>
        </form>

    </div>
</div>

@include('frontend.layouts.others_footer')

{{-- JS for dynamic division/district/upazila/union --}}
<script>
    const selectedDivision = "{{ old('division', auth()->user()->division ?? '') }}";
    const selectedDistrict = "{{ old('district', auth()->user()->district ?? '') }}";
    const selectedUpazila = "{{ old('upazila', auth()->user()->upazila ?? '') }}";
    const selectedUnion = "{{ old('union', auth()->user()->union ?? '') }}";

    document.addEventListener('DOMContentLoaded', function () {
        const divisionSelect = document.getElementById('division');
        const districtSelect = document.getElementById('district');
        const upazilaSelect = document.getElementById('upazila');
        const unionSelect = document.getElementById('union');

        const dnccThanas = ['Uttara', 'Banani', 'Gulshan', 'Mohakhali', 'Rampura', 'Tejgaon', 'Mirpur'];
        const dsccThanas = ['Dhanmondi', 'Wari', 'Paltan', 'Motijheel', 'Lalbagh', 'Ramna', 'Kotwali', 'Sutrapur', 'Chawkbazar', 'Gendaria', 'Jatrabari'];

        // Load divisions
        fetch('https://bdapi.vercel.app/api/v.1/division')
            .then(res => res.json())
            .then(data => {
                data.data.forEach(division => {
                    const option = new Option(division.name, division.name);
                    if (division.name === selectedDivision) option.selected = true;
                    divisionSelect.add(option);
                });

                if (selectedDivision) divisionSelect.dispatchEvent(new Event('change'));
            });

        divisionSelect.addEventListener('change', function () {
            const selectedDivisionName = this.value;

            districtSelect.length = 1;
            upazilaSelect.length = 1;
            unionSelect.length = 1;

            fetch('https://bdapi.vercel.app/api/v.1/division')
                .then(res => res.json())
                .then(data => {
                    const division = data.data.find(d => d.name === selectedDivisionName);
                    if (!division) return;

                    fetch(`https://bdapi.vercel.app/api/v.1/district/${division.id}`)
                        .then(res => res.json())
                        .then(data => {
                            data.data.forEach(district => {
                                const option = new Option(district.name, district.name);
                                if (district.name === selectedDistrict) option.selected = true;
                                districtSelect.add(option);
                            });

                            if (selectedDistrict) districtSelect.dispatchEvent(new Event('change'));
                        });
                });
        });

        districtSelect.addEventListener('change', function () {
            const selectedDistrictName = this.value;

            upazilaSelect.length = 1;
            unionSelect.length = 1;

            if (selectedDistrictName === 'Dhaka') {
                upazilaSelect.add(new Option('Dhaka North City Corporation', 'Dhaka North City Corporation'));
                upazilaSelect.add(new Option('Dhaka South City Corporation', 'Dhaka South City Corporation'));

                if (selectedUpazila === 'Dhaka North City Corporation' || selectedUpazila === 'Dhaka South City Corporation') {
                    upazilaSelect.value = selectedUpazila;
                    upazilaSelect.dispatchEvent(new Event('change'));
                }
            }

            fetch('https://bdapi.vercel.app/api/v.1/district')
                .then(res => res.json())
                .then(data => {
                    const district = data.data.find(d => d.name === selectedDistrictName);
                    if (!district) return;

                    fetch(`https://bdapi.vercel.app/api/v.1/upazilla/${district.id}`)
                        .then(res => res.json())
                        .then(data => {
                            data.data.forEach(upazila => {
                                if (upazila.name !== 'Dhaka North City Corporation' && upazila.name !== 'Dhaka South City Corporation') {
                                    const option = new Option(upazila.name, upazila.name);
                                    if (upazila.name === selectedUpazila) option.selected = true;
                                    upazilaSelect.add(option);
                                }
                            });

                            if (selectedUpazila && selectedDistrictName !== 'Dhaka') {
                                upazilaSelect.dispatchEvent(new Event('change'));
                            }
                        });
                });
        });

        upazilaSelect.addEventListener('change', function () {
            const selectedUpazilaName = this.value;

            unionSelect.length = 1;

            if (selectedUpazilaName === 'Dhaka North City Corporation') {
                dnccThanas.forEach(thana => {
                    const option = new Option(thana, thana);
                    if (thana === selectedUnion) option.selected = true;
                    unionSelect.add(option);
                });
                return;
            }

            if (selectedUpazilaName === 'Dhaka South City Corporation') {
                dsccThanas.forEach(thana => {
                    const option = new Option(thana, thana);
                    if (thana === selectedUnion) option.selected = true;
                    unionSelect.add(option);
                });
                return;
            }

            fetch('https://bdapi.vercel.app/api/v.1/upazilla')
                .then(res => res.json())
                .then(data => {
                    const upazila = data.data.find(u => u.name === selectedUpazilaName);
                    if (!upazila) return;

                    fetch(`https://bdapi.vercel.app/api/v.1/union/${upazila.id}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.data && data.data.length > 0) {
                                data.data.forEach(union => {
                                    const option = new Option(union.name, union.name);
                                    if (union.name === selectedUnion) option.selected = true;
                                    unionSelect.add(option);
                                });
                            }
                        });
                });
        });
    });
</script>

{{-- SSLCommerz embed script --}}
<script>
    var scJsHost = (("https:" == document.location.protocol) ? "https://securepay.sslcommerz.com" : "http://sandbox.sslcommerz.com");
    document.write(unescape("%3Cscript src='" + scJsHost + "/embed.min.js' type='text/javascript'%3E%3C/script%3E"));
</script>

@endsection
