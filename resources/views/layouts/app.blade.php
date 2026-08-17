<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title & Meta Description -->
    <title>@yield('title', 'EltromartPlus - Premium Technological Equipment Store')</title>
    <meta name="description" content="@yield('meta_description', 'Discover flagship smartphones, powerful workstations, laptops, high-performance audio gear, and electronic accessories with 24/7 support and fast delivery.')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())" />

    <!-- Open Graph (OG) Social Sharing Metadata -->
    @yield('og_tags')

    <!-- Preconnect to Google Fonts & CDN resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- SweetAlert2 CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FontAwesome Icons v6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite compiled CSS and JS assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 bg-slate-50 flex flex-col min-h-screen relative">

    <!-- Top announcement bar: full-width edge-to-edge, responsive without border radius -->
    <div class="w-full bg-blue-600 text-white text-xs py-2.5 px-4 shadow-sm border-b border-blue-700 font-medium tracking-wide">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1.5 sm:gap-4 text-center sm:text-left">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-truck-fast text-yellow-300"></i>
                <span>Free Express Shipping on Orders Over $200!</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-headset text-yellow-300"></i>
                <span>24/7 Customer Support: <strong class="font-semibold text-yellow-300 font-mono text-xs">(+84) 456 787</strong></span>
            </div>
        </div>
    </div>

    <!-- Sticky main navigation header -->
    <header class="sticky top-0 z-40 w-full navbar-container shadow-lg border-b border-slate-800/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20 gap-3">

                <!-- Brand logo: links back to homepage -->
                <a href="{{ route('main') }}" class="flex items-center shrink-0 group">
                    <img src="{{ asset('images/eltromart_plus.png') }}"
                         alt="EltromartPlus Technological Equipment Store"
                         width="220" height="46"
                         class="h-9 sm:h-11 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                         onError="this.onerror=null;this.src='{{ asset('images/Logo_small.png') }}';" />
                </a>

                <!-- Global product search bar (desktop view) -->
                <div class="hidden md:flex flex-1 max-w-xl mx-4">
                    <form action="{{ route('products.index') }}" method="GET" class="relative w-full" role="search">
                        <input type="text"
                               name="search"
                               placeholder="Search laptops, smartphones, accessories..."
                               class="w-full pl-5 pr-12 py-2.5 rounded-full bg-slate-900/60 border border-slate-700/70 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all shadow-inner"
                               value="{{ request('search') }}" />
                        <button type="submit"
                                aria-label="Search products"
                                class="absolute right-1.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-blue-600 hover:bg-blue-500 text-white flex items-center justify-center transition-colors shadow-md cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>
                </div>

                <!-- Right-side action icons: wishlist, cart, auth -->
                <div class="flex items-center gap-3 sm:gap-6">

                    <!-- Wishlist icon with badge count from session -->
                    @php
                        $wishlistCount = count(session()->get('wishlist', []));
                    @endphp
                    <a href="{{ route('wishlist.index') }}" aria-label="View Wishlist" class="relative text-slate-300 hover:text-white flex flex-col items-center group transition-colors p-1">
                        <div class="relative p-1">
                            <i class="fa-regular fa-heart text-lg sm:text-xl group-hover:scale-110 transition-transform"></i>
                            @if($wishlistCount > 0)
                                <span class="badge-count">{{ $wishlistCount }}</span>
                            @endif
                        </div>
                        <span class="text-[11px] font-medium hidden sm:inline text-slate-300">Wishlist</span>
                    </a>

                    <!-- Cart icon with item count badge from session -->
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = array_sum(array_column($cartItems, 'quantity'));
                    @endphp
                    <a href="{{ route('cart.index') }}" aria-label="View Cart" class="relative text-slate-300 hover:text-white flex flex-col items-center group transition-colors p-1">
                        <div class="relative p-1">
                            <i class="fa-solid fa-bag-shopping text-lg sm:text-xl group-hover:scale-110 transition-transform"></i>
                            @if($cartCount > 0)
                                <span class="badge-count">{{ $cartCount }}</span>
                            @endif
                        </div>
                        <span class="text-[11px] font-medium hidden sm:inline text-slate-300">Cart</span>
                    </a>

                    <!-- Auth section -->
                    <div class="pl-1 sm:pl-2 border-l border-slate-700/80">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                        class="flex items-center gap-2 text-slate-200 hover:text-white font-medium text-xs sm:text-sm bg-slate-800/80 hover:bg-slate-800 px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-xl border border-slate-700 transition-all cursor-pointer">
                                    <i class="fa-solid fa-circle-user text-sm sm:text-base text-blue-400"></i>
                                    <span class="hidden sm:inline">{{ Auth::user()->firstname ?? Auth::user()->name ?? 'Account' }}</span>
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </button>
                                <div x-show="open"
                                     @click.away="open = false"
                                     x-cloak
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl py-2 border border-slate-100 z-50 text-slate-700 text-sm">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-slate-50 transition-colors">
                                        <i class="fa-solid fa-user-gear mr-2 text-slate-400"></i> Edit Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-rose-600 hover:bg-rose-50 transition-colors font-medium">
                                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn-modern-primary text-xs py-1.5 px-3 sm:py-2 sm:px-4">
                                <i class="fa-solid fa-user mr-1 text-xs"></i> <span>Sign In</span>
                            </a>
                        @endguest
                    </div>

                </div>
            </div>

            <!-- Mobile Search Bar input row (visible on mobile only) -->
            <div class="md:hidden pb-3">
                <form action="{{ route('products.index') }}" method="GET" class="relative w-full" role="search">
                    <input type="text"
                           name="search"
                           placeholder="Search products..."
                           class="w-full pl-4 pr-10 py-2 rounded-xl bg-slate-900/80 border border-slate-700 text-white placeholder-slate-400 text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                           value="{{ request('search') }}" />
                    <button type="submit" aria-label="Search products" class="absolute right-1 top-1/2 -translate-y-1/2 w-7 h-7 rounded-lg bg-blue-600 text-white flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                    </button>
                </form>
            </div>

            <!-- Secondary category navigation bar (desktop only) -->
            <nav aria-label="Category navigation" class="hidden lg:flex items-center justify-between border-t border-slate-800/70 py-2.5 text-xs font-medium text-slate-300">
                <div class="flex items-center gap-8">
                    <a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/mobilephone.png') }}" width="16" height="16" alt="" class="w-4 h-4 object-contain opacity-80" aria-hidden="true" /> Mobile Phones
                    </a>
                    <a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/Laptop.png') }}" width="16" height="16" alt="" class="w-4 h-4 object-contain opacity-80" aria-hidden="true" /> Laptops
                    </a>
                    <a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/Accessories.png') }}" width="16" height="16" alt="" class="w-4 h-4 object-contain opacity-80" aria-hidden="true" /> Accessories
                    </a>
                    <a href="{{ route('products.index', ['category' => 4]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/iPad.png') }}" width="16" height="16" alt="" class="w-4 h-4 object-contain opacity-80" aria-hidden="true" /> Tablets
                    </a>
                    <a href="{{ route('products.index', ['category' => 5]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/PCs.png') }}" width="16" height="16" alt="" class="w-4 h-4 object-contain opacity-80" aria-hidden="true" /> PCs &amp; Workstations
                    </a>
                </div>
                <div class="flex items-center gap-4 text-slate-400">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-headset text-blue-400"></i> Online Support 24/7</span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main page content area (pb-24 on mobile to accommodate fixed bottom bar) -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-24 lg:pb-6">

        <!-- Session success flash notification -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 cursor-pointer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Sticky Mobile Bottom App Navigation Bar (Visible on mobile/tablet only) -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-slate-900/95 backdrop-blur-md border-t border-slate-800 py-2 px-3 shadow-2xl">
        <div class="flex items-center justify-around text-slate-400 text-[10px] font-semibold">
            <a href="{{ route('main') }}" class="flex flex-col items-center gap-1 hover:text-blue-400 transition-colors {{ request()->routeIs('main') ? 'text-blue-500 font-bold' : '' }}">
                <i class="fa-solid fa-house text-base"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('products.index') }}" class="flex flex-col items-center gap-1 hover:text-blue-400 transition-colors {{ request()->routeIs('products.*') ? 'text-blue-500 font-bold' : '' }}">
                <i class="fa-solid fa-boxes-stacked text-base"></i>
                <span>Catalog</span>
            </a>
            <a href="{{ route('wishlist.index') }}" class="flex flex-col items-center gap-1 hover:text-blue-400 transition-colors relative {{ request()->routeIs('wishlist.*') ? 'text-blue-500 font-bold' : '' }}">
                <div class="relative">
                    <i class="fa-solid fa-heart text-base"></i>
                    @if($wishlistCount > 0)
                        <span class="absolute -top-1.5 -right-2 bg-rose-500 text-white font-bold text-[9px] w-4 h-4 rounded-full flex items-center justify-center">{{ $wishlistCount }}</span>
                    @endif
                </div>
                <span>Wishlist</span>
            </a>
            <a href="{{ route('cart.index') }}" class="flex flex-col items-center gap-1 hover:text-blue-400 transition-colors relative {{ request()->routeIs('cart.*') ? 'text-blue-500 font-bold' : '' }}">
                <div class="relative">
                    <i class="fa-solid fa-bag-shopping text-base"></i>
                    @if($cartCount > 0)
                        <span class="absolute -top-1.5 -right-2 bg-blue-600 text-white font-bold text-[9px] w-4 h-4 rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </div>
                <span>Cart</span>
            </a>
            @auth
                <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1 hover:text-blue-400 transition-colors {{ request()->routeIs('profile.*') ? 'text-blue-500 font-bold' : '' }}">
                    <i class="fa-solid fa-user-gear text-base"></i>
                    <span>Profile</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="flex flex-col items-center gap-1 hover:text-blue-400 transition-colors {{ request()->routeIs('login') ? 'text-blue-500 font-bold' : '' }}">
                    <i class="fa-solid fa-circle-user text-base"></i>
                    <span>Sign In</span>
                </a>
            @endauth
        </div>
    </nav>

    <!-- Scroll to top floating action button -->
    <button id="scrollToTopBtn"
            aria-label="Scroll to top of page"
            class="fixed bottom-20 sm:bottom-6 right-4 sm:right-6 z-40 w-11 h-11 rounded-full bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none translate-y-4 cursor-pointer border border-blue-400/30">
        <i class="fa-solid fa-arrow-up text-base"></i>
    </button>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-slate-900 text-slate-300 mt-16 border-t border-slate-800 pb-20 lg:pb-0">

        <!-- Newsletter signup banner -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8 border-b border-slate-800">
            <div class="bg-gradient-to-r from-blue-900/50 via-slate-800 to-indigo-900/50 rounded-3xl p-6 sm:p-8 md:p-10 border border-slate-700/60 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
                <div class="space-y-2 text-center md:text-left">
                    <h3 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Subscribe to Our Tech Newsletter</h3>
                    <p class="text-xs sm:text-sm text-slate-300">Get early access to exclusive flash sales and technology reviews.</p>
                </div>
                <form action="#" method="POST" class="w-full md:w-auto flex flex-col sm:flex-row gap-2 max-w-md" @submit.prevent="Swal.fire({title:'Subscribed!', text:'Thank you for joining EltromartPlus.', icon:'success', confirmButtonColor:'#2563eb'})">
                    <input type="email" placeholder="Enter your email..." required class="input-modern bg-slate-900/80 border-slate-700 text-white placeholder-slate-400 text-xs sm:text-sm py-3 px-4" />
                    <button type="submit" class="btn-modern-primary shrink-0 py-3 px-6 text-xs sm:text-sm uppercase tracking-wider font-bold cursor-pointer">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Multi-column footer links -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div class="space-y-4 text-center sm:text-left">
                <img src="{{ asset('images/eltromart_plus.png') }}" width="180" height="38" alt="EltromartPlus Logo" class="mx-auto sm:mx-0 h-9 w-auto" />
                <p class="text-xs text-slate-400 leading-relaxed">
                    EltromartPlus is your premier destination for high-end smartphones, computers, workstations, and high-fidelity audio equipment.
                </p>
                <div class="flex items-center justify-center sm:justify-start gap-3 text-slate-400 text-sm">
                    <a href="#" aria-label="Facebook" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-400 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" aria-label="Instagram" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-pink-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-red-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <div class="space-y-3">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Product Categories</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-blue-400 transition-colors">Mobile Phones</a></li>
                    <li><a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-blue-400 transition-colors">Laptops &amp; MacBooks</a></li>
                    <li><a href="{{ route('products.index', ['category' => 4]) }}" class="hover:text-blue-400 transition-colors">Tablets &amp; iPads</a></li>
                    <li><a href="{{ route('products.index', ['category' => 5]) }}" class="hover:text-blue-400 transition-colors">PCs &amp; Workstations</a></li>
                    <li><a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-blue-400 transition-colors">Accessories &amp; Peripherals</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Customer Care</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Help Center &amp; Support</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Shipping &amp; Delivery Policy</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Returns &amp; Exchanges</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Warranty Guarantee</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-blue-400 transition-colors">Tech Blog &amp; News</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Contact Store</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot mt-0.5 text-blue-500"></i>
                        <span>123 High-Tech Boulevard, Silicon Valley, CA</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-blue-500"></i>
                        <span>(+84) 456 787</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-blue-500"></i>
                        <span>support@eltromartplus.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright bar -->
        <div class="border-t border-slate-800 py-6 text-center text-xs text-slate-400">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} EltromartPlus. All rights reserved.</p>
                <div class="flex items-center gap-4 text-slate-400">
                    <a href="#" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
                    <span>&bull;</span>
                    <a href="#" class="hover:text-slate-300 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>

    </footer>

    @yield('scripts')
</body>
</html>
