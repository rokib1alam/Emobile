@props(['orders'])
<div class="card">
    <div class="card-header">
        <h3>Orders</h3>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    @php
                        switch(strtolower($order->status)) {
                            case 'completed':
                                $statusClass = 'badge bg-success';
                                break;
                            case 'pending':
                                $statusClass = 'badge bg-warning text-dark';
                                break;
                            case 'cancelled':
                            case 'failed':
                                $statusClass = 'badge bg-danger';
                                break;
                            case 'processing':
                                $statusClass = 'badge bg-info text-white';
                                break;
                            default:
                                $statusClass = 'badge bg-secondary';
                        }
                        $itemsCount = $order->items->sum('quantity') ?? 1;
                    @endphp
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('F d, Y') }}</td>
                        <td><span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ $setting->currency }}{{ number_format($order->amount, 2) }} for {{ $itemsCount }} item{{ $itemsCount > 1 ? 's' : '' }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-fill-out btn-sm">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>


