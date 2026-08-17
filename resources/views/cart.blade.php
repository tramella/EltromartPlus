@extends('layouts.app')

@php
    $total = 0;
@endphp

@section('content')
    <div class="w-full p-5 flex flex-col justify-center items-center">
        <div class="title-cart my-5 font-bold text-2xl text-slate-800">Your Cart</div>

        @if (isset($message) && $message)
            <div class="w-full flex flex-col justify-center items-center">
                <div class="w-message-cart">
                    <div class="w-full flex justify-center items-center gap-2">
                        <i class="fa-solid fa-circle-info icon-infocart text-blue-600"></i>
                        <p class="text-center text-sm text-slate-600">Special promotional price active on your cart items!</p>
                    </div>
                </div>
                <div class="info-cart my-2 text-sm text-slate-700 font-semibold">{{ $message }}</div>
                <a href="{{ route('main') }}" class="btn-modern-primary py-2.5 px-6 text-xs mt-4">Continue Shopping</a>
            </div>
        @else
            <div class="w-full max-w-5xl bg-white rounded-3xl p-6 border border-slate-100 shadow-sm overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-700">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500">
                        <tr>
                            <th class="py-3 px-4 text-center">#</th>
                            <th class="py-3 px-4 text-center">Image</th>
                            <th class="py-3 px-4">Product Name</th>
                            <th class="py-3 px-4 text-center">Unit Price</th>
                            <th class="py-3 px-4 text-center">Quantity</th>
                            <th class="py-3 px-4 text-right">Total Price</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($cartItems as $index => $w)
                            @php
                                $productPrice = $w->product->sale_price ?? $w->product->regular_price ?? 0;
                                $itemTotal = $w->quantity * $productPrice;
                                $total += $itemTotal;
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-4 px-4 text-center font-bold text-slate-400">{{ $loop->iteration }}</td>

                                <!-- Product Image -->
                                <td class="py-4 px-4 text-center">
                                    <div class="w-14 h-14 rounded-xl bg-slate-50 border border-slate-100 p-1 mx-auto flex items-center justify-center">
                                        <img src="{{ asset('images/productimg_rbg/' . ($w->product->product_img ?? 'sp1.jpg')) }}"
                                             alt="{{ $w->product->product_name ?? 'Product' }}"
                                             class="max-h-full max-w-full object-contain"
                                             onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                                    </div>
                                </td>

                                <!-- Product Name -->
                                <td class="py-4 px-4 font-bold text-slate-800">
                                    {{ $w->product->product_name ?? 'Item' }}
                                </td>

                                <!-- Price -->
                                <td class="py-4 px-4 text-center font-semibold text-slate-700">
                                    ${{ number_format($productPrice, 2) }}
                                </td>

                                <!-- Symmetrical Quantity Pill Display -->
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-xl bg-slate-100 border border-slate-200 font-extrabold text-xs text-slate-800">
                                        {{ $w->quantity }}
                                    </span>
                                </td>

                                <!-- Total Price -->
                                <td class="py-4 px-4 text-right font-extrabold text-blue-600">
                                    ${{ number_format($itemTotal, 2) }}
                                </td>

                                <!-- Delete Form -->
                                <td class="py-4 px-4 text-center">
                                    <form action="{{ route('cart.remove', ['id' => $w->product_id]) }}" method="POST" class="delete-form inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" aria-label="Remove item" class="btn-delete text-rose-500 hover:text-rose-700 p-2 cursor-pointer transition-colors">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Summary & Checkout Bar -->
            <div class="w-full max-w-5xl flex flex-col sm:flex-row justify-between items-center bg-white rounded-3xl p-6 border border-slate-100 shadow-sm mt-6 gap-4">
                <div class="text-slate-600 font-semibold text-sm">
                    Sub Total: <strong class="text-2xl font-black text-blue-600 ml-2">${{ number_format($total, 2) }}</strong>
                </div>

                <form action="{{ route('checktopay') }}" method="POST">
                    @csrf
                    @foreach ($cartItems as $w)
                        <input type="hidden" name="cart[{{ $w->product_id }}][img]" value="{{ $w->product->product_img ?? '' }}">
                        <input type="hidden" name="cart[{{ $w->product_id }}][name]" value="{{ $w->product->product_name ?? '' }}">
                        <input type="hidden" name="cart[{{ $w->product_id }}][quantity]" value="{{ $w->quantity }}">
                        <input type="hidden" name="cart[{{ $w->product_id }}][price]" value="{{ $w->product->sale_price ?? $w->product->regular_price ?? 0 }}">
                    @endforeach
                    <input type="hidden" name="total" value="{{ $total }}">

                    <button type="submit" class="btn-modern-primary py-3 px-8 text-xs font-bold uppercase tracking-wider">
                        Proceed to Payment <i class="fa-solid fa-arrow-right ml-1.5"></i>
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
