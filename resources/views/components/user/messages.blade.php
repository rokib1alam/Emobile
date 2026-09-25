<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Received</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse($messages as $message)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->status }}</td>
                    <td>{{ $message->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-info">View</a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No messages found.</td></tr>
            @endforelse --}}
        </tbody>
    </table>
</div>
