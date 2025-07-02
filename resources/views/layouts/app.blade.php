<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jagomun') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F2EFEA; /* Menggunakan warna bg-ivory sebagai default */
        }
        main {
            padding-top: 6rem; /* Menyesuaikan padding untuk navbar yang lebih tinggi */
        }
        .text-navy { color: #1E2233; }
        .bg-navy { background-color: #1E2233; }
        .text-gold { color: #B4976B; }
        .bg-gold { background-color: #B4976B; }
    </style>

    @yield('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <nav class="fixed w-full z-50 bg-navy shadow-lg" id="navbar">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-24">

                    <!-- Kolom Kiri (Logo) -->
                    <div class="flex-1 flex justify-start">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="JAGOMUN 2025 Logo" class="h-20 w-auto">
                        </a>
                    </div>

                    <!-- Kolom Tengah (Menu Utama - Desktop) -->
                    <div class="hidden lg:flex flex-1 justify-center items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-white hover:text-gold transition-colors duration-300">Home</a>
                        <a href="#" class="text-white hover:text-gold transition-colors duration-300">About</a>
                        <a href="#" class="text-white hover:text-gold transition-colors duration-300">Councils</a>
                        <a href="#" class="text-white hover:text-gold transition-colors duration-300">FAQ</a>
                    </div>

                    <!-- Kolom Kanan (Tombol Menu Mobile) -->
                    <div class="flex-1 flex justify-end items-center">
                        {{-- Tombol Register Now (Desktop) Dihapus --}}

                        <!-- Tombol Menu Mobile -->
                        <div class="lg:hidden">
                            <button id="mobile-menu-button" class="text-white p-2 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Menu Mobile --}}
            <div id="mobile-menu" class="lg:hidden hidden bg-navy/95 backdrop-blur-sm">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gold hover:bg-gray-700">Home</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gold hover:bg-gray-700">About</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gold hover:bg-gray-700">Councils</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gold hover:bg-gray-700">FAQ</a>
                    {{-- Tombol Register Now (Mobile) Dihapus --}}
                </div>
            </div>
        </nav>

        <main>
            @if (session('success'))
                <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md max-w-7xl mx-auto mb-6" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">Success!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                 <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md max-w-7xl mx-auto mb-6" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">Error!</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md max-w-7xl mx-auto mb-6" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">Whoops! There were some problems with your input.</p>
                               <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="bg-navy py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
            <p>&copy; {{ date('Y') }} JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UKM UNEJ Model United Nations Club</p>
        </div>
    </footer>

    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
