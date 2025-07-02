<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Packages - JAGOMUN 2025</title>

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
        .border-champagne { border-color: #D6C4A4; }
        .border-gold { border-color: #B4976B; }

        /* Custom styles for accordion transition */
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
        }
        .accordion-content.open {
            max-height: 1000px; /* Set a large enough max-height */
            transition: max-height 1s ease-in-out;
        }
        .chevron {
            transition: transform 0.3s ease-in-out;
        }
        .chevron.open {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-ivory">

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
                    <a href="{{ route('councils') }}" class="text-white hover:text-gold transition-colors duration-300">Councils</a>
                    <a href="{{ route('contact.index') }}" class="text-white hover:text-gold transition-colors duration-300">FAQ</a>
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
                <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-white hover:text-gold">FAQ</a>
                <a href="{{ route('registration.chooseType') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Register Now</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="relative pt-40 pb-20 px-4 sm:px-6 lg:pb-28 lg:px-8 bg-royal text-white text-center">
            <div class="absolute inset-0 bg-navy opacity-50"></div>
            <div class="relative max-w-4xl mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-3 text-gold">Our Packages</h1>
                    <p class="text-lg text-gray-300">Choose the best option that suits your needs for JAGOMUN 2025.</p>
                </div>
            </div>
        </div>

        <div class="bg-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                 <div class="flex justify-center mb-10">
                    <div class="bg-ivory p-1 rounded-full flex items-center space-x-1 border border-champagne">
                        <button id="btn-idr" class="currency-toggle active px-6 py-2 rounded-full text-sm font-semibold transition-colors text-royal">IDR</button>
                        <button id="btn-usd" class="currency-toggle px-6 py-2 rounded-full text-sm font-semibold transition-colors text-royal">USD</button>
                    </div>
                </div>
                <style>.currency-toggle.active { background-color: #2D3B61; color: #F2EFEA; }</style>


                <div class="space-y-4">

                    <div class="accordion-item bg-ivory border border-champagne rounded-lg">
                        <button class="accordion-trigger w-full flex justify-between items-center text-left p-6">
                            <span class="text-xl font-bold text-navy">Full Accommodation</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-semibold text-gold">
                                    <span class="price-idr">Rp 2.500.000</span>
                                    <span class="price-usd hidden">$ 165</span>
                                </span>
                                <svg class="chevron size-6 text-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="px-6 pb-6 text-royal border-t border-champagne">
                                <ul class="list-disc list-inside mt-4 space-y-2">
                                    <li>Hotel Accommodation (4 Days, 3 Nights)</li>
                                    <li>Airport/Station Transfer</li>
                                    <li>Transportation during the event</li>
                                    <li>Full Access to All Conference Sessions</li>
                                    <li>Delegate Kit & Certificate</li>
                                    <li>Coffee Breaks & Meals</li>
                                    <li>Social Night & Gala Dinner Access</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-ivory border border-champagne rounded-lg">
                        <button class="accordion-trigger w-full flex justify-between items-center text-left p-6">
                            <span class="text-xl font-bold text-navy">Non-Accommodation</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-semibold text-gold">
                                    <span class="price-idr">Rp 1.500.000</span>
                                    <span class="price-usd hidden">$ 99</span>
                                </span>
                                <svg class="chevron size-6 text-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="px-6 pb-6 text-royal border-t border-champagne">
                                <ul class="list-disc list-inside mt-4 space-y-2">
                                    <li>Full Access to All Conference Sessions</li>
                                    <li>Delegate Kit & Certificate</li>
                                    <li>Coffee Breaks & Meals</li>
                                    <li>Social Night & Gala Dinner Access</li>
                                    <li class="text-gray-500"><em>(Does not include hotel, airport transfer, and local transportation)</em></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-ivory border border-champagne rounded-lg">
                        <button class="accordion-trigger w-full flex justify-between items-center text-left p-6">
                            <span class="text-xl font-bold text-navy">Online Delegate</span>
                            <div class="flex items-center space-x-4">
                                 <span class="text-xl font-semibold text-gold">
                                    <span class="price-idr">Rp 500.000</span>
                                    <span class="price-usd hidden">$ 35</span>
                                </span>
                                <svg class="chevron size-6 text-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="px-6 pb-6 text-royal border-t border-champagne">
                                <ul class="list-disc list-inside mt-4 space-y-2">
                                    <li>Full Access to All Conference Sessions via Zoom/Platform</li>
                                    <li>Digital Delegate Kit</li>
                                    <li>E-Certificate</li>
                                    <li>Opportunity to win awards</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
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
        document.addEventListener('DOMContentLoaded', function() {

            // --- Navbar Scroll Effect ---
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-navy', 'shadow-lg');
                } else {
                    navbar.classList.remove('bg-navy', 'shadow-lg');
                }
            });

            // --- Mobile Menu Toggle ---
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // --- Logic for Currency Toggle ---
            const btnIdr = document.getElementById('btn-idr');
            const btnUsd = document.getElementById('btn-usd');
            const pricesIdr = document.querySelectorAll('.price-idr');
            const pricesUsd = document.querySelectorAll('.price-usd');

            function showCurrency(currency) {
                if (currency === 'idr') {
                    pricesIdr.forEach(p => p.classList.remove('hidden'));
                    pricesUsd.forEach(p => p.classList.add('hidden'));
                    btnIdr.classList.add('active');
                    btnUsd.classList.remove('active');
                } else { // usd
                    pricesIdr.forEach(p => p.classList.add('hidden'));
                    pricesUsd.forEach(p => p.classList.remove('hidden'));
                    btnUsd.classList.add('active');
                    btnIdr.classList.remove('active');
                }
            }

            btnIdr.addEventListener('click', () => showCurrency('idr'));
            btnUsd.addEventListener('click', () => showCurrency('usd'));


            // --- Logic for Accordion ---
            const accordionTriggers = document.querySelectorAll('.accordion-trigger');
            accordionTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const chevron = this.querySelector('.chevron');

                    content.classList.toggle('open');
                    chevron.classList.toggle('open');
                });
            });
        });
    </script>
</body>
</html>
