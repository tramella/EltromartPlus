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

    <!-- WebSite Structured Data (Schema.org JSON-LD) -->
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 bg-slate-50 flex flex-col min-h-screen relative">
    <!-- Top Announcement Bar -->
    <div class="bg-blue-600 text-white text-xs py-2 px-4 text-center font-medium tracking-wide flex justify-between items-center max-w-7xl mx-auto w-full rounded-b-xl shadow-sm">
        <div class="hidden md:flex items-center gap-2">
            <i class="fa-solid fa-truck-fast"></i>
            <span>Free Express Shipping on Orders Over $200!</span>
        </div>
        <div class="mx-auto md:mx-0 flex items-center gap-4">
            <span>24/7 Customer Support: <strong class="font-semibold text-yellow-300">(+84) 456 787</strong></span>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 w-full navbar-container shadow-lg border-b border-slate-800/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">
                
                <!-- Brand Logo -->
                <a href="{{ route('main') }}" class="flex items-center shrink-0 group">
                    <img src="{{ asset('images/eltromart_plus.png') }}" alt="EltromartPlus Technological Equipment Store" width="220" height="46" class="logo_project transition-transform duration-300 group-hover:scale-105" onError="this.onerror=null;this.src='{{ asset('images/Logo_small.png') }}';" />
                </a>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-xl mx-4">
                    <form action="{{ route('products.index') }}" method="GET" class="relative w-full" role="search">
                        <input type="text" name="search" placeholder="Search laptops, smartphones, accessories..." class="w-full pl-5 pr-12 py-2.5 rounded-full bg-slate-900/60 border border-slate-700/70 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all shadow-inner" value="{{ request('search') }}" />
                        <button type="submit" aria-label="Search" class="absolute right-1.5 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-blue-600 hover:bg-blue-500 text-white flex items-center justify-center transition-colors shadow-md cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>
                </div>

                <!-- Right Action Icons (Wishlist, Cart, Auth) -->
                <div class="flex items-center gap-5 sm:gap-6">
                    <!-- Wishlist Link -->
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

                    <!-- Cart Link -->
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

                    <!-- User Account / Auth -->
                    <div class="pl-2 border-l border-slate-700/80">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center gap-2 text-slate-200 hover:text-white font-medium text-xs sm:text-sm bg-slate-800/80 hover:bg-slate-800 px-3 py-2 rounded-xl border border-slate-700 transition-all cursor-pointer">
                                    <i class="fa-solid fa-circle-user text-base text-blue-400"></i>
                                    <span class="hidden sm:inline">{{ Auth::user()->firstname ?? Auth::user()->name ?? 'Account' }}</span>
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl py-2 border border-slate-100 z-50 text-slate-700 text-sm">
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
                        @endauth --}}
                        @auth
                            @if (Auth::user()->utype === 'ADM')
                                <a href="{{ route('admin.index') }}" class="icon_header flex justify-between items-center">
                                @else
                                    <a href="{{ route('user.index') }}"
                                        class="icon_header flex justify-between items-center">
                            @endif

                            {{-- Hiển thị Avatar nếu có, nếu không thì dùng ảnh mặc định --}}
                            <img src="{{ Auth::user()->avatar ? asset('images/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                                class="icon_header_signin rounded-full" width="40" />

                            {{-- Hiển thị Username --}}
                            <span class="font-semibold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                            </a>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn-modern-primary text-xs py-2 px-4">
                                <i class="fa-solid fa-user mr-1.5 text-xs"></i> Sign In
                            </a>
                        @endguest
                    </div>
                </div>

            </div>

            <!-- Sub Category Links Bar -->
            <nav class="hidden lg:flex items-center justify-between border-t border-slate-800/70 py-2.5 text-xs font-medium text-slate-300">
                <div class="flex items-center gap-8">
                    <a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/mobilephone.png') }}" width="16" height="16" alt="Mobile Phones Icon" class="w-4 h-4 object-contain opacity-80" /> Mobile Phones
                    </a>
                    <a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/Laptop.png') }}" width="16" height="16" alt="Laptops Icon" class="w-4 h-4 object-contain opacity-80" /> Laptops
                    </a>
                    <a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/Accessories.png') }}" width="16" height="16" alt="Accessories Icon" class="w-4 h-4 object-contain opacity-80" /> Accessories
                    </a>
                    <a href="{{ route('products.index', ['category' => 4]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/iPad.png') }}" width="16" height="16" alt="Tablets Icon" class="w-4 h-4 object-contain opacity-80" /> Tablets
                    </a>
                    <a href="{{ route('products.index', ['category' => 5]) }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <img src="{{ asset('images/PCs.png') }}" width="16" height="16" alt="PCs Icon" class="w-4 h-4 object-contain opacity-80" /> PCs & Workstations
                    </a>
                </div>
                <div class="flex items-center gap-4 text-slate-400">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-headset text-blue-400"></i> Online Support 24/7</span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content Body -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Flash Notifications -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scroll to Top Floating Button -->
    <button id="scrollToTopBtn" aria-label="Scroll to top" class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none translate-y-4 cursor-pointer border border-blue-400/30">
        <i class="fa-solid fa-arrow-up text-lg"></i>
    </button>

    <!-- Footer Section -->
    <footer class="bg-slate-900 text-slate-300 mt-16 border-t border-slate-800">
        <!-- Newsletter Subscription Banner -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8 border-b border-slate-800">
            <div class="bg-gradient-to-r from-blue-900/50 via-slate-800 to-indigo-900/50 rounded-3xl p-8 md:p-10 border border-slate-700/60 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
                <div class="space-y-2 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-white tracking-tight">Subscribe to Our Tech Newsletter</h3>
                    <p class="text-slate-400 text-sm">Get exclusive discounts, new product launch alerts, and tech updates.</p>
                </div>
                <form class="flex w-full md:w-auto max-w-md gap-3" onsubmit="event.preventDefault(); alert('Subscribed successfully!');">
                    <input type="email" required placeholder="Enter your email address..." class="input-modern bg-slate-900/90 border-slate-700 text-white placeholder-slate-500 rounded-xl" />
                    <button type="submit" class="btn-modern-primary shrink-0 px-6">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Footer Columns -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Column 1: Brand & Contact -->
            <div class="space-y-4">
                <img src="{{ asset('images/eltromart_plus_bg_grey.png') }}" alt="EltromartPlus Footer Logo" width="220" height="48" class="img_footer" onError="this.onerror=null;this.src='{{ asset('images/Logo_small.png') }}';" />
                <p class="text-slate-400 text-xs leading-relaxed">
                    EltromartPlus is your leading technology destination for premium smartphones, laptops, audio gear, and electronic accessories.
                </p>
                <div class="space-y-2 text-xs text-slate-300">
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
                </div>
            </div>

            <!-- Column 2: Quick Shop -->
            <div class="space-y-3">
                <h4 class="text-white font-bold text-sm tracking-wider uppercase">Shop Categories</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-blue-400 transition-colors">Mobile Phones</a></li>
                    <li><a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-blue-400 transition-colors">Laptops & MacBooks</a></li>
                    <li><a href="{{ route('products.index', ['category' => 5]) }}" class="hover:text-blue-400 transition-colors">Computers & All-in-Ones</a></li>
                    <li><a href="{{ route('products.index', ['category' => 6]) }}" class="hover:text-blue-400 transition-colors">Headphones & Speakers</a></li>
                    <li><a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-blue-400 transition-colors">Charging & Power Accessories</a></li>
                </ul>
            </div>

            <!-- Column 3: Customer Care -->
            <div class="space-y-3">
                <h4 class="text-white font-bold text-sm tracking-wider uppercase">Customer Care</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Track Your Order</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Returns & Exchanges</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Warranty Information</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">FAQ & Support</a></li>
                </ul>
            </div>

            <!-- Column 4: Social & Payment -->
            <div class="space-y-4">
                <h4 class="text-white font-bold text-sm tracking-wider uppercase">Follow Us & Payment</h4>
                <div class="flex items-center gap-3 text-lg text-slate-300">
                    <a href="#" aria-label="Facebook" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                    <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-rose-600 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-instagram text-xs"></i></a>
                    <a href="#" aria-label="Twitter X" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-x-twitter text-xs"></i></a>
                    <a href="#" aria-label="YouTube" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-red-600 hover:text-white flex items-center justify-center transition-all"><i class="fa-brands fa-youtube text-xs"></i></a>
                </div>
                <div class="pt-2">
                    <span class="text-xs text-slate-400 block mb-2">Accepted Payment Methods</span>
                    <img src="{{ asset('images/payments.png') }}" alt="Accepted Payment Methods - Visa, MasterCard, PayPal" width="220" height="32" class="h-8 object-contain" />
                </div>
            </div>

        </div>

        <!-- Bottom Copyright -->
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton = document.getElementById("dropdownButton");
        const dropdownMenu = document.getElementById("dropdownMenu");
        const dropdownContainer = document.getElementById("dropdownContainer");

        function showDropdown() {
            dropdownMenu.classList.remove("opacity-0", "invisible");
            dropdownMenu.classList.add("opacity-100", "visible");
            dropdownButton.classList.add("dropdown-header");
        }

        function hideDropdown(event) {
            // Kiểm tra nếu chuột vẫn trong container thì không ẩn dropdown
            if (dropdownContainer.contains(event.relatedTarget)) {
                return;
            }
            dropdownMenu.classList.add("opacity-0", "invisible");
            dropdownMenu.classList.remove("opacity-100", "visible");
            dropdownButton.classList.remove("dropdown-header");
        }

        // Khi chuột vào container (bao gồm cả button & menu) => Hiện dropdown
        dropdownContainer.addEventListener("mouseenter", showDropdown);

        // Khi chuột rời khỏi container => Ẩn dropdown
        dropdownContainer.addEventListener("mouseleave", hideDropdown);
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton1 = document.getElementById("dropdownButton1");
        const dropdownMenu1 = document.getElementById("dropdownMenu1");
        const dropdownContainer1 = document.getElementById("dropdownContainer1");

        function showDropdown() {
            dropdownMenu1.classList.remove("opacity-0", "invisible");
            dropdownMenu1.classList.add("opacity-100", "visible");
            dropdownButton1.classList.add("dropdown-header");
        }

        function hideDropdown(event) {
            // Kiểm tra nếu chuột vẫn trong container thì không ẩn dropdown
            if (dropdownContainer1.contains(event.relatedTarget)) {
                return;
            }
            dropdownMenu1.classList.add("opacity-0", "invisible");
            dropdownMenu1.classList.remove("opacity-100", "visible");
            dropdownButton1.classList.remove("dropdown-header");
        }

        // Khi chuột vào container (bao gồm cả button & menu) => Hiện dropdown
        dropdownContainer1.addEventListener("mouseenter", showDropdown);

        // Khi chuột rời khỏi container => Ẩn dropdown
        dropdownContainer1.addEventListener("mouseleave", hideDropdown);
    });
</script>
<script>
    window.addEventListener("load", function() {
        setTimeout(() => {
            document.getElementById("loader").classList.add("fade-out");
            document.getElementById("content").style.opacity = "1";

            setTimeout(() => {
                document.getElementById("loader").style.display = "none";
            }, 400); // Đợi hiệu ứng fade-out hoàn tất
        }, 200); // Giữ loader trong 0.3s để tránh giật
    });
</script>
