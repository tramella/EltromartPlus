@extends('layouts.app')

@php
    $imgName = $product->product_img ?? 'sp1.jpg';
    $cloudinaryBase = config('services.cloudinary.url', env('CLOUDINARY_IMAGE_URL', 'https://res.cloudinary.com/dalrsrbw0/image/upload/v1786957890/'));
    $imgUrl = !empty($cloudinaryBase) ? rtrim($cloudinaryBase, '/') . '/' . ltrim($imgName, '/') : asset('images/' . $imgName);
@endphp

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4">
    <!-- Breadcrumb Navigation -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 font-medium">
        <a href="{{ route('main') }}" class="hover:text-blue-600 transition-colors">Home</a>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
        <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">Products</a>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
        <span class="text-slate-800 font-bold truncate max-w-xs">{{ $product->product_name }}</span>
    </nav>

    <!-- Main Product Details Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-100 shadow-xl grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
        <!-- Product Image Gallery View with Clean White Background -->
        <div class="relative w-full h-[320px] sm:h-[420px] rounded-2xl bg-white border border-slate-100 flex items-center justify-center p-6 overflow-hidden group shadow-xs">
            <img src="{{ $imgUrl }}" 
                 alt="{{ $product->product_name }}"
                 class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover:scale-105" 
                 onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
            
            @if(($product->sale_price ?? 0) > 0 && ($product->sale_price < $product->regular_price))
                @php
                    $discount = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
                @endphp
                <div class="absolute top-4 left-4 bg-rose-500 text-white font-black text-xs px-3 py-1.5 rounded-xl shadow-md uppercase tracking-wider">
                    -{{ $discount }}% OFF
                </div>
            @endif
        </div>

        <!-- Product Information & Order Actions -->
        <div class="space-y-6 flex flex-col justify-between">
            <div class="space-y-4">
                <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 font-bold text-xs rounded-full uppercase tracking-wider">
                    {{ $product->category->cate_name ?? 'Electronics' }}
                </span>
                
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug">
                    {{ $product->product_name }}
                </h1>

                <!-- Price Section -->
                <div class="flex items-baseline gap-3">
                    @if(($product->sale_price ?? 0) > 0 && ($product->sale_price < $product->regular_price))
                        <span class="text-3xl font-black text-blue-600">${{ number_format($product->sale_price, 2) }}</span>
                        <span class="text-base text-slate-400 line-through">${{ number_format($product->regular_price, 2) }}</span>
                    @else
                        <span class="text-3xl font-black text-slate-900">${{ number_format($product->regular_price ?? 0, 2) }}</span>
                    @endif
                </div>

                <!-- Stock Indicator -->
                <div class="flex items-center gap-2 text-xs">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-emerald-700 font-bold bg-emerald-50 px-2.5 py-1 rounded-lg">
                        In Stock ({{ $product->quantity ?? 15 }} units left)
                    </span>
                </div>
            </div>

            <!-- Controls: Quantity & Color -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 py-4 border-y border-slate-100">
                <!-- Quantity Control -->
                <div class="space-y-2">
                    <label for="quantity-selector" class="text-xs font-bold uppercase tracking-wider text-slate-500">Select Quantity</label>
                    <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden bg-slate-50 w-full sm:w-36 h-11">
                        <button type="button" class="minus w-10 h-full flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold text-base transition-colors cursor-pointer" aria-label="Decrease quantity">-</button>
                        <input type="number" id="quantity-selector" data-max="{{ $product->quantity ?? 99 }}" value="1" min="1" class="w-16 h-full text-center bg-transparent border-0 font-bold text-slate-800 text-sm focus:ring-0 focus:outline-none" />
                        <button type="button" class="plus w-10 h-full flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold text-base transition-colors cursor-pointer" aria-label="Increase quantity">+</button>
                    </div>
                </div>

                <!-- Color Selection -->
                <div class="space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">Available Color</span>
                    <div class="flex items-center gap-2 h-11">
                        <span class="w-8 h-8 rounded-full border-2 border-slate-200 shadow-sm inline-block" style="background-color: {{ $product->color->hex_code ?? '#1e293b' }};"></span>
                        <span class="text-xs font-semibold text-slate-700">{{ $product->color->color_name ?? 'Default Edition' }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons Group -->
            <div class="flex flex-col sm:flex-row items-stretch gap-3 pt-2">
                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="quantity" id="quantity-input" value="1" />
                    <button type="submit" class="w-full h-12 px-5 rounded-2xl font-bold text-xs uppercase tracking-wider text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow-lg shadow-blue-500/25 transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-cart-shopping text-sm"></i>
                        <span>Add to Cart</span>
                    </button>
                </form>

                <!-- Buy Now Button -->
                <a href="{{ route('checkout.index') }}" class="flex-1 h-12 px-5 rounded-2xl font-bold text-xs uppercase tracking-wider text-white bg-slate-900 hover:bg-slate-800 active:bg-black shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-bolt text-sm text-yellow-400"></i>
                    <span>Buy Now</span>
                </a>

                <!-- Wishlist Form -->
                <form action="{{ route('wishlist.toggle', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <button type="submit" aria-label="Add to Wishlist" class="h-12 w-12 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-rose-500 border border-slate-200 transition-all flex items-center justify-center shrink-0 cursor-pointer">
                        <i class="fa-solid fa-heart text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
