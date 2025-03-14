<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <title> @yield('title')</title>
  @vite('resources/css/app.css')
</head>
<body>
<header class="header-container">
    <div class="container mx-auto flex justify-between items-center py-4">
        <div class="header-logo">
            <a href="/home"><img src="{{ asset('images/haala-flower-garden-high-resolution-logo-transparent.png') }}" alt="logo"></a>
        </div>
        <nav class="flex space-x-10">
            <a href="/home" class="nav-link">Home</a>
          <div class="relative group">
                <p class="nav-link group-hover:text-gray-500">Products</p>
                <div class="absolute left-0 hidden group-hover:block group-hover:relative bg-white shadow-lg mt-2 rounded-lg z-10">
                    <a href="{{ route('plants') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Plants</a>
                    <a href="{{ route('pots') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pots</a>
                    <a href="{{ route('gardening.form') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Gardening</a>
                </div>
            </div>
            <a href="{{ route('wishlist.form') }}" class="nav-link">Wishlist</a>
            <a href="{{ route('textus.show') }}" class="nav-link">Text us</a>
        </nav>
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
        <div class="space-x-4">
            
            
            
           
           <!-- <div class="relative inline-block">
                <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                    <img src="{{ asset('images/undraw_Male_avatar_g98d.png') }}" alt="User Icon" class="w-10 h-10 rounded-full">
                </button>
                
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
                    <a href="{{ route('cart') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Cart</a>
                    <a href="{{ route('my.orders') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Orders</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div> -->

            @auth
    <div class="relative">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="w-10 h-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                @else
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            {{ Auth::user()->name }}
                            <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </span>
                @endif
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>

                <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-dropdown-link>
                @endif

                <div class="border-t border-gray-200"></div>
                <a href="{{ route('cart') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Cart</a>
                <a href="{{ route('my.orders') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Orders</a>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
@else
    <a href="{{ route('register') }}" class="nav-button">Register</a>
    <a href="{{ route('login') }}" class="nav-button">Login</a>
@endauth

        </div>
    </div>
</header>
<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-[#c3e6cb] p-5 text-center mt-10">
    <div class="flex justify-center my-5">
        <img src="{{ asset('images/haala-flower-garden-high-resolution-logo-transparent.png') }}" alt="Haala Flower Garden" class="w-[200px] h-auto">
    </div>
    <nav>
        <ul class="flex justify-center list-none p-0 m-0">
            <li class="mr-5">
                <a href="/home" class="text-gray-800 text-base no-underline transition-colors duration-300 hover:text-[#4CAF50]">Home</a>
            </li>
            <li class="mr-5">
                <a href="{{ route('wishlist.form') }}" class="text-gray-800 text-base no-underline transition-colors duration-300 hover:text-[#4CAF50]">Wishlist</a>
            </li>
            <li>
                <a href="{{ route('textus.show') }}" class="text-gray-800 text-base no-underline transition-colors duration-300 hover:text-[#4CAF50]">Text us</a>
            </li>
        </ul>
    </nav>
    <div class="flex justify-center my-5">
        <a href="#"><img src="{{ asset('images/facebook.jpeg') }}" alt="Facebook" class="w-[30px] mx-2 transition-opacity duration-300 hover:opacity-70"></a>
        <a href="#"><img src="{{ asset('images/insta.jpeg') }}" alt="Instagram" class="w-[30px] mx-2 transition-opacity duration-300 hover:opacity-70"></a>
        <a href="#"><img src="{{ asset('images/whatsapp.jpeg') }}" alt="WhatsApp" class="w-[30px] mx-2 transition-opacity duration-300 hover:opacity-70"></a>
    </div>
    <p class="text-sm mt-2 text-gray-600">&copy; 2024 Haala Flower Garden. All rights reserved.</p>
</footer>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('hidden');
        }

        window.onclick = function(event) {
            var dropdown = document.getElementById('dropdownMenu');
            if (!event.target.closest('.relative')) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            }
        }
    </script>
</body>
</html>
