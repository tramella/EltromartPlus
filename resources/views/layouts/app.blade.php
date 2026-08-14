<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Primary Meta Tags -->
    <title>@yield('title', config('app.name', 'EltromartPlus') . ' - Premium Technological Equipment Store')</title>
    <meta name="description" content="@yield('meta_description', 'EltromartPlus is your leading technology destination for premium smartphones, laptops, audio gear, and electronic accessories with 24/7 support and fast shipping.')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())" />
    <link rel="icon" href="{{ asset('images/Logo_small.png') }}" type="image/png">

    <!-- Open Graph / Social Meta Tags -->
    @hasSection('og_tags')
        @yield('og_tags')
    @else
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="EltromartPlus - Premium Technological Equipment Store">
        <meta property="og:description" content="Explore flagship smartphones, powerful laptops, workstations, and high quality audio gear with 24/7 support.">
        <meta property="og:image" content="{{ asset('images/eltromart_plus.png') }}">
    @endif

    <!-- WebSite Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "EltromartPlus",
      "url": "{{ url('/') }}",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ route('products.index') }}?search={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <!-- Google Fonts: Figtree for clean modern typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons v6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite compiled CSS and JS assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 bg-slate-50 flex flex-col min-h-screen relative">

    <!-- Top announcement bar: shipping and support info -->
    <div class="bg-blue-600 text-white text-xs py-2 px-4 text-center font-medium tracking-wide flex justify-between items-center max-w-7xl mx-auto w-full rounded-b-xl shadow-sm">
        <div class="hidden md:flex items-center gap-2">
            <i class="fa-solid fa-truck-fast"></i>
            <span>Free Express Shipping on Orders Over $200!</span>
        </div>
        <div class="mx-auto md:mx-0 flex items-center gap-4">
            <span>24/7 Customer Support: <strong class="font-semibold text-yellow-300">(+84) 456 787</strong></span>
        </div>
    </div>

    <!-- Sticky main navigation header -->
    <header class="sticky top-0 z-40 w-full navbar-container shadow-lg border-b border-slate-800/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">

                <!-- Brand logo: links back to homepage -->
                <a href="{{ route('main') }}" class="flex items-center shrink-0 group">
                    <img src="{{ asset('images/eltromart_plus.png') }}"
                         alt="EltromartPlus Technological Equipment Store"
                         width="220" height="46"
                         class="logo_project transition-transform duration-300 group-hover:scale-105"
                         onError="this.onerror=null;this.src='{{ asset('images/Logo_small.png') }}';" />
                </a>

                <!-- Global product search bar (hidden on mobile, shown on md+) -->
                <div class="hidden md:flex flex-1 max-w-xl mx-4">
                    <form action="{{ route('products.index') }}" method="GET" class="relative w-full" role="search">
                        <input type="text"
                               name="search"
                               placeholder="Search laptops, smartphones, accessories..."
                               class="w-full pl-5 pr-12 py-2.5 rounded-full bg-slate-900/60 border border-slate-700/70 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all shadow-inner"
                               value="{{ request('search') }}" />
                        <button type="submit"
                                aria-label="Search products"
                                class="absolute right-1.5 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-blue-600 hover:bg-blue-500 text-white flex items-center justify-center transition-colors shadow-md cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>
                </div>

                <!-- Right-side action icons: wishlist, cart, auth -->
                <div class="flex items-center gap-5 sm:gap-6">

                    <!-- Wishlist icon with badge count from session -->
                    @php
                        $wishlistCount = count(session()->get('wishlist', []));
                    @endphp
                    <a href="{{ route('wishlist.index') }}" aria-label="View Wishlist" class="relative text-slate-300 hover:text-white flex flex-col items-center group transition-colors">
                        <div class="relative p-1.5">
                            <i class="fa-regular fa-heart text-xl group-hover:scale-110 transition-transform"></i>
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
                    <a href="{{ route('cart.index') }}" aria-label="View Cart" class="relative text-slate-300 hover:text-white flex flex-col items-center group transition-colors">
                        <div class="relative p-1.5">
                            <i class="fa-solid fa-bag-shopping text-xl group-hover:scale-110 transition-transform"></i>
                            @if($cartCount > 0)
                                <span class="badge-count">{{ $cartCount }}</span>
                            @endif
                        </div>
                        <span class="text-[11px] font-medium hidden sm:inline text-slate-300">Cart</span>
                    </a>

                    <!-- Auth section: show user dropdown if logged in, sign-in button if guest -->
                    <div class="pl-2 border-l border-slate-700/80">
                        @auth
                            <!-- Authenticated user: show name with dropdown for profile/logout -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                        class="flex items-center gap-2 text-slate-200 hover:text-white font-medium text-xs sm:text-sm bg-slate-800/80 hover:bg-slate-800 px-3 py-2 rounded-xl border border-slate-700 transition-all cursor-pointer">
                                    <i class="fa-solid fa-circle-user text-base text-blue-400"></i>
                                    <span class="hidden sm:inline">{{ Auth::user()->firstname ?? Auth::user()->name ?? 'Account' }}</span>
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </button>
                                <!-- Dropdown menu: profile and logout actions -->
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
                            <!-- Guest: show sign in button -->
                            <a href="{{ route('login') }}" class="btn-modern-primary text-xs py-2 px-4">
                                <i class="fa-solid fa-user mr-1.5 text-xs"></i> Sign In
                            </a>
                        @endguest
                    </div>

                </div>
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

    <!-- Main page content area -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

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

    <!-- Scroll to top floating action button (shown after scrolling 350px down) -->
    <button id="scrollToTopBtn"
            aria-label="Scroll to top of page"
            class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none translate-y-4 cursor-pointer border border-blue-400/30">
        <i class="fa-solid fa-arrow-up text-lg"></i>
    </button>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-slate-900 text-slate-300 mt-16 border-t border-slate-800">

        <!-- Newsletter signup banner -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8 border-b border-slate-800">
            <div class="bg-gradient-to-r from-blue-900/50 via-slate-800 to-indigo-900/50 rounded-3xl p-8 md:p-10 border border-slate-700/60 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
                <div class="space-y-2 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-white tracking-tight">Subscribe to Our Tech Newsletter</h3>
                    <p class="text-slate-400 text-sm">Get exclusive discounts, new product launch alerts, and tech updates.</p>
                </div>
                <form class="flex w-full md:w-auto max-w-md gap-3" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                    <input type="email" required placeholder="Enter your email address..." class="input-modern bg-slate-900/90 border-slate-700 text-white placeholder-slate-500 rounded-xl" />
                    <button type="submit" class="btn-modern-primary shrink-0 px-6">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Footer 4-column grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Column 1: Brand info and contact details -->
            <div class="space-y-4">
                <img src="{{ asset('images/eltromart_plus_bg_grey.png') }}"
                     alt="EltromartPlus Footer Logo"
                     width="220" height="48"
                     class="img_footer"
                     onError="this.onerror=null;this.src='{{ asset('images/Logo_small.png') }}';" />
                <p class="text-slate-400 text-xs leading-relaxed">
                    EltromartPlus is your leading technology destination for premium smartphones, laptops, audio gear, and electronic accessories.
                </p>
                <address class="space-y-2 text-xs text-slate-300 not-italic">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-location-dot text-blue-400 w-4"></i>
                        <span>685 Market Street, San Francisco, CA</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-blue-400 w-4"></i>
                        <span>(415) 555-5555</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-blue-400 w-4"></i>
                        <span>support@eltromartplus.com</span>
                    </div>
                </address>
            </div>

            <!-- Column 2: Shop category links -->
            <div class="space-y-3">
                <h4 class="text-white font-bold text-sm tracking-wider uppercase">Shop Categories</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-blue-400 transition-colors">Mobile Phones</a></li>
                    <li><a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-blue-400 transition-colors">Laptops &amp; MacBooks</a></li>
                    <li><a href="{{ route('products.index', ['category' => 5]) }}" class="hover:text-blue-400 transition-colors">Computers &amp; All-in-Ones</a></li>
                    <li><a href="{{ route('products.index', ['category' => 6]) }}" class="hover:text-blue-400 transition-colors">Headphones &amp; Speakers</a></li>
                    <li><a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-blue-400 transition-colors">Charging &amp; Power Accessories</a></li>
                </ul>
            </div>

            <!-- Column 3: Customer care links -->
            <div class="space-y-3">
                <h4 class="text-white font-bold text-sm tracking-wider uppercase">Customer Care</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Track Your Order</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Returns &amp; Exchanges</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Warranty Information</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">FAQ &amp; Support</a></li>
                </ul>
            </div>

            <!-- Column 4: Social media and accepted payment methods -->
            <div class="space-y-4">
                <h4 class="text-white font-bold text-sm tracking-wider uppercase">Follow Us &amp; Payment</h4>
                <div class="flex items-center gap-3 text-lg text-slate-300">
                    <a href="#" aria-label="Follow on Facebook" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                    <a href="#" aria-label="Follow on Instagram" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-rose-600 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-instagram text-xs"></i></a>
                    <a href="#" aria-label="Follow on X (Twitter)" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-x-twitter text-xs"></i></a>
                    <a href="#" aria-label="Follow on YouTube" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-red-600 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-youtube text-xs"></i></a>
                </div>
                <div class="pt-2">
                    <span class="text-xs text-slate-400 block mb-2">Accepted Payment Methods</span>
                    <img src="{{ asset('images/payments.png') }}"
                         alt="Accepted payment methods: Visa, MasterCard, PayPal"
                         width="220" height="32"
                         class="h-8 object-contain" />
                </div>
            </div>

        </div>

        <!-- Bottom copyright bar -->
        <div class="bg-slate-950 py-4 border-t border-slate-800 text-center text-xs text-slate-500">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p>&copy; {{ date('Y') }} EltromartPlus Technological Equipment. All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Terms of Service</a>
                </div>
            </div>
        </div>

    </footer>

</body>
</html>
