@extends('layouts.app')

@section('content')
<div class="space-y-8 py-4">

    <!-- Page Header -->
    <div class="border-b border-slate-200 pb-4">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Checkout</h1>
        <p class="text-xs text-slate-500">Provide shipping details and select your preferred payment method.</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Left 2 Cols: Customer Info & Payment Method -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Customer & Shipping Form -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 shadow-sm space-y-6">
                <h3 class="font-extrabold text-slate-900 text-lg border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-truck-ramp-box text-blue-600"></i> Shipping & Contact Details
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-600">Full Name</label>
                        <input type="text" name="name" required value="{{ old('name', $user->name ?? 'John Doe') }}" class="input-modern" placeholder="Enter your full name..." />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-600">Email Address</label>
                        <input type="email" name="email" required value="{{ old('email', $user->email ?? 'john.doe@example.com') }}" class="input-modern" placeholder="Enter your email address..." />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-600">Phone Number</label>
                        <input type="text" name="phone" required value="{{ old('phone', '+1 (555) 019-2834') }}" class="input-modern" placeholder="Enter phone number..." />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-600">City / Region</label>
                        <input type="text" name="city" required value="San Francisco, CA" class="input-modern" />
                    </div>

                    <div class="sm:col-span-2 space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-600">Delivery Address</label>
                        <input type="text" name="address" required value="{{ old('address', '685 Market Street, Suite 400') }}" class="input-modern" placeholder="Street address, apartment, suite..." />
                    </div>
                </div>
            </div>

            <!-- Payment Method Selection UI -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 shadow-sm space-y-6" x-data="{ method: 'cod' }">
                <h3 class="font-extrabold text-slate-900 text-lg border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-credit-card text-blue-600"></i> Payment Selection
                </h3>

                <p class="text-xs text-slate-500">
                    Select how you would like to handle payment. Orders are submitted with a pending payment status until backend verification.
                </p>

                <div class="space-y-3">
                    <!-- Option 1: Cash on Delivery (COD) -->
                    <label @click="method = 'cod'" class="flex items-center justify-between p-4 rounded-2xl border-2 transition-all cursor-pointer" :class="method === 'cod' ? 'border-blue-600 bg-blue-50/50' : 'border-slate-100 bg-slate-50 hover:bg-slate-100'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment_method" value="COD" x-model="method" class="text-blue-600 focus:ring-blue-500" />
                            <div>
                                <strong class="text-slate-800 text-sm block">Cash on Delivery (COD)</strong>
                                <span class="text-xs text-slate-500">Pay with cash upon package arrival</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-money-bill-wave text-emerald-600 text-xl"></i>
                    </label>

                    <!-- Option 2: Credit / Debit Card -->
                    <label @click="method = 'card'" class="flex items-center justify-between p-4 rounded-2xl border-2 transition-all cursor-pointer" :class="method === 'card' ? 'border-blue-600 bg-blue-50/50' : 'border-slate-100 bg-slate-50 hover:bg-slate-100'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment_method" value="Credit Card" x-model="method" class="text-blue-600 focus:ring-blue-500" />
                            <div>
                                <strong class="text-slate-800 text-sm block">Credit / Debit Card</strong>
                                <span class="text-xs text-slate-500">Visa, Mastercard, American Express</span>
                            </div>
                        </div>
                        <i class="fa-brands fa-cc-visa text-blue-600 text-xl"></i>
                    </label>

                    <!-- Card Details Drawer (Simulated UI) -->
                    <div x-show="method === 'card'" x-cloak class="p-4 rounded-2xl bg-slate-100 border border-slate-200 space-y-3 text-xs">
                        <span class="text-slate-500 block font-medium">Card information will be securely verified by backend integration.</span>
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" placeholder="Card Number (4532...)" class="input-modern bg-white text-xs col-span-2" />
                            <input type="text" placeholder="MM/YY" class="input-modern bg-white text-xs" />
                            <input type="text" placeholder="CVC" class="input-modern bg-white text-xs" />
                        </div>
                    </div>

                    <!-- Option 3: Direct Bank Transfer -->
                    <label @click="method = 'bank'" class="flex items-center justify-between p-4 rounded-2xl border-2 transition-all cursor-pointer" :class="method === 'bank' ? 'border-blue-600 bg-blue-50/50' : 'border-slate-100 bg-slate-50 hover:bg-slate-100'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment_method" value="Bank Transfer" x-model="method" class="text-blue-600 focus:ring-blue-500" />
                            <div>
                                <strong class="text-slate-800 text-sm block">Direct Bank Wire Transfer</strong>
                                <span class="text-xs text-slate-500">Transfer payment via electronic banking</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-building-columns text-slate-600 text-xl"></i>
                    </label>

                    <!-- Option 4: E-Wallet -->
                    <label @click="method = 'wallet'" class="flex items-center justify-between p-4 rounded-2xl border-2 transition-all cursor-pointer" :class="method === 'wallet' ? 'border-blue-600 bg-blue-50/50' : 'border-slate-100 bg-slate-50 hover:bg-slate-100'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment_method" value="Online Wallet" x-model="method" class="text-blue-600 focus:ring-blue-500" />
                            <div>
                                <strong class="text-slate-800 text-sm block">Electronic Wallet (PayPal / Momo / VNPAY)</strong>
                                <span class="text-xs text-slate-500">Instant digital wallet gateway redirect</span>
                            </div>
                        </div>
                        <i class="fa-brands fa-paypal text-sky-600 text-xl"></i>
                    </label>
                </div>
            </div>

        </div>

        <!-- Right 1 Col: Order Items Summary & Submit -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
                <h3 class="font-extrabold text-slate-900 text-lg border-b border-slate-100 pb-3">Order Items</h3>

                <!-- Product Items Preview -->
                <div class="space-y-3 max-h-64 overflow-y-auto pr-1">
                    @foreach($cart as $item)
                        <div class="flex items-center gap-3 text-xs">
                            <div class="w-12 h-12 rounded-lg bg-slate-50 border border-slate-100 p-1 shrink-0 flex items-center justify-center">
                                <img src="{{ asset('images/' . ($item['image'] ?? 'sp1.jpg')) }}" alt="{{ $item['name'] }}" class="max-h-full max-w-full object-contain" onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <h5 class="font-bold text-slate-800 truncate">{{ $item['name'] }}</h5>
                                <span class="text-slate-400">Qty: {{ $item['quantity'] }}</span>
                            </div>
                            <span class="font-extrabold text-slate-800 shrink-0">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Totals Breakdown -->
                <div class="space-y-2 pt-4 border-t border-slate-100 text-xs text-slate-600">
                    <div class="flex justify-between">
                        <span>Items Subtotal</span>
                        <span class="font-bold text-slate-800">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>VAT (8%)</span>
                        <span class="font-bold text-slate-800">${{ number_format($vat, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping Fee</span>
                        <span class="font-bold text-slate-800">${{ number_format($shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-slate-100 text-sm font-extrabold text-slate-900">
                        <span>Grand Total</span>
                        <span class="text-blue-600 text-xl font-black">${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <!-- Place Order Button -->
                <button type="submit" class="btn-modern-primary w-full py-4 text-sm font-bold uppercase tracking-wider shadow-lg shadow-blue-500/25">
                    Place Order Now <i class="fa-solid fa-check ml-2"></i>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
