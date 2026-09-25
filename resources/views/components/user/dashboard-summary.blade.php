<div class="card mb-4">
    <div class="card-header">
        <h3>Welcome, {{ Auth::user()->first_name }}!</h3>
        <small>Here is a quick summary of your account activity.</small>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <!-- Orders -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 text-white rounded" style="background-color: #28c76f;">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti-shopping-cart-full fa-2x"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $ordersCount ?? 0 }}</h4>
                            <small>Total Orders</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 text-white rounded" style="background-color: #ea5455;">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti-heart fa-2x"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $wishlistCount ?? 0 }}</h4>
                            <small>Items in Wishlist</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 text-white rounded" style="background-color: #5a8dee;">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti-comments fa-2x"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $messagesCount ?? 0 }}</h4>
                            <small>Support Messages</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Return Requests -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 text-white rounded" style="background-color: #ff9f43;">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti-reload fa-2x"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $returnsCount ?? 0 }}</h4>
                            <small>Return Requests</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 text-white rounded" style="background-color: #7367f0;">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti-bell fa-2x"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $notificationsCount ?? 0 }}</h4>
                            <small>New Notifications</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Views (Optional) -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 text-white rounded" style="background-color: #00cfe8;">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti-eye fa-2x"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">—</h4>
                            <small>Profile Views</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
