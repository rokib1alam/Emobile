<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Order ID</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse($returns as $return)
                <tr>
                    <td>#{{ $return->id }}</td>
                    <td>#{{ $return->order_id }}</td>
                    <td>{{ $return->reason }}</td>
                    <td>{{ ucfirst($return->status) }}</td>
                    <td>{{ $return->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No return requests found.</td></tr>
            @endforelse --}}
        </tbody>
    </table>
</div>
