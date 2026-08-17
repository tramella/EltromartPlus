@props(['product'])

@php
    $id = is_object($product) ? ($product->id ?? 1) : ($product['id'] ?? 1);
    $name = is_object($product) ? ($product->product_name ?? 'Flagship Tech Item') : ($product['product_name'] ?? 'Flagship Tech Item');
    $regularPrice = is_object($product) ? ($product->regular_price ?? 199.99) : ($product['regular_price'] ?? 199.99);
    $salePrice = is_object($product) ? ($product->sale_price ?? 179.99) : ($product['sale_price'] ?? 179.99);
    $imageName = is_object($product) ? ($product->product_img ?? 'sp1.jpg') : ($product['product_img'] ?? 'sp1.jpg');
    $categoryName = is_object($product) ? ($product->category->cate_name ?? 'Electronics') : 'Electronics';
    
    // Resolve full Cloudinary image URL from environment settings with local asset fallback
    $cloudinaryBase = config('services.cloudinary.url', env('CLOUDINARY_IMAGE_URL', 'https://res.cloudinary.com/dalrsrbw0/image/upload/v1786957890/'));
    $imageUrl = !empty($cloudinaryBase) ? rtrim($cloudinaryBase, '/') . '/' . ltrim($imageName, '/') : asset('images/' . $imageName);

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
        <div class="absolute top-3 left-3 z-10 bg-rose-500 text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-sm">
            -{{ $discount }}% OFF
        </div>
    @endif

    <!-- Wishlist Toggle Button -->
    <form action="{{ route('wishlist.toggle', ['id' => $id]) }}" method="POST" class="absolute top-3 right-3 z-30">
        @csrf
        <button type="submit" aria-label="Add to Wishlist" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-slate-100/90 hover:bg-white shadow-xs border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-500 transition-all transform hover:scale-110 cursor-pointer">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </button>
    </form>

    <!-- Clean White Product Image Wrapper -->
    <div class="product-image-wrapper bg-white">
        <a href="{{ $detailUrl }}" class="w-full h-full flex items-center justify-center">
            <img src="{{ $imageUrl }}" alt="{{ $name }}" loading="lazy" width="220" height="220" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
        </a>
    </div>

    <!-- Product Meta Info -->
    <div class="flex flex-col gap-1 flex-grow px-1">
        <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">{{ $categoryName }}</span>
        <h3 class="font-bold text-slate-800 text-sm sm:text-base line-clamp-2 hover:text-blue-600 transition-colors">
            <a href="{{ $detailUrl }}">{{ $name }}</a>
        </h3>

        <!-- Price Section -->
        <div class="flex items-baseline gap-2 mt-1">
            @if($salePrice > 0 && $salePrice < $regularPrice)
                <span class="text-base sm:text-lg font-extrabold text-blue-600">${{ number_format($salePrice, 2) }}</span>
                <span class="text-xs text-slate-400 line-through">${{ number_format($regularPrice, 2) }}</span>
            @else
                <span class="text-base sm:text-lg font-extrabold text-slate-900">${{ number_format($regularPrice, 2) }}</span>
            @endif
        </div>
    </div>

    <!-- Unified Action Buttons Bar -->
    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
        <form action="{{ route('cart.add', ['id' => $id]) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" class="w-full py-2 px-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-xs cursor-pointer transition-colors text-center">
                BUY NOW
            </button>
        </form>
        <a href="{{ $detailUrl }}" class="flex-1 text-center py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs uppercase tracking-wider rounded-xl border border-slate-200 transition-colors">
            DETAILS
        </a>
    </div>
</div>
