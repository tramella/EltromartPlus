@extends('layouts.app')

@section('content')
<div class="space-y-8 py-4">

    <!-- Page Title -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Shopping Cart</h1>
            <p class="text-xs text-slate-500">Review your selected technological equipment before checkout.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-modern-secondary text-xs py-2.5 px-4">
            <i class="fa-solid fa-arrow-left mr-1.5"></i> Continue Shopping
        </a>
    </div>

    @if(empty($cart))
        <!-- Empty Cart View -->
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm max-w-xl mx-auto space-y-4">
            <div class="w-20 h-20 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mx-auto text-3xl">
                <i class="fa-solid fa-cart-flatbed"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800">Your Cart is Empty</h3>
            <p class="text-slate-500 text-sm">Looks like you haven't added any products to your shopping cart yet.</p>
            <div class="pt-2">
                <a href="{{ route('products.index') }}" class="btn-modern-primary py-3 px-8 text-sm">
                    Browse Catalog
                </a>
            </div>
        </div>
    @else
        <!-- Cart Items Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Cart Table / Item List -->
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-4">
                    <div class="hidden sm:grid grid-cols-12 text-xs font-bold uppercase tracking-wider text-slate-400 pb-3 border-b border-slate-100">
                        <span class="col-span-6">Product Item</span>
                        <span class="col-span-2 text-center">Price</span>
                        <span class="col-span-2 text-center">Quantity</span>
                        <span class="col-span-2 text-right">Subtotal</span>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($cart as $id => $item)
                            <div class="py-4 grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                                <!-- Product Thumbnail & Name -->
                                <div class="sm:col-span-6 flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-100 p-2 shrink-0 flex items-center justify-center">
                                        <img src="{{ asset('images/' . ($item['image'] ?? 'sp1.jpg')) }}" alt="{{ $item['name'] }}" class="max-h-full max-w-full object-contain" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                                    </div>
                                    <div class="space-y-1">
                                        <h4 class="font-bold text-slate-800 text-sm line-clamp-1">
                                            <a href="{{ route('products.show', ['id' => $id]) }}" class="hover:text-blue-600">
                                                {{ $item['name'] }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-slate-400">Spec: {{ $item['storage'] ?? '256GB' }} | {{ $item['ram'] ?? '8GB' }}</p>
                                        
                                        <!-- Remove Item Link -->
                                        <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-xs text-rose-500 hover:text-rose-700 font-semibold cursor-pointer">
                                                <i class="fa-solid fa-trash-can mr-1"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Unit Price -->
                                <div class="sm:col-span-2 text-left sm:text-center text-sm font-semibold text-slate-700">
                                    ${{ number_format($item['price'], 2) }}
                                </div>

                                <!-- Quantity Controls -->
                                <div class="sm:col-span-2 flex justify-start sm:justify-center">
                                    <form action="{{ route('cart.update', ['id' => $id]) }}" method="POST" class="flex items-center border border-slate-200 rounded-xl overflow-hidden bg-slate-50">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" />
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-200 font-bold">-</button>
                                        <span class="w-8 text-center font-bold text-xs text-slate-800">{{ $item['quantity'] }}</span>
                                    </form>
                                    <form action="{{ route('cart.update', ['id' => $id]) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}" />
                                        <button type="submit" class="w-8 h-8 border border-l-0 border-slate-200 rounded-r-xl bg-slate-50 hover:bg-slate-200 font-bold text-slate-600">+</button>
                                    </form>
                                </div>

                                <!-- Item Subtotal -->
                                <div class="sm:col-span-2 text-left sm:text-right font-extrabold text-blue-600 text-base">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Clear Cart Action -->
                    <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-xs">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-rose-600 font-medium">
                                Clear Cart
                            </button>
                        </form>
                        <span class="text-slate-400 font-medium">{{ count($cart) }} Items in Cart</span>
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Order Summary Box -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
                    <h3 class="font-extrabold text-slate-900 text-lg border-b border-slate-100 pb-3">Order Summary</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-slate-800">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Estimated VAT (8%)</span>
                            <span class="font-bold text-slate-800">${{ number_format($vat, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Shipping Fee</span>
                            @if($shipping == 0)
                                <span class="font-bold text-emerald-600 uppercase text-xs">FREE</span>
                            @else
                                <span class="font-bold text-slate-800">${{ number_format($shipping, 2) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-between items-baseline">
                        <span class="font-extrabold text-slate-900 text-lg">Total</span>
                        <span class="font-black text-2xl text-blue-600">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-modern-primary w-full py-4 text-center text-sm font-bold uppercase tracking-wider shadow-lg shadow-blue-500/25">
                        Proceed to Checkout <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>

                    <div class="text-center text-xs text-slate-400 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-lock text-slate-400"></i>
                        <span>Guaranteed Secure Checkout</span>
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
@endsection
