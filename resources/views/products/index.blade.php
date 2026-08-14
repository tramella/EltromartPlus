@extends('layouts.app')

@section('title', 'Browse Products & Technological Equipment | EltromartPlus')
@section('meta_description', 'Explore our comprehensive tech catalog featuring smartphones, laptops, workstations, headsets, power banks, and accessories with fast delivery.')

@section('content')
<div class="space-y-8">

    <!-- Page Header & Search Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 rounded-3xl p-8 md:p-12 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Browse Products</h1>
            <p class="text-slate-300 text-sm">Find top quality smartphones, laptops, PCs, and electronic accessories.</p>
        </div>

        <form action="{{ route('products.index') }}" method="GET" class="w-full md:w-auto flex items-center gap-2 max-w-md" role="search">
            <input type="text" name="search" placeholder="Search product name..." value="{{ request('search') }}" class="input-modern bg-slate-800 border-slate-700 text-white placeholder-slate-400" />
            <button type="submit" class="btn-modern-primary shrink-0 py-3 cursor-pointer">
                <i class="fa-solid fa-magnifying-glass mr-1"></i> Search
            </button>
        </form>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Sidebar Filters -->
        <aside class="space-y-6">
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm space-y-6">
                <h2 class="font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-filter text-blue-600"></i> Catalog Filters
                </h2>

                <!-- Category Filter -->
                <div class="space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Categories</h3>
                    <div class="space-y-1.5 text-sm">
                        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition-colors {{ !request('category') ? 'bg-blue-50 text-blue-600 font-bold' : '' }}">
                            All Categories
                        </a>
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $cat)
                                <a href="{{ route('products.index', array_merge(request()->except(['category', 'page']), ['category' => $cat->id])) }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request('category') == $cat->id ? 'bg-blue-50 text-blue-600 font-bold' : '' }}">
                                    {{ $cat->cate_name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Brand Filter -->
                <div class="space-y-3 border-t border-slate-100 pt-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Brands</h3>
                    <div class="space-y-1.5 text-sm">
                        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                            All Brands
                        </a>
                        @if(isset($brands) && count($brands) > 0)
                            @foreach($brands as $brand)
                                <a href="{{ route('products.index', array_merge(request()->except(['brand', 'page']), ['brand' => $brand->id])) }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request('brand') == $brand->id ? 'bg-blue-50 text-blue-600 font-bold' : '' }}">
                                    {{ $brand->brand_name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                @if(request()->hasAny(['category', 'brand', 'search']))
                    <a href="{{ route('products.index') }}" class="btn-modern-secondary w-full text-xs text-center py-2.5 mt-2">
                        Reset Filters
                    </a>
                @endif
            </div>
        </aside>

        <!-- Products Grid -->
        <main class="lg:col-span-3 space-y-6">
            @if(isset($products) && $products->count() > 0)
                <div class="product-grid-container grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $prod)
                        <x-product-card :product="$prod" />
                    @endforeach
                </div>

                <!-- Redesigned Custom Laravel Pagination -->
                <div class="pt-6">
                    {{ $products->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm space-y-4">
                    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">No Products Found</h2>
                    <p class="text-slate-500 text-sm">No products match your active search or filter criteria.</p>
                    <a href="{{ route('products.index') }}" class="btn-modern-primary py-2.5 px-6 text-xs inline-block">
                        Clear Filters
                    </a>
                </div>
            @endif
        </main>

    </div>
</div>
@endsection
