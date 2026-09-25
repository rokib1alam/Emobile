<div class="tab-pane fade active show" id="address" role="tabpanel" aria-labelledby="address-tab">
    <div class="row">
        <!-- Billing Address -->
        <div class="col-lg-6">
            <div class="card mb-3 mb-lg-0">
                <div class="card-header">
                    <h3>Billing Address</h3>
                </div>
                <div class="card-body">
                    <address>
                        Address: {{ $user->address_details ?? 'Not set' }}<br>
                        Division : {{ $user->division ?? '' }} <br>
                        District : {{ $user->district ?? '' }} <br>
                        Upazila : {{ $user->upazila ?? '' }} <br>
                        Union : {{ $user->union ?? '' }} <br>
                        Postcode : {{ $user->postcode ?? '' }}
                    </address>

                    <p>Bangladesh</p>
                    {{-- <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-fill-out">Edit</a> --}}
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Shipping Address</h3>
                </div>
                <div class="card-body">
                    <address>
                        Address: {{ $user->address_details ?? 'Not set' }}<br>
                        Division : {{ $user->division ?? '' }} <br>
                        District : {{ $user->district ?? '' }} <br>
                        Upazila : {{ $user->upazila ?? '' }} <br>
                        Union : {{ $user->union ?? '' }} <br>
                        Postcode : {{ $user->postcode ?? '' }}
                    </address>
                    <p>Bangladesh</p>
                    {{-- <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-fill-out">Edit</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
