@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-12 px-4">
    <form method="POST" action="{{ route('login') }}" class="form-signin w-full max-w-[640px] bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-xl space-y-6">
        @csrf

        <div class="text-center space-y-2">
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">Sign In Your Account</h2>
            <p class="text-slate-500 text-sm">Welcome back! Please enter your details to access your account.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <div class="space-y-2">
            <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                <label for="email">Email Address <span class="force text-rose-500">*</span></label>
            </div>
            <input id="email" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                   type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email address..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                <label for="password">Password <span class="force text-rose-500">*</span></label>
            </div>
            <input id="password" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                   type="password" name="password" required autocomplete="current-password" placeholder="Enter your password..." />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" name="remember">
                <span class="ml-2 text-xs font-medium text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex flex-col items-center gap-3 pt-4">
            <button type="submit" class="btn-create w-full py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold text-base rounded-full shadow-lg shadow-blue-500/25 transition-all cursor-pointer">
                Login
            </button>

            <a class="btn-create-new w-full py-3.5 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-full border border-slate-300 text-center transition-all cursor-pointer" href="{{ route('register') }}">
                {{ __('Create Account') }}
            </a>
        </div>
    </form>
</div>
@endsection
