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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
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
            transition: transform 0.8s ease-in-out; /* Perhalus transisi */
            will-change: transform;
        }
        .carousel-item {
            flex: 0 0 100%;
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
        }

        /* [PERFORMA] MODIFIKASI UNTUK EFEK PARALLAX YANG LEBIH RINGAN */
        .parallax-section {
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .parallax-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            z-index: -1;
            /* Menggunakan background-attachment untuk efek parallax yang kompatibel */
            background-attachment: fixed;
        }
        #deck-container {
    perspective: 1500px; /* Tambahkan perspektif untuk efek 3D yang lebih baik */
    position: relative;
}

.deck-card {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 1.5rem; /* 24px */
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    /* Hapus transisi utama, kita akan kontrol dengan animasi */
    will-change: transform, opacity;
}

.deck-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* === KEYFRAMES UNTUK ANIMASI YANG LEBIH NYATA === */
@keyframes toss-away {
    0% { transform: translate3d(0, 0, 0) rotate(0); }
    30% { transform: translate3d(20%, -10%, 0) rotate(5deg) scale(1.05); } /* Angkat sedikit */
    100% { transform: translate3d(150%, 20%, -200px) rotate(35deg) scale(0.5); opacity: 0; } /* Lempar melengkung */
}

@keyframes return-from-side {
    0% { transform: translate3d(-150%, 0, -200px) rotate(-35deg) scale(0.7); opacity: 0; }
    70% { transform: translate3d(0, 0, 0) rotate(0) scale(1.05); opacity: 1; } /* Mendarat dengan overshoot */
    100% { transform: translate3d(0, 0, 0) scale(1); opacity: 1; }
}

@keyframes settle-in-front {
    0% { transform: translate3d(0, 2%, 0) scale(0.9); z-index: 2; }
    70% { transform: translate3d(0, 0, 0) scale(1.05); z-index: 3; }
    100% { transform: translate3d(0, 0, 0) scale(1); z-index: 3; }
}

@keyframes move-to-next {
    from { transform: translate3d(0, 0, 0) scale(1); z-index: 3;}
    to { transform: translate3d(0, 2%, 0) scale(0.9); z-index: 2;}
}

/* KELAS UNTUK MENGONTROL STATE & ANIMASI */
.card--active {
    transform: translate3d(0, 0, 0) scale(1);
    opacity: 1;
    z-index: 3;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.card--next {
    transform: translate3d(0, 2%, 0) scale(0.9);
    opacity: 1;
    z-index: 2;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.card--hidden {
    transform: translate3d(0, 4%, 0) scale(0.8);
    opacity: 0;
    z-index: 1;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s;
}

/* Kelas temporer untuk memicu animasi */
.is-tossing {
    animation: toss-away 0.7s forwards cubic-bezier(0.6, 0.04, 0.98, 0.335);
}
.is-returning {
    animation: return-from-side 0.7s forwards cubic-bezier(0.23, 1, 0.32, 1);
    z-index: 4 !important; /* Pastikan ia terbang di atas segalanya */
}
.is-settling {
    animation: settle-in-front 0.6s forwards cubic-bezier(0.23, 1, 0.32, 1);
}
.is-moving-back {
    animation: move-to-next 0.6s forwards cubic-bezier(0.23, 1, 0.32, 1);
}

/* CSS untuk Council Split-View */

/* Gaya untuk tombol menu di sisi kiri */
#menu-selector {
    /* Transisi untuk animasi sliding yang mulus di desktop */
    transition: top 0.4s cubic-bezier(0.4, 0, 0.2, 1), height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.council-menu-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem; /* Padding disesuaikan */
    border-radius: 0.75rem; /* 12px */
    position: relative;
    z-index: 10;
    cursor: pointer;
    transition: background-color 0.3s ease;

    /* Aturan untuk Mobile: Lebar item dan jangan menyusut */
    flex-shrink: 0;
    width: 180px; /* Lebar setiap item di barisan mobile */

    /* Aturan untuk Desktop: Kembali ke lebar penuh */
    md:width: 100%;
}

/* Hilangkan efek hover di desktop, karena sudah ada selector */
@media (min-width: 768px) {
    .council-menu-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
}

/* Gaya untuk menu yang sedang AKTIF */
.council-menu-item.active {
    /* Di Mobile: Beri background pada item itu sendiri */
    background-color: rgba(180, 151, 107, 0.2); /* bg-gold/20 */

    /* Di Desktop: Buat background transparan karena ada selector */
    md:bg-transparent;
}

/* Ubah warna teks judul saat aktif */
.council-menu-item.active .council-title {
    color: #D6C4A4; /* Warna champagne */
}

/* Gaya untuk panel konten detail di sisi kanan */
.council-detail-content {
    /* Default (Mobile): Sembunyikan sepenuhnya */
    display: none;
    padding: 1.5rem 1rem; /* Padding untuk mobile */
    background-color: rgba(45, 59, 97, 0.3); /* bg-royal/30 */
    border-radius: 1rem;
    animation: fadeIn 0.5s ease; /* Animasi fade-in sederhana */
}

/* Tampilkan HANYA panel yang aktif di mobile */
.council-detail-content.active {
    display: block;
}

/* Aturan untuk Desktop (md ke atas) */
@media (min-width: 768px) {
    .council-detail-content {
        /* Kembalikan ke posisi absolut untuk transisi samping */
        position: absolute;
        inset: 0;
        display: block; /* Tampilkan semua di DOM untuk transisi */
        padding: 2rem;
        background-color: transparent; /* Latar belakang diatur oleh parent di desktop */
        border-radius: 0;

        /* Atur ulang state default untuk transisi desktop */
        opacity: 0;
        transform: translateX(20px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        z-index: 1;
        pointer-events: none;
    }

    /* Aturan aktif untuk Desktop */
    .council-detail-content.active {
        opacity: 1;
        transform: translateX(0);
        z-index: 10;
        pointer-events: auto;
    }
    #council-display-panel {
    /* Memberi jarak 120px dari atas layar saat scroll otomatis. */
    /* Nilai ini bisa Anda sesuaikan (misal: 140px) agar pas dengan tinggi Navbar Anda. */
    scroll-margin-top: 120px;
    }
}

/* Keyframe untuk animasi fade-in sederhana di mobile */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
no-scrollbar::-webkit-scrollbar {
    display: none; /* Untuk Chrome, Safari, dan Opera */
}
.no-scrollbar {
    -ms-overflow-style: none;  /* Untuk IE dan Edge */
    scrollbar-width: none;  /* Untuk Firefox */
}
/* Tambahkan ini ke dalam tag <style> Anda */

.section-separator {
    position: relative;
}

.section-separator::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 1px;
    background: linear-gradient(to right,
        transparent,
        rgba(180, 151, 107, 0.35), /* Opacity sedikit dinaikkan agar lebih jelas */
        transparent
    );

    /* PERBAIKAN: Tambahkan z-index untuk mengangkat garis ke atas lapisan lain */
    z-index: 10;
}
    </style>
</head>
<body class="bg-ivory text-royal">
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-8">
                <a href="#home">
                    <img src="{{ asset('images/logo.png') }}" alt="JAGOMUN 2025 Logo" class="h-20 w-auto">
                </a>
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#home" class="text-white hover:text-gold transition-colors duration-300">Home</a>
                    <a href="{{ route('about') }}" class="text-white hover:text-gold transition-colors duration-300">About</a>
                    <a href="{{ route('councils') }}" class="text-white hover:text-gold transition-colors duration-300">Councils</a>
                    <a href="{{ route('contact.index') }}" class="text-white hover:text-gold transition-colors duration-300">FAQ</a>
                    <a href="{{ route('packages') }}" class="text-white hover:text-gold transition-colors duration-300">Packages</a>
                </div>
                <div class="hidden lg:flex">
                    <a href="{{ route('registration.chooseType') }}" class="text-white hover:text-gold transition-colors duration-300">Register Now</a>
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
                <a href="{{ route('councils') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Councils</a>
                <a href="{{ route('contact.index') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">FAQ</a>
                <a href="{{ route('packages') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Packages</a>
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
                        <span class="mr-3">Register Here</span>
                    </a>
                </div>
            </div>
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-white/70">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </section>

    <section id="news" class="py-24 bg-navy relative overflow-hidden parallax-section" style="--bg-image: url('/images/raja.jpg');">
    <div class="absolute inset-0 backdrop-blur-sm z-[-1]" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20 scroll-reveal">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                News <span class="gradient-text">JAGOMUN 2025</span>
            </h2>
        </div>

        <div class="relative">
            <div class="relative flex flex-col lg:flex-row justify-center items-center w-full gap-12 lg:gap-16">

                <div class="w-full lg:w-1/3 scroll-reveal">
                    <div class="relative text-center">
                        <div class="absolute left-1/2 -translate-x-1/2 -top-4 w-8 h-8 bg-royal border-4 border-gold rounded-full z-10 flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-gold text-xs"></i>
                        </div>
                        <div class="bg-royal/50 backdrop-blur-lg rounded-xl border border-gold/20 shadow-2xl shadow-black/20 overflow-hidden card-hover" style="--glow-color: 180, 151, 107;">
                            <div class="overflow-hidden">
                                <img src="https://images.pexels.com/photos/5625130/pexels-photo-5625130.jpeg" alt="Discount" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2">Early Bird Cashback </h3>
                                <p class="text-white/80 text-sm text-justify">Exciting news! We'll be offering early bird cashback for the first 5 delegates who register got cashback 5%!!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/3 scroll-reveal" style="transition-delay: 200ms;">
                    <div class="relative text-center">
                        <div class="absolute left-1/2 -translate-x-1/2 -top-4 w-8 h-8 bg-royal border-4 border-gold rounded-full z-10 flex items-center justify-center">
                            <i class="fas fa-book-open text-gold text-xs"></i>
                        </div>
                        <div class="bg-royal/50 backdrop-blur-lg rounded-xl border border-gold/20 shadow-2xl shadow-black/20 overflow-hidden card-hover" style="--glow-color: 180, 151, 107;">
                            <div class="overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2070&auto=format&fit=crop" alt="Topics" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2">Topics Revealed!</h3>
                                <p class="text-white/80 text-sm text-justify">Curious about the topics? The detailed information for all councils and their topics can be found in the “Council” menu.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

    <section id="about" class="py-24 bg-navy relative overflow-hidden parallax-section" style="--bg-image: url('/images/raja.jpg');">
    <div class="absolute inset-0 backdrop-blur-sm z-[-1]" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
    <div class="text-center mb-16 scroll-reveal">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Words of Remark from <br class="sm:hidden"/> <span class="gradient-text">Secretary General</span></h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12 items-center">

        <div class="lg:col-span-2 flex justify-center scroll-reveal" data-reveal="left">
            <div class="relative group">
                <div class="absolute -inset-3 bg-gradient-to-br from-gold to-champagne rounded-full transform-gpu transition-all duration-700 group-hover:rotate-12 group-hover:scale-105"></div>
                <div class="absolute -inset-3 rounded-full bg-[url('/images/awan.png')] bg-repeat opacity-10 z-0"></div>
                <img src="{{ asset('images/sg.png') }}" class="relative rounded-full shadow-2xl w-64 h-64 md:w-80 md:h-80 mx-auto object-cover border-4 border-navy z-10" alt="Secretary General">
            </div>
        </div>

        <div class="lg:col-span-3 scroll-reveal" data-reveal="right">
            <div class="bg-royal/50 backdrop-blur-xl rounded-2xl p-8 lg:p-10 border border-gold/20 shadow-2xl shadow-black/30 relative">

                <i class="fa-solid fa-quote-left text-7xl text-gold/20 absolute top-4 left-6 -z-10"></i>

                <h3 class="text-3xl font-bold text-white mb-4 relative z-10">Oktaviani Rosmala</h3>

                <div class="text-white/90 space-y-4 leading-relaxed">
                    <p class="font-semibold italic text-justify">
                        "It is with great pride and heartfelt enthusiasm to introducing Jember Annual Global Model United Nations (JAGOMUN) 2025.

                        This year’s theme, Bridging the Gap: Reimagining World Prosperity and Development Amid Shifting Global Forces,” calls upon us all to reflect, question, and act. We live in a time where global forces — from geopolitical tension — continue to reshape our shared future. In the face of uncertainty, the world needs bold, empathetic, and forward-thinking leaders more than ever.

                        And that is where youths take the voice and action!"

                    </p>

                    <p class="pt-4 border-t border-gold/20 text-justify">
                        At JAGOMUN, we believe that young people are not just future leaders — you are today’s changemakers. Your ideas, your passion, and your voice have the power to influence discourse, bridge global divides, and reimagine development that is inclusive and sustainable.

                        JAGOMUN is more than a simulation; it is a living, breathing space for youth to sharpen their diplomacy, build cross-cultural understanding, and take responsibility as global citizens.

                    </p>
                    <p class="text-justify">
                        This conference is your platform to grow, challenge perspectives, and become catalysts for real-world change. Whether you are speaking in committee sessions, drafting resolutions, or engaging in cultural exchange — your role here matters.

                        Welcome to JAGOMUN 2025 — where youth lead the conversation, diplomacy drives action, and the future begins with you

                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
</section>

    <section id="experience" class="py-24 bg-navy relative overflow-hidden parallax-section" style="--bg-image: url('/images/raja.jpg');">
    <div class="absolute inset-0 backdrop-blur-sm z-[-1]" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Previously on <span class="gradient-text">JAGOMUN 2024</span></h2>
            <p class="text-xl text-white/90 max-w-4xl mx-auto">
                JAGOMUN 2024 was a great success, attracting 100+ delegates from 9 countries and receiving support from many distinguished institutions.
            </p>
        </div>

        <div class="relative max-w-2xl mx-auto h-[450px] scroll-reveal" id="deck-container">
            </div>

        <div class="flex justify-center items-center gap-6 mt-8">
            <button id="prevBtnDeck" class="group w-16 h-16 bg-white/50 hover:bg-white border border-royal/20 rounded-full flex items-center justify-center transition-all duration-300 shadow-lg hover:scale-105">
                <i class="fas fa-arrow-left text-2xl text-royal transition-transform group-hover:-translate-x-1"></i>
            </button>
            <button id="nextBtnDeck" class="group w-16 h-16 bg-white/50 hover:bg-white border border-royal/20 rounded-full flex items-center justify-center transition-all duration-300 shadow-lg hover:scale-105">
                <i class="fas fa-arrow-right text-2xl text-royal transition-transform group-hover:translate-x-1"></i>
            </button>
        </div>
    </div>
</section>

   <section id="councils" class="py-24 bg-navy relative overflow-hidden parallax-section" style="--bg-image: url('/images/raja.jpg');">
    <div class="absolute inset-0 backdrop-blur-sm z-[-1]" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-12 scroll-reveal"> <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Available <span class="gradient-text">Councils</span></h2>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">Choose a committee to see the details and represent your assigned country.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:min-h-[550px]">

            <div class="md:col-span-4">
                <div id="council-menu-container" class="relative md:bg-royal/30 p-2 md:rounded-2xl flex md:block overflow-x-auto md:overflow-visible space-x-2 md:space-x-0 md:space-y-2 no-scrollbar">
                    <div id="menu-selector" class="hidden md:block absolute bg-gold/20 border border-gold rounded-xl z-0"></div>
                </div>
            </div>

            <div class="md:col-span-8 mt-4 md:mt-0"> <div id="council-display-panel" class="relative w-full md:h-full bg-royal/30 md:backdrop-blur-xl md:rounded-2xl md:border md:border-gold/20 md:shadow-2xl">
                    </div>
            </div>

        </div>
    </div>
</section>

    <section id="testimonials" class="py-24 bg-navy relative overflow-hidden parallax-section" style="--bg-image: url('/images/raja.jpg');">
        <div class="absolute inset-0 backdrop-blur-sm z-[-1]" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white">
                    Delegates <span class="gradient-text">Experience</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <div class="flex flex-col items-center text-center">
                    <blockquote class="text-lg text-ivory/90 leading-relaxed italic">
                        <p class="text-justify">"It was an opportunity to attend JAGOMUN 2024 as a delegate. One of the aspects that i really liked from jagomun2024 was the hard working hospitality crews, not only did we get to experience what a proper MUN is like but their to interact with the staffs especially them was a great experience itself!, at first i was already stunned and nervous by the new environment of Jember, but the welcoming greets from the hospitality crews really makes me feels welcomed there, not to mention that (IIRC) 2 nights after we arrived in the hotel, hospitality crews took me and my friends to roam the city and have fun, the event itself was really great!, its not exactly the usual MUN where i felt so pressured, something about the chair/co-chair and the room itself makes me feel so calm and respected, jagomun2024 was the best thing a MUN beginners can learn from and it was very memorable to me since i learned a lot and learned things outside the MUN experience itself, it was definitely definitely worth it."</p>
                    </blockquote>
                    <div class="mt-8 flex flex-col items-center">
                        <img class="h-40 w-40 rounded-full object-cover border-2 border-gold" src="{{ asset('images/muh.jpg') }}">
                        <div class="mt-4">
                            <p class="text-xl font-semibold text-champagne">Muhammad Randy Rustaman</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center text-center">
                         <blockquote class="text-lg text-ivory/90 leading-relaxed italic">
                            <p class="text-justify">"Based on my experience at JAGOMUN 2024, I was genuinely impressed by the entire committee, especially the Delegate Relations division. They made sure every aspect of the delegates' needs was well taken care of. I was one of the accommodation delegates, and from the moment they picked me up, they were incredibly helpful and welcoming. They even accompanied me to a souvenir shop to buy some traditional snacks from Jember, and brought me to explore the night market. What impressed me the most was they didn’t just support us as committee members, but also treated us like friends.
                                 Everything else like meals, hotel arrangements, and the whole event was excellent as well. Perhaps one small suggestion for this year is it might be even more helpful if delegates could be accompanied to the station, especially for those unfamiliar with the city. A little extra support like that would make the experience feel even more comfortable.
                                 So, if you’re considering getting the accommodation package, I highly recommend it. Go for it, and don’t hesitate! :))
                                 "</p>
                        </blockquote>
                    <div class="mt-8 flex flex-col items-center">
                        <img class="h-40 w-40 rounded-full object-cover border-2 border-gold" src="{{ asset('images/depi.jpg') }}">
                        <div class="mt-4">
                            <p class="text-xl font-semibold text-champagne">Depi Mulyani</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="faq" class="py-24 bg-navy relative overflow-hidden parallax-section section-separator" style="--bg-image: url('/images/raja.jpg');">
    <div class="absolute inset-0 backdrop-blur-sm z-[-1]" style="background: linear-gradient(135deg, rgba(30, 34, 51, 0.85) 0%, rgba(45, 59, 97, 0.85) 100%);"></div>

    <div class="max-w-4xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Frequently Asked <span class="gradient-text">Questions</span></h2>
            <p class="text-xl text-white/90">Have questions? We've got answers.</p>
        </div>

        <div class="space-y-4 scroll-reveal">
            <div class="faq-item bg-royal/40 backdrop-blur-lg p-6 rounded-xl border border-gold/20">
                <button class="faq-question w-full text-left flex justify-between items-center">
                    <span class="text-lg font-semibold text-white">Who can participate in JAGOMUN 2025?</span>
                    <svg class="w-6 h-6 transform transition-transform text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer hidden mt-4 text-white/80 leading-relaxed">
                    <p class="text-justify">JAGOMUN is open to all university students and high school students aged 15-25.</p>
                </div>
            </div>

            <div class="faq-item bg-royal/40 backdrop-blur-lg p-6 rounded-xl border border-gold/20">
                <button class="faq-question w-full text-left flex justify-between items-center">
                    <span class="text-lg font-semibold text-white">What is included in the registration fee?</span>
                    <svg class="w-6 h-6 transform transition-transform text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer hidden mt-4 text-white/80 leading-relaxed">
                    <p class="text-justify">The facilities provided will depend on the package delegate choose. If delegate register with the Accommodation Package, we will provide lodging and local transportation during your stay in Jember, along with meals and full access to all conference sessions. For those who choose the
                        Non-Accommodation Package we provide meals and full access to the conference, but accommodation and local transport are not included. Meanwhile, participants who register under the Online Packagewill receive full access to all conference sessions, materials, and activities virtually through our online platform.
                    </p>
                </div>
            </div>

            <div class="faq-item bg-royal/40 backdrop-blur-lg p-6 rounded-xl border border-gold/20">
                <button class="faq-question w-full text-left flex justify-between items-center">
                    <span class="text-lg font-semibold text-white">What social events are planned?</span>
                    <svg class="w-6 h-6 transform transition-transform text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer hidden mt-4 text-white/80 leading-relaxed">
                    <p class="text-justify">The event will commence with an Opening Ceremony,  featuring a talk show with distinguished speakers who are experts in their respective fields, accompanied by welcoming remarks delivered by prominent figures. The core of the event will be the Committee Sessions, where delegates will engage in structured debates, negotiations, and resolution drafting—simulating real diplomatic discussions. To encourage engagement and build meaningful connections among participants, the agenda will also include Social Nights and gala dinner, offering a space for informal interaction and camaraderie. The program will conclude with a Closing Ceremony and Awarding Session, which will be thoughtfully arranged and enhanced with entertainment segments to provide a memorable conclusion to the entire experience.</p>
                </div>
            </div>

            <div class="faq-item bg-royal/40 backdrop-blur-lg p-6 rounded-xl border border-gold/20">
                <button class="faq-question w-full text-left flex justify-between items-center">
                    <span class="text-lg font-semibold text-white">I'm a first-timer. Can I join?</span>
                    <svg class="w-6 h-6 transform transition-transform text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer hidden mt-4 text-white/80 leading-relaxed">
                    <p class="text-justify">Absolutely! JAGOMUN is open to delegates of all experience levels. We highly recommend beginner councils like UNEP or UNHCR for first-timers. Additionally, we will provide training materials and a workshop session to help you understand the Rules of Procedure and basic MUN concepts.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="register" class="py-20" style="background: linear-gradient(135deg, #2D3B61 0%, #1E2233 100%);">
        <div class="max-w-4xl mx-auto px-4 text-center scroll-reveal">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Are You Ready to Speak, Lead, and  Embrace your Diplomacy?</h2>
            <p class="text-xl text-champagne mb-12 text-justify">
                JAGOMUN 2025 registration is now open!  Don’t miss your chance to be part of the most anticipated and origin Model United Nations conference in East Java. Secure your seat at the table today!
            </p>
            <a href="#" class="group relative inline-flex items-center justify-center px-10 py-4 text-xl font-semibold text-navy bg-gradient-to-r from-gold to-champagne rounded-full hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                Register Now
            </a>
        </div>
    </section>

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
document.addEventListener('DOMContentLoaded', () => {

    // =========================================================================
    //  1. FUNGSI DASAR (NAVBAR, MOBILE MENU, FAQ, COUNCIL MODAL)
    // =========================================================================

    // --- Navbar & Mobile Menu ---
    const navbar = document.getElementById('navbar');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    window.addEventListener('scroll', () => {
        navbar.classList.toggle('bg-navy', window.scrollY > 50);
        navbar.classList.toggle('shadow-lg', window.scrollY > 50);
    }, { passive: true });

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        mobileMenu.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });
    }

    // --- FAQ Accordion ---
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question?.addEventListener('click', () => {
            const answer = item.querySelector('.faq-answer');
            const icon = question.querySelector('svg');
            const isOpen = !answer.classList.contains('hidden');

            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.querySelector('.faq-answer')?.classList.add('hidden');
                    otherItem.querySelector('.faq-question svg')?.classList.remove('rotate-180');
                }
            });

            answer?.classList.toggle('hidden', isOpen);
            icon?.classList.toggle('rotate-180', !isOpen);
        });
    });

   // GANTI SCRIPT COUNCIL MODAL LAMA ANDA DENGAN INI
// --- SCRIPT UNTUK COUNCIL SPLIT-VIEW ---
// GANTI BLOK SCRIPT COUNCIL SPLIT-VIEW LAMA ANDA DENGAN INI

// --- SCRIPT UNTUK COUNCIL SPLIT-VIEW (DENGAN RESPONSIVE FIX LENGKAP) ---
    // GANTI OBJEK councilData LAMA ANDA DENGAN VERSI LENGKAP INI

const councilData = {
    unep: {
        title: ' The United Nations Environment Programme', short_title: 'UNEP',
        logo: 'https://tse3.mm.bing.net/th/id/OIP.QRGvfYVr95-0jZVT5Qmf4gHaHa?pid=Api&P=0&h=180',
        description: 'The United Nations Environment Programme (UNEP), established in 1972 after the Stockholm Conference, serves as the leading global body for environmental action. Its mission includes monitoring environmental trends, supporting evidence-based policies, and coordinating international responses to ecological challenges. Over the years, UNEP has supported projects like pollution control in Serbia, flood protection in North Macedonia, and green economy efforts in Belarus. Yet today, the environmental crisis remains severe. Forests continue to disappear, waters are increasingly polluted, and the Global South bears the burden of a green transition it struggles to join. The climate emergency now reveals not only ecological danger but deep-rooted global inequality. Many of the systems driving the green economy still rely on exploitative practices. Without a course correction, the green transition risks repeating the injustices it claims to solve. UNEP must now lead with urgency and clarity. The time for bold, inclusive environmental action is now.',
        topics: ['Bridging the Green Divide: Ensuring Equitable Access and Just Transitions In the Global Green Economy'],
    },
    unhcr: {
        title: 'The United Nations Human Rights Council ', short_title: 'UNHRC',
        logo: 'https://tse3.mm.bing.net/th/id/OIP.pAA__exQqJL4rCgEfVfkBAHaHa?pid=Api&P=0&h=180',
        description: 'The United Nations Human Rights Council, or UNHRC, was established in 2006 to protect and promote human rights globally. It replaced the former Commission on Human Rights and was created to respond to serious violations and support those whose rights are under threat. The council’s main mission is to uphold dignity and freedom for all people, regardless of identity or background. It brings together governments to discuss challenges and work toward shared solutions. Key responsibilities include investigating abuses, addressing urgent human rights situations, and conducting Universal Periodic Reviews to help countries improve. The UNHRC has made major progress in defending LGBTQ+ rights through landmark resolutions and the creation of the Independent Expert on SOGI. Even today, discrimination and inequality remain widespread. The council plays a vital role in turning dialogue into action and holding states accountable. In a world where rights are still denied to many, its work is more urgent than ever.',
        // PERBAIKAN: Tanda kutip penutup ditambahkan di akhir kalimat.
        topics: ['Ensuring the Right to Gender Identity Recognition Across Borders'],
    },
    iaea: {
        title: ' The International Atomic Energy Agency', short_title: 'IAEA',
        logo: 'https://tse3.mm.bing.net/th/id/OIP.U11ynEbQ70OF3eIQpiaufgHaHa?pid=Api&P=0&h=180',
        description: 'The International Atomic Energy Agency (IAEA), founded in 1957 after President Eisenhower’s “Atoms for Peace” speech, promotes the peaceful use of nuclear energy while preventing the spread of nuclear weapons. The IAEA works to ensure that nuclear materials are not misused and do not pose threats to global security. In the Middle East, the IAEA has been involved in discussions and technical studies to support the creation of a Nuclear-Weapon-Free Zone (NWFZ). Since 1988, the agency has led consultations and encouraged states in the region to accept full-scope safeguards. These safeguards aim to ensure transparency and prevent the misuse of nuclear programs. Despite decades of dialogue, progress has been limited due to political disagreements over the terms of verification and obligations.',
        topics: ['Establishing a Nuclear-Weapon-Free Zone (NWFZ) in the Middle East'],
    },
    nato: {
        title: 'North Atlantic Treaty Organization ', short_title: 'NATO',
        logo: 'https://tse1.mm.bing.net/th/id/OIP.qqZSrlThAQTkTa0pBKVJTAHaGu?pid=Api&P=0&h=180',
        description: 'Established on April 4, 1949, NATO is a political and military alliance founded to deter Soviet expansion, prevent the resurgence of militarism in Europe, and promote political integration across the Atlantic. Today, the Alliance includes 32 member states united by the principle of collective defense—an attack on one is considered an attack on all, as outlined in Article 5 of the North Atlantic Treaty. At its core, NATO functions through the North Atlantic Council (NAC), the highest decision-making body chaired by the Secretary General, where all decisions are made by consensus. While initially created to counter Cold War threats, NATO’s role has evolved to include crisis management, cybersecurity, counterterrorism, and cooperative security with global partners. In light of recent geopolitical tensions,  especially Russia’s aggression in Ukraine, NATO has expanded its military presence on the eastern flank, launched major joint exercises like Steadfast Dart and BALTOPS. NATO also emphasizes strategic flexibility and innovation to confront emerging challenges while upholding its core values of democracy, collective security, and transatlantic unity.',
        topics: ['Ambiguity and Assurance: Navigating Eastern Security Commitments within the Alliance'],
    },
};

    const menuContainer = document.getElementById('council-menu-container');
    const displayPanel = document.getElementById('council-display-panel');
    const menuSelector = document.getElementById('menu-selector');

    if (menuContainer && displayPanel && menuSelector) {

        function moveSelector(targetElement) {
            if (!targetElement || window.innerWidth < 768) {
                menuSelector.style.display = 'none';
                return;
            };
            menuSelector.style.display = 'block';
            menuSelector.style.top = `${targetElement.offsetTop}px`;
            menuSelector.style.height = `${targetElement.offsetHeight}px`;
            menuSelector.style.left = `${targetElement.offsetLeft}px`;
            menuSelector.style.width = `${targetElement.offsetWidth}px`;
        }

        Object.keys(councilData).forEach((key, index) => {
            const council = councilData[key];

            const menuItem = document.createElement('button');
            menuItem.className = 'council-menu-item';
            menuItem.dataset.council = key;
            menuItem.innerHTML = `
                <img src="${council.logo}" alt="${council.short_title} Logo" class="h-10 w-10 mr-4 bg-white p-1 rounded-full object-contain flex-shrink-0">
                <div>
                    <h4 class="text-lg font-bold text-white transition-colors council-title">${council.short_title}</h4>
                </div>
            `;
            menuContainer.appendChild(menuItem);

            const contentPanel = document.createElement('div');
            contentPanel.className = 'council-detail-content';
            contentPanel.id = `detail-${key}`;
            contentPanel.innerHTML = `
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gold mb-2">About ${council.title}</h3>
                        <p class="text-white/80 leading-relaxed break-words text-justify">${council.description}</p>
                    </div>
                    <div class="bg-navy/50 p-4 rounded-lg">
                        <h4 class="font-bold text-white mb-3 flex items-center"><i class="fas fa-book-open mr-2 text-gold"></i>Topics of Discussion</h4>
                        <ul class="list-disc list-inside text-white/80 space-y-1">
                            ${council.topics.map(topic => `<li>${topic}</li>`).join('')}
                        </ul>
                    </div>
                </div>
            `;
            displayPanel.appendChild(contentPanel);

            if (index === 0) {
                menuItem.classList.add('active');
                contentPanel.classList.add('active');
                setTimeout(() => moveSelector(menuItem), 100);
            }
        });

        menuContainer.addEventListener('click', (e) => {
            const clickedItem = e.target.closest('.council-menu-item');
            if (!clickedItem) return;

            const councilId = clickedItem.dataset.council;
            moveSelector(clickedItem);

            menuContainer.querySelectorAll('.council-menu-item').forEach(item => item.classList.remove('active'));
            displayPanel.querySelectorAll('.council-detail-content').forEach(content => content.classList.remove('active'));

            clickedItem.classList.add('active');
            document.getElementById(`detail-${councilId}`).classList.add('active');

            // TIDAK ADA LAGI SCROLL OTOMATIS DI SINI
        });

        window.addEventListener('resize', () => {
            const activeItem = menuContainer.querySelector('.council-menu-item.active');
            moveSelector(activeItem);
        });
    }


    // =========================================================================
    //  2. EFEK VISUAL & ANIMASI
    // =========================================================================

    // --- Hero Background Slideshow ---
    const heroSlides = document.querySelectorAll('.hero-bg-slideshow > div');
    if (heroSlides.length > 0) {
        let currentHeroSlide = 0;
        heroSlides[0].classList.add('opacity-100');
        setInterval(() => {
            heroSlides[currentHeroSlide].classList.remove('opacity-100');
            currentHeroSlide = (currentHeroSlide + 1) % heroSlides.length;
            heroSlides[currentHeroSlide].classList.add('opacity-100');
        }, 5000);
    }

    // --- Parallax Background Loader ---
    document.querySelectorAll('.parallax-section').forEach(section => {
        const bgImage = section.style.getPropertyValue('--bg-image');
        if (bgImage) {
            const pseudoStyle = section.ownerDocument.createElement('style');
            pseudoStyle.innerHTML = `#${section.id}::before { background-image: ${bgImage}; }`;
            section.appendChild(pseudoStyle);
        }
    });

    // --- Slider Dek Kartu "Previously On" (VERSI ANIMASI BARU) ---
    const deckContainer = document.getElementById('deck-container');
    if (deckContainer) {
        const nextBtn = document.getElementById('nextBtnDeck');
        const prevBtn = document.getElementById('prevBtnDeck');
        const images = [
            '/images/event1.jpg', '/images/event2.jpg', '/images/event3.jpg',
            '/images/event4.jpg', '/images/event5.jpg', '/images/event6.jpg',
            '/images/event7.jpg', '/images/event8.jpg', '/images/event9.jpg', '/images/event10.jpg'
        ];

        let cards = [];
        let currentIndex = 0;
        let isAnimating = false;
        let autoPlayDeckInterval;

        function applyCardClasses() {
            const N = cards.length;
            cards.forEach((card, index) => {
                card.classList.remove('card--active', 'card--next', 'card--hidden', 'is-settling');
                if (index === currentIndex) {
                    card.classList.add('card--active');
                } else if (index === (currentIndex + 1) % N) {
                    card.classList.add('card--next');
                } else {
                    card.classList.add('card--hidden');
                }
            });
        }

        function initDeck() {
            images.forEach((src, index) => {
                const card = document.createElement('div');
                card.className = 'deck-card';
                card.innerHTML = `<img src="${src}" alt="Event photo ${index + 1}" loading="lazy">`;
                deckContainer.appendChild(card);
                cards.push(card);
            });
            applyCardClasses();
        }

        function handleNext() {
            if (isAnimating) return;
            isAnimating = true;
            const activeCard = cards[currentIndex];
            const nextCard = cards[(currentIndex + 1) % cards.length];
            activeCard.classList.add('is-tossing');
            nextCard.classList.add('is-settling');
            currentIndex = (currentIndex + 1) % cards.length;
            setTimeout(() => {
                activeCard.classList.remove('is-tossing');
                applyCardClasses();
                isAnimating = false;
            }, 700);
        }

        function handlePrev() {
            if (isAnimating) return;
            isAnimating = true;
            const N = cards.length;
            const prevIndex = (currentIndex - 1 + N) % N;
            const prevCard = cards[prevIndex];
            const activeCard = cards[currentIndex];
            activeCard.classList.add('is-moving-back');
            prevCard.classList.add('is-returning');
            currentIndex = prevIndex;
            setTimeout(() => {
                activeCard.classList.remove('is-moving-back');
                prevCard.classList.remove('is-returning');
                applyCardClasses();
                isAnimating = false;
            }, 700);
        }

        function startAutoPlayDeck() {
            stopAutoPlayDeck();
            autoPlayDeckInterval = setInterval(handleNext, 4000);
        }

        function stopAutoPlayDeck() {
            clearInterval(autoPlayDeckInterval);
        }

        nextBtn?.addEventListener('click', () => { stopAutoPlayDeck(); handleNext(); });
        prevBtn?.addEventListener('click', () => { stopAutoPlayDeck(); handlePrev(); });

        initDeck();
    }


    // =========================================================================
    //  3. MASTER INTERSECTION OBSERVER (Untuk semua animasi saat scroll)
    // =========================================================================
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.target.classList.contains('scroll-reveal')) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            }

            if (entry.target.id === 'experience') {
                if (entry.isIntersecting) {
                    if (typeof startAutoPlayDeck === 'function') startAutoPlayDeck();
                } else {
                    if (typeof stopAutoPlayDeck === 'function') stopAutoPlayDeck();
                }
            }
        });
    }, {
        threshold: 0.2
    });

    document.querySelectorAll('.scroll-reveal, #experience').forEach(el => {
        observer.observe(el);
    });

});
</script>
</body>
</html>
