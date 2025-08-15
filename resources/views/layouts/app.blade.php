<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @auth
        <div class="min-h-screen bg-gray-100">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ 
                                    auth()->user()->isAdmin() ? route('admin.dashboard') : (
                                    auth()->user()->isMitra() ? route('mitra.dashboard') : 
                                    route('user.dashboard')
                                ) }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                @if(auth()->user()->isAdmin())
                                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.mitra.index')" :active="request()->routeIs('admin.mitra.*')">
                                        {{ __('Mitra Management') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.kost.index')" :active="request()->routeIs('admin.kost.*')">
                                        {{ __('Kost Management') }}
                                    </x-nav-link>
                                @elseif(auth()->user()->isMitra())
                                    <x-nav-link :href="route('mitra.dashboard')" :active="request()->routeIs('mitra.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('mitra.kost.index')" :active="request()->routeIs('mitra.kost.*')">
                                        {{ __('My Kost') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('mitra.bookings.index')" :active="request()->routeIs('mitra.bookings.*')">
                                        {{ __('Bookings') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('mitra.reviews.index')" :active="request()->routeIs('mitra.reviews.*')">
                                        {{ __('Reviews') }}
                                    </x-nav-link>
                                @else
                                    <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('user.kost.index')" :active="request()->routeIs('user.kost.*')">
                                        {{ __('Browse Kost') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('user.bookings.index')" :active="request()->routeIs('user.bookings.*')">
                                        {{ __('My Bookings') }}
                                    </x-nav-link>
                                @endif
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
        @endauth
        @stack('scripts')
    </body>
</html>
<!-- End of app.blade.php -->
