<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jagomun') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Wadah untuk style khusus dari halaman konten --}}
    @yield('styles')

    <style>
        :root {
            --color-navy: #1E2233;
            --color-royal: #2D3B61;
            --color-gold: #B4976B;
            --color-champagne: #D6C4A4;
            --color-ivory: #F2EFEA;
        }
        body {
            background-color: var(--color-ivory);
            color: #000;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <nav id="navbar" class="fixed w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-8">
                    <img src="{{ asset('images/logo.png') }}"
                    alt="JAGOMUN 2025 Logo"
                    class="h-20 w-auto">
                </a>
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="/" class="text-white hover:text-[color:var(--color-gold)] transition-colors duration-300">Home</a>
                        <a href="{{ route('about') }}" class="text-white hover:text-[color:var(--color-gold)] transition-colors duration-300">About</a>
                        <a href="{{ route('councils') }}" class="text-white hover:text-[color:var(--color-gold)] transition-colors duration-300">Councils</a>
                        <a href="{{ route('packages') }}" class="text-white hover:text-[color:var(--color-gold)] transition-colors duration-300">Packages</a>
                    </div>
                    <div class="hidden lg:flex">
                        <a href="{{ route('registration.chooseType') }}" class="text-white hover:text-[color:var(--color-gold)] transition-colors duration-300">
                            Register Now
                        </a>
                    </div>
                    <div class="lg:hidden">
                        <button id="mobile-menu-button" class="text-white p-2">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="lg:hidden hidden" style="background-color: rgba(30, 34, 51, 0.95);">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="mobile-link block px-3 py-2 text-white hover:text-[color:var(--color-gold)]">Home</a>
                    <a href="{{ route('about') }}" class="mobile-link block px-3 py-2 text-white hover:text-[color:var(--color-gold)]">About</a>
                    <a href="{{ route('councils') }}" class="mobile-link block px-3 py-2 text-white hover:text-[color:var(--color-gold)]">Councils</a>
                    <a href="{{ route('packages') }}" class="mobile-link block px-3 py-2 text-white hover:text-[color:var(--color-gold)]">Packages</a>
                    <a href="{{ route('registration.chooseType') }}" class="mobile-link block mt-2 mx-2 px-3 py-2" style="background-color: var(--color-gold); color: var(--color-navy); text-align: center; border-radius: 0.5rem; font-weight: 600;">Register Now</a>
                </div>
            </div>
        </nav>

        <main class="pt-24">
            @if (session('succes'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 5000)"
                    x-transition
                    class="fixed top-24 right-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-lg z-50 max-w-sm"
                    role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('succes') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" class="fixed top-24 right-5 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-lg z-50 max-w-sm">
                    <strong class="font-bold">Whoops!</strong>
                    <ul class="mt-1 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="bg-navy py-12">
    <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
        <p>&copy; 2025 JAGOMUN. All Rights Reserved.</p>
        <p class="text-sm mb-4">Organized by UNEJ Model United Nations Club</p>

        <div class="flex justify-center space-x-6 text-white text-lg">
            <a href="https://www.instagram.com/jagomun.2025" target="_blank" class="hover:text-white">
                <i class="ri-instagram-line"></i>
            </a>
            <a href="https://www.linkedin.com/company/jagomun/" target="_blank" class="hover:text-white">
                <i class="ri-linkedin-box-line"></i>
            </a>
            <a href="mailto:Jagomunofficial@gmail.com" class="hover:text-white">
                <i class="ri-mail-line"></i>
            </a>
            <a href="https://wa.me/6281217248675" target="_blank" class="hover:text-white">
                <i class="ri-whatsapp-line"></i>
            </a>
        </div>
    </div>
</footer>

    <script>
    // Menjalankan semua script setelah seluruh konten halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {

        // --- 1. EFEK SCROLL PADA NAVBAR ---
        // Mencari elemen navbar berdasarkan ID yang sudah kita tambahkan
        const navbar = document.getElementById('navbar');

        // Membuat fungsi yang bisa digunakan ulang untuk mengecek posisi scroll
        const handleNavbarScroll = () => {
            // Cek apakah posisi scroll vertikal lebih dari 50px dari atas
            if (window.scrollY > 50) {
                // Jika ya, tambahkan kelas untuk memberinya warna latar dan bayangan
                // Pastikan kelas ini sesuai dengan yang Anda inginkan (misal: 'bg-[color:var(--color-ivory)]' jika ingin warna gading)
                navbar.classList.add('bg-[color:var(--color-navy)]', 'shadow');
            } else {
                // Jika tidak (di paling atas), hapus kelas tersebut agar kembali transparan
                navbar.classList.remove('bg-[color:var(--color-navy)]', 'shadow');
            }
        };

        // Panggil fungsi ini sekali saat halaman dimuat untuk mengatur tampilan awal navbar
        handleNavbarScroll();
        // Kemudian, panggil fungsi ini setiap kali pengguna melakukan scroll
        window.addEventListener('scroll', handleNavbarScroll);


        // --- 2. FUNGSI TOMBOL MENU MOBILE ---
        // Mencari elemen tombol dan menu mobile berdasarkan ID
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // Pastikan kedua elemen ada sebelum menambahkan event listener
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                // Toggle (tampilkan/sembunyikan) kelas 'hidden' pada menu mobile
                mobileMenu.classList.toggle('hidden');
            });
        }


        // --- 3. FUNGSI ANIMASI ELEMEN SAAT SCROLL (SCROLL REVEAL) ---
        // Membuat observer untuk mendeteksi kapan sebuah elemen masuk ke viewport
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Jika elemen yang diamati terlihat di layar
                if (entry.isIntersecting) {
                    // Tambahkan kelas 'revealed' untuk memicu animasi CSS
                    entry.target.classList.add('revealed');
                    // Berhenti mengamati elemen ini setelah animasinya muncul sekali
                    scrollObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 }); // Animasi terpicu saat 10% elemen terlihat

        // Cari semua elemen yang memiliki kelas '.scroll-reveal' dan amati semuanya
        const elementsToReveal = document.querySelectorAll('.scroll-reveal');
        elementsToReveal.forEach(el => {
            scrollObserver.observe(el);
        });

    });
</script>
</body>
</html>
