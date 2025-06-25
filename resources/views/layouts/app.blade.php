<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jagomun') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')

    <style>
        /* Pastikan padding top untuk menghindari konten ketutupan navbar */
        main {
            padding-top: 4.5rem;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <nav class="sticky top-0 w-full z-50 bg-[#1E2233] shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-8">
                    <div class="flex-shrink-0">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}"
                            alt="JAGOMUN 2025 Logo"
                            class="h-20 w-auto">
                    </a>
                </div>

                    {{-- Tombol Toggle di Mobile --}}
                    <div class="lg:hidden">
                        <button id="toggleBackBtn" class="text-white p-2 focus:outline-none">
                            <svg id="icon-open" class="w-6 h-6 block" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Tombol Kembali --}}
                    <div id="backButtonWrapper" class="hidden lg:flex">
                        <a href="javascript:history.back()" class="flex items-center text-white hover:text-[#B4976B] transition-colors duration-300 font-semibold px-3 py-2 rounded-md">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg> --}}
                            Back
                        </a>
                    </div>
                </div>
            </div>

            {{-- Menu responsif tombol back --}}
            <div id="mobileBackButton" class="lg:hidden hidden bg-[#1E2233] px-4 pb-4">
                <a href="javascript:history.back()" class="block text-white hover:text-[#B4976B] font-semibold">
                    ← Back
                </a>
            </div>
        </nav>

        <main>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto mt-4 max-w-7xl" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto mt-4 max-w-7xl" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto mt-4 max-w-7xl" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="mt-3 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="bg-[#1E2233] py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
            <p>&copy; {{ date('Y') }} JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UKM UNEJ Model United Nations Club</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById('toggleBackBtn');
            const mobileBack = document.getElementById('mobileBackButton');
            const iconOpen = document.getElementById('icon-open');
            const iconClose = document.getElementById('icon-close');

            toggleBtn.addEventListener('click', function () {
                mobileBack.classList.toggle('hidden');
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
