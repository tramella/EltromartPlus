@extends('layouts.app')

@section('content')
<div class="space-y-8 py-4">

    <!-- Page Title -->
    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Wishlist</h1>
            <p class="text-xs text-slate-500">Saved items you are interested in purchasing.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-modern-secondary text-xs py-2.5 px-4">
            <i class="fa-solid fa-store mr-1.5"></i> Browse Products
        </a>
    </div>

    @if(empty($wishlistItems))
        <!-- Empty Wishlist View -->
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm max-w-xl mx-auto space-y-4">
            <div class="w-20 h-20 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto text-3xl">
                <i class="fa-regular fa-heart"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800">Your Wishlist is Empty</h3>
            <p class="text-slate-500 text-sm">Save products you love by clicking the heart icon on any product card.</p>
            <div class="pt-2">
                <a href="{{ route('products.index') }}" class="btn-modern-primary py-3 px-8 text-sm">
                    Discover Tech Products
                </a>
            </div>
        </div>
    @else
        <!-- Wishlist Items Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-lg transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="relative w-full h-48 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-4">
                            <img src="{{ asset('images/' . ($item['image'] ?? 'sp1.jpg')) }}" alt="{{ $item['name'] }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                            
                            <form action="{{ route('wishlist.toggle', ['id' => $item['id']]) }}" method="POST" class="absolute top-2 right-2">
                                @csrf
                                <button type="submit" class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-colors">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-0.5 rounded-md">
                                {{ $item['status'] ?? 'In Stock' }}
                            </span>
                            <h4 class="font-bold text-slate-800 text-base line-clamp-1">
                                <a href="{{ route('products.show', ['id' => $item['id']]) }}" class="hover:text-blue-600">
                                    {{ $item['name'] }}
                                </a>
                            </h4>
                            <div class="flex items-baseline gap-2">
                                @if(isset($item['regular_price']) && $item['regular_price'] > $item['price'])
                                    <span class="text-lg font-extrabold text-blue-600">${{ number_format($item['price'], 2) }}</span>
                                    <span class="text-xs text-slate-400 line-through">${{ number_format($item['regular_price'], 2) }}</span>
                                @else
                                    <span class="text-lg font-extrabold text-slate-900">${{ number_format($item['price'], 2) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-4 border-t border-slate-100 mt-4">
                        <form action="{{ route('cart.add', ['id' => $item['id']]) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="btn-modern-primary w-full text-xs py-2.5">
                                Add to Cart
                            </button>
                        </form>
                        <a href="{{ route('products.show', ['id' => $item['id']]) }}" class="btn-modern-secondary text-xs py-2.5 px-3">
                            Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
