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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
        }
        .accordion-content.open {
            max-height: 1000px;
            transition: max-height 1s ease-in-out;
        }
        .chevron {
            transition: transform 0.3s ease-in-out;
        }
        .chevron.open {
            transform: rotate(180deg);
        }

        .toggle-button {
            transition: all 0.3s ease;
        }
        .toggle-button.active {
            background-color: #2D3B61; /* bg-royal */
            color: #F2EFEA; /* text-ivory */
        }

        [data-tooltip] {
            position: relative;
            cursor: pointer;
        }
        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #1E2233; /* bg-navy */
            color: #F2EFEA;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            z-index: 10;
        }
        [data-tooltip]:hover::after {
            opacity: 1;
            visibility: visible;
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

                <div class="text-center mb-6">
                    <p class="text-royal italic">
                        All prices listed below are
                        <span class="font-bold text-gold not-italic">Early Bird</span>
                        rates.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-10">

                    <div class="bg-ivory p-1 rounded-full flex items-center space-x-1 border border-champagne">
                        <button id="btn-delegate" class="toggle-button role-toggle active px-5 py-2 rounded-full text-sm font-semibold text-royal" data-tooltip="Standard Delegate Package">
                            <i class="fas fa-users"></i>
                        </button>
                        <button id="btn-individual" class="toggle-button role-toggle px-5 py-2 rounded-full text-sm font-semibold text-royal" data-tooltip="Individual Registration">
                             <i class="fas fa-user"></i>
                        </button>
                        <button id="btn-observer" class="toggle-button role-toggle px-5 py-2 rounded-full text-sm font-semibold text-royal" data-tooltip="Observer/Faculty Advisor">
                             <i class="fas fa-eye"></i>
                        </button>
                        <button id="btn-student" class="toggle-button role-toggle px-5 py-2 rounded-full text-sm font-semibold text-royal" data-tooltip="Student Package">
                             <i class="fas fa-graduation-cap"></i>
                        </button>
                    </div>

                    <div class="bg-ivory p-1 rounded-full flex items-center space-x-1 border border-champagne">
                        <button id="btn-idr" class="toggle-button currency-toggle active px-6 py-2 rounded-full text-sm font-semibold text-royal">IDR</button>
                        <button id="btn-usd" class="toggle-button currency-toggle px-6 py-2 rounded-full text-sm font-semibold text-royal">USD</button>
                    </div>
                </div>

                <div class="space-y-4">

                    <div class="accordion-item bg-ivory border border-champagne rounded-lg">
                        <button class="accordion-trigger w-full flex justify-between items-center text-left p-6">
                            <span class="text-xl font-bold text-navy">Full Accommodation</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-semibold text-gold">
                                    <span class="price hidden" data-role="delegate" data-currency="idr">Rp 2.240.000</span>
                                    <span class="price hidden" data-role="delegate" data-currency="usd">$ 140</span>
                                    <span class="price hidden" data-role="individual" data-currency="idr">Rp 1.145.000</span>
                                    <span class="price hidden" data-role="individual" data-currency="usd">$ 73</span>
                                    <span class="price hidden" data-role="observer" data-currency="idr">Rp 1.200.000</span>
                                    <span class="price hidden" data-role="observer" data-currency="usd">$ 72</span>
                                    <span class="price hidden" data-role="student" data-currency="idr">Rp 1.200.000</span>
                                    <span class="price hidden" data-role="student" data-currency="usd">$ 72</span>
                                </span>
                                <svg class="chevron size-6 text-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="px-6 pb-6 text-royal border-t border-champagne">
                                <ul class="list-disc list-inside mt-4 space-y-2">
                                    <li>Hotel Accommodation (4 Days, 3 Nights)</li>
                                    <li>Transportation during the event</li>
                                    <li>Full Access to All Conference Sessions</li>
                                    <li>Delegate Kit & Certificate</li>
                                    <li>Full Meals</li>
                                    <li>Social Night Access</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-ivory border border-champagne rounded-lg">
                        <button class="accordion-trigger w-full flex justify-between items-center text-left p-6">
                            <span class="text-xl font-bold text-navy">Non-Accommodation</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-semibold text-gold">
                                    <span class="price hidden" data-role="delegate" data-currency="idr">Rp 990.000</span>
                                    <span class="price hidden" data-role="delegate" data-currency="usd">$ 62</span>
                                    <span class="price hidden" data-role="individual" data-currency="idr">Rp 505.000</span>
                                    <span class="price hidden" data-role="individual" data-currency="usd">$ 33</span>
                                    <span class="price hidden" data-role="observer" data-currency="idr">Rp 495.000</span>
                                    <span class="price hidden" data-role="observer" data-currency="usd">$ 32</span>
                                    <span class="price hidden" data-role="student" data-currency="idr">Rp 495.000</span>
                                    <span class="price hidden" data-role="student" data-currency="usd">$ 32</span>
                                </span>
                                <svg class="chevron size-6 text-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                            </div>
                        </button>
                         <div class="accordion-content">
                            <div class="px-6 pb-6 text-royal border-t border-champagne">
                                <ul class="list-disc list-inside mt-4 space-y-2">
                                    <li>Full Access to All Conference Sessions</li>
                                    <li>Delegate Kit & Certificate</li>
                                    <li>Full Meals</li>
                                    <li>Social Night Access</li>
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
                                    <span class="price hidden" data-role="delegate" data-currency="idr">Rp 180.000</span>
                                    <span class="price hidden" data-role="delegate" data-currency="usd">$ 12</span>
                                    <span class="price hidden" data-role="individual" data-currency="idr">Rp 95.000</span>
                                    <span class="price hidden" data-role="individual" data-currency="usd">$ 8</span>
                                    <span class="price hidden" data-role="observer" data-currency="idr">Rp 75.000</span>
                                    <span class="price hidden" data-role="observer" data-currency="usd">$ 5</span>
                                     <span class="price hidden" data-role="student" data-currency="idr">Rp 85.000</span>
                                    <span class="price hidden" data-role="student" data-currency="usd">$6</span>
                                </span>
                                <svg class="chevron size-6 text-navy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                            </div>
                        </button>
                         <div class="accordion-content">
                           <div class="px-6 pb-6 text-royal border-t border-champagne">
                                <ul class="list-disc list-inside mt-4 space-y-2">
                                    <li>Full Access to All Conference Sessions via Zoom/Platform</li>
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
            <p class="text-sm">Organized by UNEJ Model United Nations Club</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-navy', 'shadow-lg');
                } else {
                    navbar.classList.remove('bg-navy', 'shadow-lg');
                }
            });

            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            let activeRole = 'delegate';
            let activeCurrency = 'idr';

            const roleToggles = document.querySelectorAll('.role-toggle');
            const currencyToggles = document.querySelectorAll('.currency-toggle');

            function updatePrices() {
                document.querySelectorAll('.price').forEach(p => p.classList.add('hidden'));
                const selector = `.price[data-role="${activeRole}"][data-currency="${activeCurrency}"]`;
                document.querySelectorAll(selector).forEach(p => p.classList.remove('hidden'));
            }

            roleToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    activeRole = this.id.replace('btn-', '');
                    roleToggles.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    updatePrices();
                });
            });

            currencyToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    activeCurrency = this.id.replace('btn-', '');
                    currencyToggles.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    updatePrices();
                });
            });

            const accordionTriggers = document.querySelectorAll('.accordion-trigger');
            accordionTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const chevron = this.querySelector('.chevron');
                    content.classList.toggle('open');
                    chevron.classList.toggle('open');
                });
            });

            updatePrices();
        });
    </script>
</body>
</html>
