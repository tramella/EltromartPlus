@extends('layouts.app')

@php
    $id = is_object($product) ? ($product->id ?? 1) : 1;
    $name = is_object($product) ? ($product->product_name ?? 'Flagship Tech Device') : 'Flagship Tech Device';
    $regularPrice = is_object($product) ? ($product->regular_price ?? 199.99) : 199.99;
    $salePrice = is_object($product) ? ($product->sale_price ?? 179.99) : 179.99;
    $effectivePrice = ($salePrice > 0 && $salePrice < $regularPrice) ? $salePrice : $regularPrice;
    $imageName = is_object($product) ? ($product->product_img ?? 'sp1.jpg') : 'sp1.jpg';
    $categoryName = is_object($product) ? ($product->category->cate_name ?? 'Electronics') : 'Electronics';
    $brandName = is_object($product) ? ($product->brand->brand_name ?? 'Eltromart') : 'Eltromart';
    $description = is_object($product) ? ($product->descriptions ?? 'Experience flagship technological performance with top-grade hardware, vivid color contrast, and long-lasting durability.') : 'Experience flagship technological performance.';
    $ram = is_object($product) ? ($product->RAM ?? '8GB') : '8GB';
    $storage = is_object($product) ? ($product->storage ?? '256GB') : '256GB';
    $materials = is_object($product) ? ($product->materials ?? 'Aluminium Alloy & Glass') : 'Aluminium Alloy';
    $status = is_object($product) ? ($product->status ?? 'In Stock') : 'In Stock';
    $quantityStock = is_object($product) ? ($product->quantity ?? 15) : 15;
    $imageUrl = asset('images/' . $imageName);
@endphp

@section('title', $name . ' | EltromartPlus')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($description), 155))
@section('canonical_url', route('products.show', ['id' => $id]))

@section('og_tags')
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ route('products.show', ['id' => $id]) }}">
    <meta property="og:title" content="{{ $name }}">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($description), 155) }}">
    <meta property="og:image" content="{{ $imageUrl }}">
    <meta property="product:price:amount" content="{{ $effectivePrice }}">
    <meta property="product:price:currency" content="USD">
@endsection

@section('content')
<!-- Product Schema.org JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ e($name) }}",
  "image": [
    "{{ $imageUrl }}"
  ],
  "description": "{{ e(strip_tags($description)) }}",
  "sku": "SKU-PROD-{{ $id }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ e($brandName) }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ route('products.show', ['id' => $id]) }}",
    "priceCurrency": "USD",
    "price": "{{ $effectivePrice }}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "{{ $quantityStock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
  }
}
</script>

<div class="space-y-12 py-4">

    <!-- Breadcrumbs -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('main') }}" class="hover:text-blue-600">Home</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <a href="{{ route('products.index') }}" class="hover:text-blue-600">Products</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-slate-800 font-bold truncate max-w-xs" aria-current="page">{{ $name }}</span>
    </nav>

    <!-- Product Main Card Grid -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-100 shadow-sm grid grid-cols-1 lg:grid-cols-2 gap-10">
        
        <!-- Left: Product Image Gallery (LCP Priority Image) -->
        <div class="space-y-4" x-data="{ mainImage: '{{ $imageUrl }}' }">
            <div class="relative w-full h-[380px] sm:h-[460px] rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center p-6 overflow-hidden group">
                <img :src="mainImage" alt="{{ $name }}" fetchpriority="high" loading="eager" width="400" height="400" class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover:scale-105" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                
                @if($salePrice > 0 && $salePrice < $regularPrice)
                    <div class="absolute top-4 left-4 bg-rose-500 text-white font-bold text-xs px-3 py-1.5 rounded-xl shadow-md">
                        SALE OFF
                    </div>
                @endif
            </div>

            <!-- Image Thumbnails -->
            <div class="flex items-center gap-3 overflow-x-auto pb-2">
                <button @click="mainImage = '{{ $imageUrl }}'" aria-label="View main product image" class="w-20 h-20 rounded-xl bg-slate-50 border-2 border-blue-500 p-2 shrink-0 cursor-pointer overflow-hidden">
                    <img src="{{ $imageUrl }}" alt="{{ $name }} Thumbnail" width="80" height="80" class="w-full h-full object-contain" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                </button>
                <button @click="mainImage = '{{ asset('images/sp1.jpg') }}'" aria-label="View alternate image 1" class="w-20 h-20 rounded-xl bg-slate-50 border border-slate-200 p-2 shrink-0 cursor-pointer overflow-hidden hover:border-blue-400">
                    <img src="{{ asset('images/sp1.jpg') }}" alt="{{ $name }} Alternate 1" width="80" height="80" class="w-full h-full object-contain" />
                </button>
                <button @click="mainImage = '{{ asset('images/laptop.jpg') }}'" aria-label="View alternate image 2" class="w-20 h-20 rounded-xl bg-slate-50 border border-slate-200 p-2 shrink-0 cursor-pointer overflow-hidden hover:border-blue-400">
                    <img src="{{ asset('images/laptop.jpg') }}" alt="{{ $name }} Alternate 2" width="80" height="80" class="w-full h-full object-contain" />
                </button>
            </div>
        </div>

        <!-- Right: Product Info & Actions -->
        <div class="space-y-6 flex flex-col justify-between">
            <div class="space-y-4">
                <!-- Category & Brand Badges -->
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 font-bold text-xs rounded-full uppercase tracking-wider">
                        {{ $categoryName }}
                    </span>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Brand: <strong class="text-slate-700">{{ $brandName }}</strong>
                    </span>
                </div>

                <!-- Product Title (H1) -->
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug">
                    {{ $name }}
                </h1>

                <!-- Price Breakdown -->
                <div class="flex items-baseline gap-3">
                    @if($salePrice > 0 && $salePrice < $regularPrice)
                        <span class="text-3xl font-black text-blue-600">${{ number_format($salePrice, 2) }}</span>
                        <span class="text-lg text-slate-400 line-through">${{ number_format($regularPrice, 2) }}</span>
                        <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-lg">
                            Save ${{ number_format($regularPrice - $salePrice, 2) }}
                        </span>
                    @else
                        <span class="text-3xl font-black text-slate-900">${{ number_format($regularPrice, 2) }}</span>
                    @endif
                </div>

                <!-- Availability Status -->
                <div class="flex items-center gap-2 text-xs font-semibold">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                    <span class="text-emerald-700 font-bold bg-emerald-50 px-2.5 py-1 rounded-lg">
                        {{ $status }} ({{ $quantityStock }} units available)
                    </span>
                </div>

                <!-- Technical Specs Summary -->
                <div class="grid grid-cols-3 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs">
                    <div>
                        <span class="text-slate-400 block font-medium">RAM Memory</span>
                        <strong class="text-slate-800 font-bold text-sm">{{ $ram }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Storage Capacity</span>
                        <strong class="text-slate-800 font-bold text-sm">{{ $storage }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Build Material</span>
                        <strong class="text-slate-800 font-bold text-sm">{{ $materials }}</strong>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="space-y-2">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400">Description</h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $description }}
                    </p>
                </div>
            </div>

            <!-- Action Buttons Form -->
            <div class="space-y-4 pt-4 border-t border-slate-100" x-data="{ qty: 1 }">
                <!-- Quantity Adjustment -->
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-slate-700">Quantity:</span>
                    <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden bg-slate-50">
                        <button @click="if(qty > 1) qty--" type="button" aria-label="Decrease quantity" class="w-10 h-10 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold text-lg cursor-pointer">-</button>
                        <span class="w-12 text-center font-bold text-slate-800 text-sm" x-text="qty"></span>
                        <button @click="qty++" type="button" aria-label="Increase quantity" class="w-10 h-10 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold text-lg cursor-pointer">+</button>
                    </div>
                </div>

                <!-- Buttons Component (Visually Identical Height, Padding, Border Radius, Typography) -->
                <div class="flex flex-col sm:flex-row items-stretch gap-3">
                    <form action="{{ route('cart.add', ['id' => $id]) }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="quantity" :value="qty" />
                        <button type="submit" class="w-full h-13 px-6 rounded-2xl font-bold text-sm uppercase tracking-wider text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow-md hover:shadow-blue-500/25 transition-all flex items-center justify-center gap-2.5 cursor-pointer">
                            <i class="fa-solid fa-cart-shopping text-base"></i>
                            <span>Add to Cart</span>
                        </button>
                    </form>

                    <a href="{{ route('checkout.index') }}" class="flex-1 h-13 px-6 rounded-2xl font-bold text-sm uppercase tracking-wider text-white bg-slate-900 hover:bg-slate-800 active:bg-black shadow-md transition-all flex items-center justify-center gap-2.5 cursor-pointer">
                        <i class="fa-solid fa-bolt text-base"></i>
                        <span>Buy Now</span>
                    </a>

                    <form action="{{ route('wishlist.toggle', ['id' => $id]) }}" method="POST">
                        @csrf
                        <button type="submit" aria-label="Add to Wishlist" class="h-13 w-13 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-rose-500 border border-slate-200 transition-all flex items-center justify-center shrink-0 cursor-pointer">
                            <i class="fa-solid fa-heart text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <!-- Related Products Reveal -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
        <div class="gsap-reveal space-y-6 pt-4">
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rel)
                    <x-product-card :product="$rel" />
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
