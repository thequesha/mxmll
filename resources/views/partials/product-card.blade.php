@php
    $imagePath = $product->image ?: null;
    // if ($imagePath && strpos($imagePath, 'products/') !== 0) {
    //     $imagePath = 'products/' . ltrim($imagePath, '/');
    // }
    $imgUrl = $imagePath ? asset($imagePath) : asset('placeholder.png');
@endphp
<div class="card h-100">
    <a href="{{ route('product.show', $product) }}" class="text-decoration-none text-body">
        <div class="ratio-box">
            <img src="{{ $imgUrl }}" class="card-img-top" alt="{{ $product->name }}">
        </div>
        <div class="card-body">
            <div class="product-title mb-2">{{ $product->name }}</div>
            <div class="font-weight-bold">{{ $product->price_formatted }}</div>
        </div>
    </a>
    <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
        <button type="button" class="btn btn-sm btn-primary btn-block btn-add-to-cart"
            aria-label="Добавить в корзину (не активно)">В корзину</button>
    </div>
</div>
