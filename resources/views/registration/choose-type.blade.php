<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Choose Registration Type - JAGOMUN 2025</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .text-navy { color: #1E2233; }
        .bg-navy { background-color: #1E2233; }
        .text-royal { color: #2D3B61; }
        .bg-royal { background-color: #2D3B61; }
        .bg-ivory { background-color: #F2EFEA; }
        .text-gold { color: #B4976B; }
        .bg-gold { background-color: #B4976B; }
        .text-champagne { color: #D6C4A4; }
        .border-gold { border-color: #B4976B; }
        .ring-gold { --tw-ring-color: #B4976B; }
    </style>
</head>
<body class="bg-navy">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-navy shadow-lg" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-8">
                <a href="#home">
                <img src="{{ asset('images/logo.png') }}"
                    alt="JAGOMUN 2025 Logo"
                    class="h-20 w-auto">
                </a>
                <!-- Desktop -->
                <div class="hidden lg:flex">
                    <a href="/" class="text-white hover:text-gold transition-colors duration-300">
                        Back
                    </a>
                </div>
                <!-- Mobile -->
                <div class="lg:hidden">
                    <button id="menu-toggle" class="text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <a href="/" class="block text-white hover:text-gold py-2">Back</a>
            </div>
        </div>
    </nav>

    <main class="min-h-screen flex items-center justify-center pt-24 pb-12 relative overflow-hidden">
        <!-- Background Slideshow -->
        <div class="absolute inset-0 z-0">
            <div class="hero-bg-slideshow absolute inset-0">
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('/images/slide1.jpg');"></div>
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('/images/slide2.jpg');"></div>
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('/images/slide3.jpg');"></div>
            </div>
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.90) 0%, rgba(45, 59, 97, 0.90) 100%);"></div>
        </div>

        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-transparent p-8 text-center">
                <h1 class="text-4xl font-bold text-white mb-4">I am Registering As...</h1>
                <p class="text-white mb-10">Choose your registration type to proceed to the next step.</p>

                <form action="{{ route('registration.processType') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">

                        <!-- Individual Delegate -->
                        <label class="cursor-pointer w-full">
                            <input type="radio" name="registration_type" value="Individual Delegate" class="hidden peer" required>
                            <div class="bg-white p-6 rounded-lg shadow-lg h-full flex flex-col items-center justify-center border-2 border-transparent peer-checked:ring-4 peer-checked:ring-gold peer-checked:border-gold transition-all duration-300 hover:shadow-xl hover:scale-105">
                                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-royal text-white mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <p class="text-xl font-semibold text-navy">Individual Delegate</p>
                            </div>
                        </label>

                        <!-- Delegation -->
                        <label class="cursor-pointer w-full">
                            <input type="radio" name="registration_type" value="Delegation" class="hidden peer">
                            <div class="bg-white p-6 rounded-lg shadow-lg h-full flex flex-col items-center justify-center border-2 border-transparent peer-checked:ring-4 peer-checked:ring-gold peer-checked:border-gold transition-all duration-300 hover:shadow-xl hover:scale-105">
                                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-royal text-white mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>

                                </div>
                                <p class="text-xl font-semibold text-navy">Delegation</p>
                                <p class="text-sm text-royal">(min. 4 people)</p>
                            </div>
                        </label>

                        <!-- Observer -->
                        <label class="cursor-pointer w-full">
                            <input type="radio" name="registration_type" value="Observer" class="hidden peer">
                            <div class="bg-white p-6 rounded-lg shadow-lg h-full flex flex-col items-center justify-center border-2 border-transparent peer-checked:ring-4 peer-checked:ring-gold peer-checked:border-gold transition-all duration-300 hover:shadow-xl hover:scale-105">
                                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-royal text-white mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <p class="text-xl font-semibold text-navy">Observer</p>
                            </div>
                        </label>
                    </div>

                    <div class="mt-12">
                        <button type="submit" class="w-full sm:w-auto bg-white hover:opacity-90 text-gray-900 font-bold py-4 px-10 rounded-lg transition duration-300 text-lg">
                            Next Step
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-navy py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
            <p>&copy; 2025 JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UKM UNEJ Model United Nations Club</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- 1. Background Slideshow (Kode Asli Anda, tidak diubah) ---
        const slides = document.querySelectorAll('.hero-bg-slideshow > div');
        let currentSlide = 0;
        if (slides.length > 0) {
            slides[0].classList.add('opacity-100');
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('opacity-100');
            }, 5000);
        }

        // --- 2. Toggle Mobile Nav (Kode Asli Anda, tidak diubah) ---
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        // Ditambahkan pengecekan agar tidak error jika elemen tidak ada
        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        // --- 3. Navbar Scroll Effect (Kode Baru yang Ditambahkan) ---
        const navbar = document.getElementById('navbar');
        // Ditambahkan pengecekan agar tidak error jika elemen #navbar tidak ada di halaman
        if (navbar) {
            // Membuat fungsi untuk menangani perubahan class navbar
            const handleNavbarScroll = () => {
                // Cek jika posisi scroll lebih dari 50px dari atas
                if (window.scrollY > 50) {
                    // Jika ya, tambahkan kelas warna dan bayangan
                    navbar.classList.add('bg-navy', 'shadow-lg');
                } else {
                    // Jika tidak (kembali ke atas), hapus kelas tersebut
                    navbar.classList.remove('bg-navy', 'shadow-lg');
                }
            };

            // Panggil fungsi saat halaman dimuat untuk mengatur kondisi awal
            handleNavbarScroll();

            // Panggil fungsi setiap kali pengguna melakukan scroll
            window.addEventListener('scroll', handleNavbarScroll);
        }

    });
</script>
</body>
</html>
