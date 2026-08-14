@props(['product'])

@php
    $id = is_object($product) ? ($product->id ?? 1) : ($product['id'] ?? 1);
    $name = is_object($product) ? ($product->product_name ?? 'Flagship Tech Item') : ($product['product_name'] ?? 'Flagship Tech Item');
    $regularPrice = is_object($product) ? ($product->regular_price ?? 199.99) : ($product['regular_price'] ?? 199.99);
    $salePrice = is_object($product) ? ($product->sale_price ?? 179.99) : ($product['sale_price'] ?? 179.99);
    $imageName = is_object($product) ? ($product->product_img ?? 'sp1.jpg') : ($product['product_img'] ?? 'sp1.jpg');
    $categoryName = is_object($product) ? ($product->category->cate_name ?? 'Electronics') : 'Electronics';
    
    // Calculate discount percentage
    $discount = 0;
    if ($regularPrice > 0 && $salePrice > 0 && $salePrice < $regularPrice) {
        $discount = round((($regularPrice - $salePrice) / $regularPrice) * 100);
    }
    
    $detailUrl = route('products.show', ['id' => $id]);
@endphp

<div class="product-card-modern product-card-gsap group">
    <!-- Discount Badge -->
    @if($discount > 0)
        <div class="absolute top-3 left-3 z-10 bg-rose-500 text-white text-xs font-bold px-2.5 py-1 rounded-lg shadow-sm">
            -{{ $discount }}% OFF
        </div>
    @endif

    <!-- Wishlist Button -->
    <form action="{{ route('wishlist.toggle', ['id' => $id]) }}" method="POST" class="absolute top-3 right-3 z-30">
        @csrf
        <button type="submit" aria-label="Add to Wishlist" class="w-9 h-9 rounded-full bg-white/90 shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-white transition-all transform hover:scale-110 cursor-pointer">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </button>
    </form>

    <!-- Product Image Wrapper with Lazy Loading -->
    <div class="product-image-wrapper">
        <img src="{{ asset('images/' . $imageName) }}" alt="{{ $name }}" loading="lazy" width="220" height="220" class="object-contain" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />

        <!-- Desktop Hover Action Overlay -->
        <div class="product-overlay">
            <a href="{{ route('checkout.index') }}" class="w-full text-center py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg transition-transform transform hover:scale-102">
                BUY NOW
            </a>
            <a href="{{ $detailUrl }}" class="w-full text-center py-2.5 px-4 bg-white/95 hover:bg-white text-slate-800 font-bold text-xs uppercase tracking-wider rounded-xl shadow-md border border-slate-200 transition-transform transform hover:scale-102">
                VIEW DETAILS
            </a>
        </div>
    </div>

    <!-- Product Info -->
    <div class="flex flex-col gap-1.5 flex-grow px-1">
        <span class="text-xs font-semibold uppercase tracking-wider text-blue-600">{{ $categoryName }}</span>
        <a href="{{ $detailUrl }}" class="font-bold text-slate-800 text-base line-clamp-2 hover:text-blue-600 transition-colors">
            {{ $name }}
        </a>

        <!-- Price -->
        <div class="flex items-baseline gap-2 mt-1">
            @if($salePrice > 0 && $salePrice < $regularPrice)
                <span class="text-lg font-extrabold text-blue-600">${{ number_format($salePrice, 2) }}</span>
                <span class="text-xs text-slate-400 line-through">${{ number_format($regularPrice, 2) }}</span>
            @else
                <span class="text-lg font-extrabold text-slate-900">${{ number_format($regularPrice, 2) }}</span>
            @endif
        </div>
    </div>

    <!-- Mobile Action Buttons (Visible always on small screens) -->
    <div class="flex md:hidden items-center gap-2 mt-4 pt-3 border-t border-slate-100">
        <form action="{{ route('cart.add', ['id' => $id]) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" class="w-full py-2 bg-blue-600 text-white font-bold text-xs uppercase rounded-lg">
                BUY NOW
            </button>
        </form>
        <a href="{{ $detailUrl }}" class="flex-1 text-center py-2 bg-slate-100 text-slate-800 font-bold text-xs uppercase rounded-lg border border-slate-200">
            DETAILS
        </a>
    </div>
</div>
