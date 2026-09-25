@forelse($products as $product)

    @php
        $productColor = $product->colors
            ->whereNotNull('thumbnail')
            ->first();
    @endphp

    <a href="{{ url('product/'.$product->product_slug) }}"
       class="list-group-item list-group-item-action">

        <div class="d-flex align-items-center">

            @if($productColor && $productColor->thumbnail)

                <img
                    src="{{ asset($productColor->thumbnail) }}"
                    width="50"
                    height="50"
                    class="me-2"
                    alt="{{ $product->product_name }}"
                    style="object-fit: cover;"
                >

            @else

                <img
                    src="{{ asset('frontend/assets/images/no-image.png') }}"
                    width="50"
                    height="50"
                    class="me-2"
                    alt="{{ $product->product_name }}"
                    style="object-fit: cover;"
                >

            @endif

            <div>

                <strong>
                    {{ $product->product_name }}
                </strong>

                <br>

                <small>
                    {{ $product->selling_price ?? 0 }}৳
                </small>

            </div>

        </div>

    </a>

@empty

    <div class="list-group-item">
        No products found
    </div>

@endforelse