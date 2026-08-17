@extends('layouts.app')

@section('title', 'EltromartPlus - Premium Technological Equipment Store')
@section('meta_description', 'Discover flagship smartphones, powerful workstations, laptops, high-performance audio gear, and electronic accessories with 24/7 support and fast delivery.')

@section('content')
<div class="space-y-14 pb-8">

    <!-- ===== 1. HERO SLIDER SECTION (LCP prioritized) ===== -->
    <div class="hero-animate relative w-full rounded-3xl overflow-hidden shadow-2xl bg-slate-900 border border-slate-800">
        <div x-data="{
            currentSlide: 0,
            slides: [
                {
                    title: 'Next-Gen Mobile Technologies',
                    subtitle: 'Unmatched performance with 5G connectivity & titanium precision.',
                    image: '{{ asset('images/sub_sildeshow.png') }}',
                    cta: 'Explore Flagship Phones',
                    link: '{{ route('products.index', ['category' => 1]) }}'
                },
                {
                    title: 'Ultra-Powerful Workstations',
                    subtitle: 'Boost your workflow with high-performance laptops and PCs.',
                    image: '{{ asset('images/slideshow3.jpg') }}',
                    cta: 'View Laptops',
                    link: '{{ route('products.index', ['category' => 2]) }}'
                },
                {
                    title: 'Premium Audio & Accessories',
                    subtitle: 'Immerse yourself in crystal clear noise-canceling sound.',
                    image: '{{ asset('images/slideshow1.jpg') }}',
                    cta: 'Shop Accessories',
                    link: '{{ route('products.index', ['category' => 3]) }}'
                }
            ],
            next() { this.currentSlide = (this.currentSlide + 1) % this.slides.length; },
            prev() { this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length; }
        }" class="relative h-[380px] sm:h-[460px] md:h-[520px] w-full">

            <!-- Slides rendered via Alpine x-for -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 w-full h-full">

                    <img :src="slide.image" :alt="slide.title" fetchpriority="high" loading="eager" width="1200" height="520"
                         class="w-full h-full object-cover object-center opacity-40"
                         onError="this.onerror=null;this.src='{{ asset('images/sub_sildeshow.png') }}';" />
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/70 to-transparent flex items-center p-8 sm:p-12 md:p-16">
                        <div class="max-w-xl space-y-4">
                            <span class="inline-block px-3 py-1 bg-blue-600/90 text-white font-bold text-xs rounded-full uppercase tracking-wider shadow-sm">
                                Exclusive Summer Deals
                            </span>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white leading-tight tracking-tight drop-shadow-md" x-text="slide.title"></h1>
                            <p class="text-slate-300 text-sm sm:text-base leading-relaxed" x-text="slide.subtitle"></p>
                            <div class="pt-2">
                                <a :href="slide.link" class="btn-modern-primary text-base py-3 px-8 rounded-2xl">
                                    <span x-text="slide.cta"></span>
                                    <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Previous slide button -->
            <button @click="prev()" aria-label="Previous Slide"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-900/60 hover:bg-blue-600 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-lg cursor-pointer">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <!-- Next slide button -->
            <button @click="next()" aria-label="Next Slide"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-900/60 hover:bg-blue-600 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-lg cursor-pointer">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Slide indicator dots -->
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index" aria-label="Go to slide"
                            class="w-3 h-3 rounded-full transition-all cursor-pointer"
                            :class="currentSlide === index ? 'bg-blue-500 w-8' : 'bg-white/40'"></button>
                </template>
            </div>
        </div>
    </div>

    <!-- ===== VALUE PROPOSITIONS BANNER ===== -->
    <div class="gsap-reveal grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="flex items-center gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition-all">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-truck-fast text-xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-base">Free Shipping &amp; Returns</h4>
                <p class="text-xs text-slate-500">Free delivery on orders over $200</p>
            </div>
        </div>

        <div class="flex items-center gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition-all">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-shield-halved text-xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-base">Lowest Price Guarantee</h4>
                <p class="text-xs text-slate-500">Match price assurance on all tech items</p>
            </div>
        </div>

        <div class="flex items-center gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition-all">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-award text-xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-base">Extended Warranty</h4>
                <p class="text-xs text-slate-500">Up to 24 months manufacturer warranty</p>
            </div>
        </div>
    </div>

    @php
        // Fetch flash sale products (products with a sale price), fallback to any products
        $flashProducts = \App\Models\Products::with(['category', 'brand'])->where('sale_price', '>', 0)->take(4)->get();
        if ($flashProducts->isEmpty()) {
            $flashProducts = \App\Models\Products::with(['category', 'brand'])->take(4)->get();
        }

        // Fetch featured/new arrival products (skip the first 4 to avoid duplicates with flash sale)
        $featuredProducts = \App\Models\Products::with(['category', 'brand'])->skip(4)->take(8)->get();
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = \App\Models\Products::with(['category', 'brand'])->take(8)->get();
        }

        // Fetch active categories and brands
        $categories = \App\Models\Categories::where('status', 1)->get();
        $brands     = \App\Models\Brands::where('status', 1)->get();

        // Maps category ID to its representative icon image
        $categoryImg = [
            1 => 'mobilephone.png',
            2 => 'Laptop.png',
            3 => 'Accessories.png',
            4 => 'iPad.png',
            5 => 'PCs.png',
            6 => 'Services.png',
        ];
    @endphp

    <!-- ===== 2. FLASH SALES SECTION ===== -->
    <div class="gsap-reveal space-y-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shadow-lg shadow-rose-500/25">
                    <i class="fa-solid fa-bolt text-lg"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">FLASH SALES</h2>
                    <p class="text-xs text-slate-500">Limited time offers with massive discounts</p>
                </div>
            </div>
            <a href="{{ route('products.index') }}" class="btn-modern-outline text-xs py-2 px-4">
                View All Deals <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="product-grid-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($flashProducts as $prod)
                <x-product-card :product="$prod" />
            @empty
                <p class="col-span-4 text-center text-slate-400 text-sm py-8">No flash sale products available right now.</p>
            @endforelse
        </div>
    </div>

    <!-- ===== 3. SHOP BY CATEGORY SECTION ===== -->
    <div class="gsap-reveal space-y-6">
        <div class="text-center max-w-xl mx-auto space-y-2">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Shop by Category</h2>
            <p class="text-slate-500 text-sm">Find top technology equipment across our curated catalog.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $cat)
                    @php
                        $img = $categoryImg[$cat->id] ?? 'mobilephone.png';
                    @endphp
                    <a href="{{ route('products.index', ['category' => $cat->id]) }}"
                       class="group flex flex-col items-center justify-center gap-3 px-4 rounded-3xl bg-blue-50 ring-1 ring-blue-100 hover:ring-2 hover:ring-blue-300 hover:shadow-lg hover:shadow-blue-100 hover:-translate-y-1 transition-all duration-300 aspect-square">

                        <!-- Category icon with solid colored background for contrast -->
                        <div class="w-12 h-12 rounded-2xl bg-blue-500 shadow-sm flex items-center justify-center group-hover:scale-110 group-hover:shadow-md transition-all duration-300">
                            <img src="{{ asset('images/' . $img) }}"
                                 alt="{{ $cat->cate_name }}"
                                 width="24" height="24"
                                 loading="lazy"
                                 class="w-6 h-6 object-contain"
                                 style="filter: brightness(0) invert(1);"
                                 onError="this.onerror=null;this.src='{{ asset('images/sp1.jpg') }}';" />
                        </div>

                        <span class="font-bold text-blue-600 group-hover:text-blue-700 text-sm text-center leading-tight transition-colors duration-300">{{ $cat->cate_name }}</span>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- ===== 4. FEATURED & NEW ARRIVALS SECTION ===== -->
    <div class="gsap-reveal space-y-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/25">
                    <i class="fa-solid fa-fire text-lg"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">FEATURED &amp; NEW ARRIVALS</h2>
                    <p class="text-xs text-slate-500">Discover our newest technological arrivals and top sellers</p>
                </div>
            </div>
            <a href="{{ route('products.index') }}" class="btn-modern-outline text-xs py-2 px-4">
                Explore Full Catalog <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="product-grid-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredProducts as $prod)
                <x-product-card :product="$prod" />
            @empty
                <p class="col-span-4 text-center text-slate-400 text-sm py-8">No featured products available right now.</p>
            @endforelse
        </div>
    </div>

    <!-- ===== 5. FEATURED BRANDS SHOWCASE ===== -->
    <div class="gsap-reveal bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-6">
        <h3 class="text-center text-xs font-bold uppercase tracking-widest text-slate-400">Featured Technology Brands</h3>
        <div class="flex flex-wrap items-center justify-around gap-6 opacity-80 grayscale hover:grayscale-0 transition-all">
            <img src="{{ asset('images/AppleLogo.jpg') }}"     alt="Apple Brand Logo"   width="100" height="40" loading="lazy" class="h-10 object-contain hover:scale-110 transition-transform" onError="this.style.display='none'" />
            <img src="{{ asset('images/Samsung-Logo-06.jpg') }}" alt="Samsung Brand Logo" width="100" height="40" loading="lazy" class="h-10 object-contain hover:scale-110 transition-transform" onError="this.style.display='none'" />
            <img src="{{ asset('images/DellLogo.jpg') }}"      alt="Dell Brand Logo"    width="100" height="40" loading="lazy" class="h-10 object-contain hover:scale-110 transition-transform" onError="this.style.display='none'" />
            <img src="{{ asset('images/LogoAsus.jpg') }}"      alt="Asus Brand Logo"    width="100" height="40" loading="lazy" class="h-10 object-contain hover:scale-110 transition-transform" onError="this.style.display='none'" />
            <img src="{{ asset('images/XiaomiLogo.jpg') }}"    alt="Xiaomi Brand Logo"  width="100" height="40" loading="lazy" class="h-10 object-contain hover:scale-110 transition-transform" onError="this.style.display='none'" />
            <img src="{{ asset('images/LevonoLogo.jpg') }}"    alt="Lenovo Brand Logo"  width="100" height="40" loading="lazy" class="h-10 object-contain hover:scale-110 transition-transform" onError="this.style.display='none'" />
        </div>
    </div>

    <!-- ===== 6. PROMOTIONAL / CTA SECTION ===== -->
    <div class="gsap-reveal bg-gradient-to-r from-blue-900 via-indigo-950 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 border border-slate-800">
        <div class="space-y-4 max-w-xl text-center md:text-left">
            <span class="px-3 py-1 bg-amber-400 text-slate-950 font-black text-xs rounded-full uppercase tracking-wider">
                Special Upgrade Promotion
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Upgrade Your Tech Gear Today</h2>
            <p class="text-slate-300 text-sm leading-relaxed">
                Get up to 24 months warranty, free express delivery, and instant trade-in discounts on all premium smartphones, laptops, and audio gear.
            </p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-modern-primary text-base py-4 px-8 rounded-2xl shrink-0 shadow-xl shadow-blue-500/20">
            Shop All Products Now <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
        </a>
    </div>

</div>
@endsection
