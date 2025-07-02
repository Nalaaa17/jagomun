<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Choose Delegate Type - JAGOMUN 2025</title>

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
        .border-gold { border-color: #B4976B; }
        .ring-gold { --tw-ring-color: #B4976B; }
    </style>
</head>
<body class="bg-navy">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-navy shadow-lg" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-8">
                <a href="#home">
                <img src="{{ asset('images/logo.png') }}"
                        alt="JAGOMUN 2025 Logo"
                        class="h-20 w-auto">
                </a>

                <div class="lg:hidden">
                    <button id="menu-toggle" class="text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <div class="hidden lg:flex" id="nav-links">
                    <a href="{{ route('registration.chooseType') }}" class="flex items-center text-white hover:text-gold transition-colors duration-300 font-semibold">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg> --}}
                        Back
                    </a>
                </div>
            </div>

            <div id="mobile-menu" class="lg:hidden hidden px-4 pb-4">
                <a href="{{ route('registration.chooseType') }}" class="block text-white hover:text-gold transition-colors duration-300 font-semibold py-2">
                    Back
                </a>
            </div>
        </div>
    </nav>

    <main class="min-h-screen flex items-center justify-center pt-24 pb-12 relative overflow-hidden">
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
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-royal text-white mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-10">
                Registering as [{{ $type ?? 'Delegate' }}]<br>
                Where are you from?
            </h1>

            <form action="{{ route('registration.processDelegateType') }}" method="POST">
                @csrf
                <input type="hidden" name="parent_type" value="{{ $type ?? 'Individual Delegate' }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-items-center">
                    <label class="cursor-pointer w-full">
                        <input type="radio" name="delegate_type" value="@if($type == 'Observer')National Observer @else National Delegate @endif" class="hidden peer" required>
                        <div class="bg-white p-6 rounded-lg shadow-lg h-full flex flex-col items-center justify-center border-2 border-transparent peer-checked:ring-4 peer-checked:ring-gold peer-checked:border-gold transition-all duration-300 hover:shadow-xl hover:scale-105">
                            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-royal text-white mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </div>
                            <p class="text-xl font-semibold text-navy">
                                @if($type == 'Observer')
                                    National Observer
                                @else
                                    National Delegate
                                @endif
                            </p>
                        </div>
                    </label>

                    <label class="cursor-pointer w-full">
                        <input type="radio" name="delegate_type" value="@if($type == 'Observer')International Observer @else International Delegate @endif" class="hidden peer">
                        <div class="bg-white p-6 rounded-lg shadow-lg h-full flex flex-col items-center justify-center border-2 border-transparent peer-checked:ring-4 peer-checked:ring-gold peer-checked:border-gold transition-all duration-300 hover:shadow-xl hover:scale-105">
                            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-royal text-white mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
                                </svg>
                            </div>
                            <p class="text-xl font-semibold text-navy">
                                @if($type == 'Observer')
                                    International Observer
                                @else
                                    International Delegate
                                @endif
                            </p>
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
