@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-12 px-4">
    <form method="POST" action="{{ route('register.store') }}" class="form-signin w-full max-w-[640px] bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-xl space-y-6">
        @csrf

        <div class="text-center space-y-2">
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">Sign Up For Your Account</h2>
            <p class="text-slate-500 text-sm">Please register below to create a new EltromartPlus account</p>
        </div>

        <!-- First Name & Last Name Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                    <label for="firstname">First Name <span class="force text-rose-500">*</span></label>
                </div>
                <input id="firstname" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                       type="text" name="firstname" value="{{ old('firstname') }}" required autofocus autocomplete="given-name" placeholder="First Name..." />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2 text-rose-600 text-xs" />
            </div>

            <div class="space-y-2">
                <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                    <label for="lastname">Last Name <span class="force text-rose-500">*</span></label>
                </div>
                <input id="lastname" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                       type="text" name="lastname" value="{{ old('lastname') }}" required autocomplete="family-name" placeholder="Last Name..." />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2 text-rose-600 text-xs" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                <label for="email">Your Email Address <span class="force text-rose-500">*</span></label>
            </div>
            <input id="email" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                   type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                <label for="password">Your Password <span class="force text-rose-500">*</span></label>
            </div>
            <input id="password" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                   type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password..." />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <div class="Label flex items-center justify-between text-sm font-bold text-slate-700">
                <label for="password_confirmation">Confirm Password <span class="force text-rose-500">*</span></label>
            </div>
            <input id="password_confirmation" class="input-form w-full px-5 py-3.5 rounded-full border border-slate-300 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                   type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password..." />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Actions -->
        <div class="flex flex-col items-center gap-3 pt-4">
            <button type="submit" class="btn-create w-full py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold text-base rounded-full shadow-lg shadow-blue-500/25 transition-all cursor-pointer">
                Create Account
            </button>

            <a class="mt-2 text-xs font-semibold text-slate-600 hover:text-blue-600 transition-colors" href="{{ route('login') }}">
                {{ __('Already registered? Sign In') }}
            </a>
        </div>
    </form>
</div>
@endsection
