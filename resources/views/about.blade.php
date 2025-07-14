<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - JAGOMUN 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan font Inter untuk tampilan yang bersih dan modern */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F2EFEA;
        }

        /* Konfigurasi warna kustom */
        .text-navy { color: #1E2233; }
        .text-royal { color: #2D3B61; }
        .bg-navy { background-color: #1E2233; }
        .bg-ivory { background-color: #F2EFEA; }
        .bg-royal { background-color: #2D3B61; }
        .text-gold { color: #B4976B; }
        .text-champagne { color: #D6C4A4; }
        .gradient-text {
            background: linear-gradient(135deg, #B4976B 0%, #D6C4A4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Kelas untuk animasi saat scroll */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Style untuk galeri foto agar ukurannya seragam */
        .gallery-item {
            position: relative;
            width: 100%;
            padding-bottom: 75%; /* Aspect Ratio 4:3 */
            overflow: hidden;
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
        }
        .gallery-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ini kunci agar gambar tidak gepeng */
            transition: transform 0.3s ease-in-out;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-ivory">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-8">
                <a href="#home">
                <img src="{{ asset('images/logo.png') }}"
                    alt="JAGOMUN 2025 Logo"
                    class="h-20 w-auto">
                </a>
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-white hover:text-gold transition-colors duration-300">Home</a>
                    <a href="{{ route('councils') }}" class="text-white hover:text-gold transition-colors duration-300">Councils</a>
                    <a href="{{ route('contact.index') }}" class="text-white hover:text-gold transition-colors duration-300">FAQ</a>
                    <a href="{{ route('packages') }}" class="text-white hover:text-gold transition-colors duration-300">Packages</a>
                </div>
                <div class="hidden lg:flex">
                    {{-- PERBAIKAN: Mengganti text-navy dengan text-gray-900 --}}
                    <a href="{{ route('registration.chooseType') }}" class="text-white hover:text-gold transition-colors duration-300">
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
        <div id="mobile-menu" class="lg:hidden hidden bg-navy/95 backdrop-blur-lg">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="/" class="mobile-link block px-3 py-2 text-white hover:text-gold">Home</a>
                <a href="{{ route('councils') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Councils</a>
                <a href="{{ route('contact.index') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">FAQ</a>
                <a href="{{ route('packages') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Packages</a>
                <a href="{{ route('registration.chooseType') }}" class="mmobile-link block px-3 py-2 text-white hover:text-gold">Register Now</a>
            </div>
        </div>
    </nav>

    <main>
        {{-- Hero Section untuk Halaman About --}}
        <div class="relative pt-24 pb-20 px-4 sm:px-6 lg:pt-32 lg:pb-28 lg:px-8 bg-royal text-white text-center">
            <div class="absolute inset-0 bg-navy opacity-50"></div>
            <div class="relative max-w-7xl mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl gradient-text">
                        Who Are We ?
                    </h1>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-champagne sm:mt-4">
                        Jember Annual Global Model United Nations (JAGOMUN)
                    </p>
                </div>
            </div>
        </div>

        {{-- Konten Utama Halaman About --}}
        <div class="bg-ivory py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Deskripsi Jagomun --}}
                <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12 mb-16 scroll-reveal">
                <div class="text-lg text-royal leading-relaxed text-justify">
                        <p class="mb-4">
                            Jember Annual Global Model United Nations (JAGOMUN) is an international level United Nations assembly simulation held at Jember, which aims to train young people in expressing opinions and acting as professional diplomats representing a country.
                        </p>
                        <p class="mb-4">
                            JAGOMUN starts in 2021 and has been held annually since. This year marks the fourth event of JAGOMUN. JAGOMUN 2025 is determined to shape young people to act professionally, especially in the fields of negotiation, diplomacy, argumentation, debate, leadership, and writing. The main concept presents the Best for the 2025 delegates to be able to have a pleasant, comfortable and beautiful experience with JAGOMUN because for its distinctiveness which always provides refreshments and an overall experience that is different from other MUN conferences.
                        </p>
                        <p>
                            JAGOMUN represents many issues in the Model United Nations conference, starting from human rights, city issues, and an many more. Adding to that, JAGOMUN offers various choices of council from beginners to expert level. JAGOMUN's Daisies and Officers are former mainstream JAGOMUN conferences that are also attended by national or international delegates.
                        </p>
                    </div>
                </div>

                {{-- Galeri Foto --}}
                <div class="scroll-reveal">
                    <h2 class="text-3xl font-bold text-navy text-center mb-10">Our Moments</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">

                        {{-- Ganti src dengan path gambar Anda --}}
                    <div class="gallery-item">
                    <img src="/images/moment1.jpg" alt="Jagomun Moment 1">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment2.jpg" alt="Jagomun Moment 2">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment3.jpg" alt="Jagomun Moment 3">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment4.jpg" alt="Jagomun Moment 4">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment5.jpg" alt="Jagomun Moment 5">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment6.jpg" alt="Jagomun Moment 6">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment7.jpg" alt="Jagomun Moment 7">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment8.jpg" alt="Jagomun Moment 8">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment9.jpg" alt="Jagomun Moment 9">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment10.jpg" alt="Jagomun Moment 9">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment11.jpg" alt="Jagomun Moment 9">
                    </div>
                    <div class="gallery-item">
                        <img src="/images/moment12.jpg" alt="Jagomun Moment 9">
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-navy py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
            <p>&copy; 2025 JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UNEJ Model United Nations Club</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Navbar Scroll Effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-navy', 'shadow-lg');
                } else {
                    navbar.classList.remove('bg-navy', 'shadow-lg');
                }
            });

            // Mobile Menu Toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Fungsi untuk animasi saat scroll
            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        scrollObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                scrollObserver.observe(el);
            });
        });
    </script>
</body>
</html>
