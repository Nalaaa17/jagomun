<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Councils - JAGOMUN 2025</title>
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
        .bg-navy { background-color: #1E2233; }
        .text-royal { color: #2D3B61; }
        .bg-royal { background-color: #2D3B61; }
        .bg-ivory { background-color: #F2EFEA; }
        .text-gold { color: #B4976B; }
        .bg-gold { background-color: #B4976B; }
        .text-champagne { color: #D6C4A4; }
        .border-champagne { border-color: #D6C4A4; }
        .border-gold { border-color: #B4976B; }
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

        /* Efek hover untuk kartu */
        .card-hover {
            transition: all 0.3s ease-in-out;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
                    <a href="{{ route('about') }}" class="text-white hover:text-gold transition-colors duration-300">About</a>
                    <a href="{{ route('contact.index') }}" class="text-white hover:text-gold transition-colors duration-300">FAQ</a>
                    <a href="{{ route('packages') }}" class="text-white hover:text-gold transition-colors duration-300">Packages</a>
                </div>
                <div class="hidden lg:flex">
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
                <a href="/" class="block px-3 py-2 text-white hover:text-gold">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-white hover:text-gold">About</a>
                <a href="#" class="block px-3 py-2 text-white hover:text-gold">Councils</a>
                <a href="{{ route('packages') }}" class="block px-3 py-2 text-white hover:text-gold">Packages</a>
                <a href="{{ route('registration.chooseType') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Register Now</a>
            </div>
        </div>
    </nav>

    <main>
        {{-- Hero Section untuk Halaman Councils --}}
        <div class="relative pt-40 pb-20 px-4 sm:px-6 lg:pb-28 lg:px-8 bg-royal text-white text-center">
        <div class="absolute inset-0 bg-navy opacity-50"></div>
        <div class="relative max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl gradient-text">
                    Our Councils
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-champagne sm:mt-4">
                    Explore the diverse range of committees at JAGOMUN 2025. Each council offers a unique platform to debate pressing global issues.
                </p>
            </div>
        </div>
        </div>

        {{-- Konten Utama Halaman Councils --}}
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Card Dewan 1: UNSC -->
                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover">
                        <h3 class="text-3xl font-bold text-navy mb-3">UN Security Council</h3>
                        <p class="text-royal mb-4">The UNSC is the primary body for maintaining international peace and security. Delegates in this advanced committee will tackle high-stakes crises, deliberate on sanctions, and authorize peacekeeping missions. This council demands sharp negotiation skills and a deep understanding of geopolitical dynamics.</p>
                        <span class="font-semibold text-gold">Level: Advanced</span>
                    </div>

                    <!-- Card Dewan 2: ECOSOC -->
                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover" style="animation-delay: 100ms;">
                        <h3 class="text-3xl font-bold text-navy mb-3">ECOSOC</h3>
                        <p class="text-royal mb-4">The Economic and Social Council is at the heart of the UN's work on sustainable development. Delegates will formulate policies on economic, social, and environmental issues, working towards achieving the Sustainable Development Goals (SDGs) and fostering international cooperation for development.</p>
                        <span class="font-semibold text-gold">Level: Intermediate</span>
                    </div>

                    <!-- Card Dewan 3: WHO -->
                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover" style="animation-delay: 200ms;">
                        <h3 class="text-3xl font-bold text-navy mb-3">World Health Organization</h3>
                        <p class="text-royal mb-4">As the leading authority on international health, the WHO directs and coordinates responses to global health emergencies. Delegates will address topics like pandemic preparedness, vaccine equity, and strengthening health systems in developing nations.</p>
                        <span class="font-semibold text-gold">Level: Intermediate</span>
                    </div>

                    <!-- Card Dewan 4: UNHCR -->
                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover" style="animation-delay: 300ms;">
                        <h3 class="text-3xl font-bold text-navy mb-3">UNHCR</h3>
                        <p class="text-royal mb-4">The UN Refugee Agency is mandated to protect and support refugees. In this council, delegates will focus on the rights and well-being of displaced persons, addressing issues of asylum, resettlement, and finding durable solutions to refugee crises worldwide.</p>
                        <span class="font-semibold text-gold">Level: Beginner - Intermediate</span>
                    </div>

                    <!-- Card Dewan 5: UNESCO -->
                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover" style="animation-delay: 400ms;">
                        <h3 class="text-3xl font-bold text-navy mb-3">UNESCO</h3>
                        <p class="text-royal mb-4">The United Nations Educational, Scientific and Cultural Organization seeks to build peace through international cooperation. Topics will range from protecting world heritage sites and promoting freedom of expression to advancing science for sustainable development.</p>
                        <span class="font-semibold text-gold">Level: Beginner</span>
                    </div>

                    <!-- Card Dewan 6: UN General Assembly (DISEC) -->
                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover" style="animation-delay: 500ms;">
                        <h3 class="text-3xl font-bold text-navy mb-3">UN General Assembly (DISEC)</h3>
                        <p class="text-royal mb-4">As the First Committee of the UNGA, DISEC deals with disarmament and threats to peace that affect the international community. Delegates will discuss issues like nuclear non-proliferation, the arms trade, and preventing an arms race in outer space.</p>
                        <span class="font-semibold text-gold">Level: Beginner</span>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-navy py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
            <p>&copy; 2025 JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UKM UNEJ Model United Nations Club</p>
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
