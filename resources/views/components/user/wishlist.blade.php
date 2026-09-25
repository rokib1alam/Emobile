<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse($wishlistItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 2) }} ৳</td>
                    <td>
                        <a href="{{ route('product.show', $item->product->slug) }}" class="btn btn-sm btn-info">View</a>
                        <form method="POST" action="{{ route('wishlist.destroy', $item->id) }}" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No items in wishlist.</td></tr>
            @endforelse --}}
        </tbody>
    </table>
</div>
