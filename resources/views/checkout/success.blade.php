@extends('layouts.app')

@section('content')
<div class="py-12 max-w-2xl mx-auto">

    <div class="bg-white rounded-3xl p-8 sm:p-12 text-center border border-slate-100 shadow-xl space-y-6">
        <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto text-4xl animate-bounce">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="space-y-2">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Order Placed Successfully!</h1>
            <p class="text-slate-500 text-sm">Thank you for your purchase from EltromartPlus.</p>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs text-slate-600 space-y-2">
            <div class="flex justify-between">
                <span>Order Reference:</span>
                <strong class="text-slate-900 font-mono text-sm">#ORD-{{ sprintf('%06d', $orderId ?? rand(100, 999)) }}</strong>
            </div>
            <div class="flex justify-between">
                <span>Selected Payment Method:</span>
                <strong class="text-blue-600 font-semibold">{{ session('payment_method', 'Cash on Delivery / Direct') }}</strong>
            </div>
            <div class="flex justify-between">
                <span>Order Status:</span>
                <span class="text-amber-700 bg-amber-50 font-bold px-2 py-0.5 rounded-md">Pending Verification</span>
            </div>
        </div>

        <p class="text-xs text-slate-400">
            A confirmation receipt will be sent to your registered email address.
        </p>

        <div class="pt-2 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('products.index') }}" class="btn-modern-primary py-3 px-8 text-sm">
                Continue Shopping
            </a>
            <a href="{{ route('main') }}" class="btn-modern-secondary py-3 px-8 text-sm">
                Back to Home
            </a>
        </div>
    </div>

</div>
@endsection
