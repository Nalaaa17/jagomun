<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAGOMUN 2025 - Jember Annual Global Model United Nations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script>
        // Konfigurasi Tailwind CSS untuk warna dan animasi kustom
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': '#1E2233',
                        'royal': '#2D3B61',
                        'gold': '#B4976B',
                        'champagne': '#D6C4A4',
                        'ivory': '#F2EFEA'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fadeInUp': 'fadeInUp 0.8s ease-out',
                        'slideInLeft': 'slideInLeft 0.8s ease-out',
                        'slideInRight': 'slideInRight 0.8s ease-out',
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 4s infinite'
                    }
                }
            }
        }
    </script>
    <style>
        /* Menggunakan font Inter untuk tampilan yang bersih dan modern */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Definisi Keyframes untuk animasi */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(1deg); }
            50% { transform: translateY(-20px) rotate(0deg); }
            75% { transform: translateY(-10px) rotate(-1deg); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Animasi untuk background slideshow */
        @keyframes imageFade {
            0% { opacity: 0; }
            15% { opacity: 1; }
            85% { opacity: 1; }
            100% { opacity: 0; }
        }

        /* Kelas utilitas untuk teks gradien */
        .gradient-text {
            background: linear-gradient(135deg, #B4976B 0%, #D6C4A4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Efek hover untuk kartu */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Efek glassmorphism untuk elemen transparan */
        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Animasi mengetik untuk judul utama */
        .typing-animation {
            overflow: hidden;
            border-right: 3px solid #B4976B;
            white-space: nowrap;
            /* Modifikasi: Sinkronisasi durasi animasi agar kursor menghilang tepat waktu */
            animation: typing 3.5s steps(40, end) forwards, blink-caret 0.5s step-end 0 forwards;
        }
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #B4976B }
        }

        /* Kelas untuk animasi saat scroll */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Carousel styles */
        .carousel-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
            will-change: transform;
        }
        .carousel-item {
            flex: 0 0 100%;
            white-space: nowrap;
        }
        @media (min-width: 768px) {
            .carousel-item {
                flex: 0 0 50%;
            }
        }
        @media (min-width: 1024px) {
            .carousel-item {
                flex: 0 0 33.333%;
            }
        }

        /* News Carousel specific styles */
        .news-carousel-container {
            display: flex;
            transition: transform 0.8s ease-in-out;
        }
        .news-carousel-item {
            flex: 0 0 100%;
            padding: 1rem;
            box-sizing: border-box;
            scroll-snap-align: start; /* For smooth scrolling behavior if manual scroll is enabled */
        }
    </style>
</head>
<body class="bg-ivory text-royal">
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-8">
                <a href="#home">
                <img src="{{ asset('images/logo.png') }}"
                    alt="JAGOMUN 2025 Logo"
                    class="h-20 w-auto">
                </a>
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#home" class="text-white hover:text-gold transition-colors duration-300">Home</a>
                    <a href="{{ route('about') }}" class="text-white hover:text-gold transition-colors duration-300">About</a>
                    <a href="#experience" class="text-white hover:text-gold transition-colors duration-300">Previously On</a>
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
                <a href="#home" class="mobile-link block px-3 py-2 text-white hover:text-gold">Home</a>
                <a href="{{ route('about') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">About</a>
                <a href="#experience" class="mobile-link block px-3 py-2 text-white hover:text-gold">Previously On</a>
                <a href="{{ route('councils') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Councils</a>
                <a href="{{ route('contact.index') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">FAQ</a>
                <a href="{{ route('registration.chooseType') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Register Now</a>
            </div>
        </div>
    </nav>

    <section id="home" class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="hero-bg-slideshow absolute inset-0">
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('/images/slide1.jpg');"></div>
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('/images/slide2.jpg');"></div>
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('/images/slide3.jpg');"></div>
            </div>
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 py-24 lg:py-32 flex flex-col justify-center min-h-screen">
            <div class="text-center animate-fadeInUp">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6">
                    <span class="block typing-animation mx-auto w-max max-w-full">JAGOMUN 2025</span>
                    <span class="block text-2xl md:text-3xl lg:text-4xl mt-4 gradient-text font-semibold">
                        Jember Annual Global Model United Nations
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-white/80 mb-12 max-w-4xl mx-auto leading-relaxed animate-slideInRight">
                    An international forum for young leaders to engage in diplomatic discourse, develop critical thinking, and address global challenges through the lens of the United Nations.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="{{ route('registration.chooseType') }}" class="group relative inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-navy bg-gradient-to-r from-gold to-champagne rounded-full hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <span class="mr-3">Register as Delegate</span>
                        {{-- <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg> --}}
                    </a>
                </div>
            </div>
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-8 h-8 text-white/70">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
    </section>

    <section id="news" class="py-20 scroll-reveal relative overflow-hidden" style="background-image: url('/images/komodo.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 z-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Latest <span class="gradient-text">News</span></h2> <p class="text-xl text-white max-w-4xl mx-auto">Stay updated with the latest announcements regarding JAGOMUN 2025.</p>
        </div>

        <div class="relative overflow-hidden">
            <div class="news-carousel-container" id="news-carousel-container">
                <div class="news-carousel-item bg-white/90 p-6 rounded-lg shadow-md border-b-4 border-gold">
                    <h3 class="text-xl font-semibold text-navy mb-2">Registration Opens Soon!</h3>
                    <p class="text-royal">Get ready! Delegate registration for JAGOMUN 2025 is set to open on July 1st, 2025. Prepare your applications and secure your spot early!</p>
                </div>
                <div class="news-carousel-item bg-white/90 p-6 rounded-lg shadow-md border-b-4 border-royal">
                    <h3 class="text-xl font-semibold text-navy mb-2">Early Bird Discount Announcement</h3>
                    <p class="text-royal">Exciting news! We'll be offering early bird discounts for the first 50 delegates who register. Don't miss out on this limited-time offer!</p>
                </div>
                <div class="news-carousel-item bg-white/90 p-6 rounded-lg shadow-md border-b-4 border-champagne">
                    <h3 class="text-xl font-semibold text-navy mb-2">Committee Topics Revealed Next Week!</h3>
                    <p class="text-royal">Curious about the topics? The detailed committee agendas for all councils will be released next week. Stay tuned to our social media for updates.</p>
                </div>
                <div class="news-carousel-item bg-white/90 p-6 rounded-lg shadow-md border-b-4 border-gold">
                    <h3 class="text-xl font-semibold text-navy mb-2">Partnership with Ministry of Education</h3>
                    <p class="text-royal">We are proud to announce our new partnership with the Ministry of Education to promote youth engagement in global affairs through JAGOMUN 2025.</p>
                </div>
                <div class="news-carousel-item bg-white/90 p-6 rounded-lg shadow-md border-b-4 border-royal">
                    <h3 class="text-xl font-semibold text-navy mb-2">Keynote Speaker Sneak Peek!</h3>
                    <p class="text-royal">We are thrilled to hint at a distinguished international figure joining us as a keynote speaker. More details to follow soon!</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="about" class="py-20 scroll-reveal relative overflow-hidden" style="background-image: url('/images/nusa.jpg'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 z-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
               <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Words of Remark from <br class="sm:hidden"/> <span class="gradient-text">Secretary General</span></h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
            <div class="lg:col-span-1">
                <div class="relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-gold to-champagne rounded-full transform rotate-3 -z-10"></div>
                    <img src="https://images.pexels.com/photos/3775164/pexels-photo-3775164.jpeg?auto=compress&cs=tinysrgb&w=600" class="relative rounded-full shadow-xl w-64 h-64 mx-auto object-cover" alt="Secretary General">
                </div>
            </div>
            <div class="lg:col-span-2 text-center lg:text-left">
                <h3 class="text-3xl font-bold text-white mb-2">Razita Zaafarani Zahran</h3>
                <p class="text-white mb-6">
                    "Youth are the main pioneers in bringing change to the world. The small steps taken by youth can mean a lot for the next 5-10 years. We hope that the Jember Annual Global Model United Nation help young people to realize their role in society. So, small movements and conference forums that we organize can contribute to the involvement of youth for future generations."
                </p>
            </div>
        </div>
    </div>
</section>

    <section id="experience" class="py-20 scroll-reveal relative overflow-hidden" style="background-image: url('/images/penida.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="absolute inset-0 z-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6"> Previously on <span class="gradient-text">JAGOMUN 2024</span>
            </h2>
            <p class="text-xl text-white max-w-4xl mx-auto">
                JAGOMUN 2024 was a great success, attracting 100+ delegates from 9 countries and receiving support from the Ministry of Foreign Affairs, UNHCR Indonesia, and many other distinguished institutions.
            </p>
        </div>

        <div class="relative z-0">
            <div class="overflow-hidden relative" id="carousel-wrapper">
                <div class="carousel-container" id="carousel-container">
                    <div class="carousel-item p-2">
                        <img src="/images/event1.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 1">
                        </div>
                    <div class="carousel-item p-2"><img src="/images/event2.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 2"></div>
                    <div class="carousel-item p-2"><img src="/images/event3.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 3"></div>
                    <div class="carousel-item p-2"><img src="/images/event4.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 4"></div>
                    <div class="carousel-item p-2"><img src="/images/event5.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 5"></div>
                    <div class="carousel-item p-2"><img src="/images/event6.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 6"></div>
                    <div class="carousel-item p-2"><img src="/images/event7.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 7"></div>
                    <div class="carousel-item p-2"><img src="/images/event8.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 8"></div>
                    <div class="carousel-item p-2"><img src="/images/event9.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 9"></div>
                    <div class="carousel-item p-2"><img src="/images/event10.jpg" class="rounded-xl shadow-lg w-full h-80 object-cover" alt="Event photo 10"></div>
                </div>
            </div>

            <button id="prevBtn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white/50 hover:bg-white p-3 rounded-full shadow-md z-20">
                <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="nextBtn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white/50 hover:bg-white p-3 rounded-full shadow-md z-20">
                <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
</section>


    <section id="councils" class="py-20 scroll-reveal relative overflow-hidden" style="background-image: url('/images/labuan.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 z-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.4));"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Available <span class="gradient-text">Councils</span></h2>
            <p class="text-xl text-white max-w-3xl mx-auto">Choose your committee and represent your assigned country in addressing critical global issues.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="group card-hover bg-ivory/90 rounded-2xl p-8 h-full shadow-lg border-b-4 border-royal">
                <h3 class="text-2xl font-bold text-navy mb-4">UN Security Council</h3>
                <p class="text-royal mb-6">Address international peace and security challenges with the power to make binding decisions.</p>
            </div>
            <div class="group card-hover bg-ivory/90 rounded-2xl p-8 h-full shadow-lg border-b-4 border-gold">
                <h3 class="text-2xl font-bold text-navy mb-4">UN General Assembly</h3>
                <p class="text-royal mb-6">Participate in the main deliberative organ where all UN member states have equal representation.</p>
            </div>
            <div class="group card-hover bg-ivory/90 rounded-2xl p-8 h-full shadow-lg border-b-4 border-royal">
                <h3 class="text-2xl font-bold text-navy mb-4">ECOSOC</h3>
                <p class="text-royal mb-6">Focus on economic and social development, sustainable development goals, and humanitarian issues.</p>
            </div>
            <div class="group card-hover bg-ivory/90 rounded-2xl p-8 h-full shadow-lg border-b-4 border-green-600">
                <h3 class="text-2xl font-bold text-navy mb-4">World Health Organization</h3>
                <p class="text-royal mb-6">Address global health challenges, pandemic preparedness, and health equity worldwide.</p>
            </div>
            <div class="group card-hover bg-ivory/90 rounded-2xl p-8 h-full shadow-lg border-b-4 border-blue-500">
                <h3 class="text-2xl font-bold text-navy mb-4">UNHCR</h3>
                <p class="text-royal mb-6">Work on protecting refugees, forcibly displaced communities, and stateless people.</p>
            </div>
            <div class="group card-hover bg-ivory/90 rounded-2xl p-8 h-full shadow-lg border-b-4 border-purple-500">
                <h3 class="text-2xl font-bold text-navy mb-4">UNESCO</h3>
                <p class="text-royal mb-6">Promote international cooperation in education, sciences, culture and communication.</p>
            </div>
        </div>
    </div>
</section>

    <section id="faq" class="py-20 scroll-reveal relative overflow-hidden" style="background-image: url('/images/raja.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 z-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));"></div>

    <div class="max-w-4xl mx-auto px-4 relative z-10"> <div class="text-center mb-16">
               <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Frequently Asked <span class="gradient-text">Questions</span></h2> <p class="text-xl text-white/90">Have questions? We've got answers.</p> </div>
        <div class="space-y-4">
            <div class="faq-item bg-white/80 p-6 rounded-lg shadow-md"> <button class="faq-question w-full text-left flex justify-between items-center">
                    <span class="text-lg font-semibold text-navy">Who can participate in JAGOMUN 2025?</span>
                    <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer hidden mt-4 text-royal">
                    JAGOMUN is open to all university students and high school students aged 17-25, regardless of their field of study. We welcome both beginners and experienced MUN delegates.
                </div>
            </div>
               <div class="faq-item bg-white/80 p-6 rounded-lg shadow-md"> <button class="faq-question w-full text-left flex justify-between items-center">
                    <span class="text-lg font-semibold text-navy">What is included in the registration fee?</span>
                    <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer hidden mt-4 text-royal">
                    The registration fee typically includes entry to all committee sessions, delegate kits, lunch for the conference days, and access to social events. Accommodation is not included unless specified in a package.
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="register" class="py-20" style="background: linear-gradient(135deg, #2D3B61 0%, #1E2233 100%);">
        <div class="max-w-4xl mx-auto px-4 text-center scroll-reveal">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Take Your Seat at the Table?</h2>
            <p class="text-xl text-champagne mb-12">
                Registration is now open. Secure your spot in one of the most anticipated MUN conferences of the year and start your journey toward becoming a global leader.
            </p>
            <a href="#" class="group relative inline-flex items-center justify-center px-10 py-4 text-xl font-semibold text-navy bg-gradient-to-r from-gold to-champagne rounded-full hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                Register Now
            </a>
        </div>
    </section>

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
            const mobileLinks = document.querySelectorAll('.mobile-link');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });

            // Scroll Reveal Animation
            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                scrollObserver.observe(el);
            });

            // Hero Background Slideshow
            const slides = document.querySelectorAll('.hero-bg-slideshow > div');
            let currentSlide = 0;
            if (slides.length > 0) {
                slides[0].classList.add('opacity-100');
                setInterval(() => {
                    slides[currentSlide].classList.remove('opacity-100');
                    currentSlide = (currentSlide + 1) % slides.length;
                    slides[currentSlide].classList.add('opacity-100');
                }, 5000); // Change image every 5 seconds
            }

            // Carousel "Previously On"
            const carouselContainer = document.getElementById('carousel-container');
            if (carouselContainer) {
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const items = carouselContainer.querySelectorAll('.carousel-item');
                const totalItems = items.length;
                let currentIndex = 0;

                function getVisibleItemsCount() {
                    const wrapperWidth = document.getElementById('carousel-wrapper').offsetWidth;
                    const itemWidth = items[0].offsetWidth;
                    return Math.round(wrapperWidth / itemWidth);
                }

                function updateCarousel() {
                    const itemWidth = items[0].offsetWidth;
                    const newTransform = -currentIndex * itemWidth;
                    carouselContainer.style.transform = `translateX(${newTransform}px)`;
                }

                function goToNextSlide() {
                    const visibleItems = getVisibleItemsCount();
                    currentIndex = (currentIndex + 1) % (totalItems - visibleItems + 1);
                    updateCarousel();
                }

                function goToPrevSlide() {
                    const visibleItems = getVisibleItemsCount();
                    currentIndex = (currentIndex - 1 + (totalItems - visibleItems + 1)) % (totalItems - visibleItems + 1);
                    updateCarousel();
                }

                nextBtn.addEventListener('click', goToNextSlide);
                prevBtn.addEventListener('click', goToPrevSlide);
                window.addEventListener('resize', updateCarousel);

                setInterval(goToNextSlide, 3000); // Auto-slide every 3 seconds

                updateCarousel(); // Initial render
            }

            // News Carousel (New Feature)
            const newsCarouselContainer = document.getElementById('news-carousel-container');
            if (newsCarouselContainer) {
                const newsItems = newsCarouselContainer.querySelectorAll('.news-carousel-item');
                let currentNewsIndex = 0;

                function updateNewsCarousel() {
                    const itemWidth = newsItems[0].offsetWidth;
                    // For a true "slide one at a time" where content might vary in width:
                    // You'd calculate the accumulated width of previous items.
                    // For simplicity with equal width items, just use index * itemWidth
                    newsCarouselContainer.style.transform = `translateX(${-currentNewsIndex * itemWidth}px)`;
                }

                function slideNews() {
                    currentNewsIndex = (currentNewsIndex + 1) % newsItems.length;
                    updateNewsCarousel();
                }

                // Set initial transform
                updateNewsCarousel();
                // Auto-slide every 4 seconds
                setInterval(slideNews, 4000);
            }


            // FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = question.querySelector('svg');

                question.addEventListener('click', () => {
                    const isOpen = !answer.classList.contains('hidden');
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.querySelector('.faq-answer').classList.add('hidden');
                            otherItem.querySelector('.faq-question svg').classList.remove('rotate-180');
                        }
                    });
                    answer.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });
        });
    </script>
</body>
</html>
