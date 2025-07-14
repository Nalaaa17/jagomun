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

                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover flex flex-col">
                        <div class="flex items-center mb-4">
                            <div class="h-20 w-20 flex-shrink-0 mr-4 flex items-center justify-center rounded-full bg-white shadow-sm">
                                <img src="https://tse3.mm.bing.net/th/id/OIP.QRGvfYVr95-0jZVT5Qmf4gHaHa?pid=Api&P=0&h=180"
                                     alt="UNEP Logo"
                                     class="h-12 w-12 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-navy">UNEP</h3>
                        </div>
                        <div class="flex-grow">
                            <p class="text-royal mb-4">The United Nations Environment Programme (UNEP), established in 1972 after the Stockholm Conference, serves as the leading global body for environmental action. Its mission includes monitoring environmental trends, supporting evidence-based policies, and coordinating international responses to ecological challenges. Over the years, UNEP has supported projects like pollution control in Serbia, flood protection in North Macedonia, and green economy efforts in Belarus. Yet today, the environmental crisis remains severe. Forests continue to disappear, waters are increasingly polluted, and the Global South bears the burden of a green transition it struggles to join. The climate emergency now reveals not only ecological danger but deep-rooted global inequality. Many of the systems driving the green economy still rely on exploitative practices. Without a course correction, the green transition risks repeating the injustices it claims to solve. UNEP must now lead with urgency and clarity. The time for bold, inclusive environmental action is now.</p>
                        </div>
                        <div>
                            <span class="block font-semibold text-gold"> • Topic : Bridging the Green Divide: Ensuring Equitable Access and Just Transitions In the Global Green Economy</span>
                            <span class="block font-semibold text-gold"> • Single Delegate</span>
                            <span class="block font-semibold text-gold"> • Level: Beginner</span>
                            <span class="block font-semibold text-gold"> • Venue: Offline</span>
                        </div>
                    </div>

                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover flex flex-col" style="animation-delay: 100ms;">
                        <div class="flex items-center mb-4">
                            <div class="h-20 w-20 flex-shrink-0 mr-4 flex items-center justify-center rounded-full bg-white shadow-sm">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeBKFnOyTd9ArXORpIJhqONLcTMJYpqCghMM6FzjQ_jdsn2FypvPBLw0mzSlguhq9WerQ&usqp=CAU"
                                     alt="UNHRC Logo"
                                     class="h-12 w-12 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-navy">UNHRC</h3>
                        </div>
                        <div class="flex-grow">
                            <p class="text-royal mb-4">The United Nations Human Rights Council, or UNHRC, was established in 2006 to protect and promote human rights globally. It replaced the former Commission on Human Rights and was created to respond to serious violations and support those whose rights are under threat. The council’s main mission is to uphold dignity and freedom for all people, regardless of identity or background. It brings together governments to discuss challenges and work toward shared solutions. Key responsibilities include investigating abuses, addressing urgent human rights situations, and conducting Universal Periodic Reviews to help countries improve. In a world where rights are still denied to many, its work is more urgent than ever.</p>
                        </div>
                        <div>
                            <span class="block font-semibold text-gold"> • Topic : Ensuring the Right to Gender Identity Recognition Across Borders</span>
                            <span class="block font-semibold text-gold"> • Single Delegate</span>
                            <span class="block font-semibold text-gold"> • Level: Beginner</span>
                            <span class="block font-semibold text-gold"> • Venue: Online</span>
                        </div>
                    </div>

                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover flex flex-col" style="animation-delay: 200ms;">
                         <div class="flex items-center mb-4">
                            <div class="h-20 w-20 flex-shrink-0 mr-4 flex items-center justify-center rounded-full bg-white shadow-sm">
                                <img src="https://tse3.mm.bing.net/th/id/OIP.U11ynEbQ70OF3eIQpiaufgHaHa?pid=Api&P=0&h=180"
                                     alt="IAEA Logo"
                                     class="h-12 w-12 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-navy">IAEA</h3>
                        </div>
                        <div class="flex-grow">
                             <p class="text-royal mb-4">The International Atomic Energy Agency (IAEA), founded in 1957 after President Eisenhower’s “Atoms for Peace” speech, promotes the peaceful use of nuclear energy while preventing the spread of nuclear weapons. The IAEA works to ensure that nuclear materials are not misused and do not pose threats to global security. In the Middle East, the IAEA has been involved in discussions and technical studies to support the creation of a Nuclear-Weapon-Free Zone (NWFZ). Since 1988, the agency has led consultations and encouraged states in the region to accept full-scope safeguards. These safeguards aim to ensure transparency and prevent the misuse of nuclear programs. Despite decades of dialogue, progress has been limited due to political disagreements over the terms of verification and obligations.</p>
                        </div>
                        <div>
                            <span class="block font-semibold text-gold"> • Topic : Establishing a Nuclear-Weapon-Free Zone (NWFZ) in the Middle East</span>
                            <span class="block font-semibold text-gold"> • Single Delegate</span>
                            <span class="block font-semibold text-gold"> • Level: Intermediate</span>
                            <span class="block font-semibold text-gold"> • Venue: Online</span>
                        </div>
                    </div>

                    <div class="bg-ivory rounded-2xl shadow-lg p-8 scroll-reveal card-hover flex flex-col" style="animation-delay: 300ms;">
                        <div class="flex items-center mb-4">
                           <div class="h-20 w-20 flex-shrink-0 mr-4 flex items-center justify-center rounded-full bg-white shadow-sm">
                                <img src="https://tse4.mm.bing.net/th/id/OIP.aNjw8-Xrz8JfQTRj2p_gOAHaG_?pid=Api&P=0&h=180"
                                     alt="NATO Logo"
                                     class="h-12 w-12 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-navy">NATO</h3>
                        </div>
                        <div class="flex-grow">
                            <p class="text-royal mb-4">Established on April 4, 1949, NATO is a political and military alliance founded to deter Soviet expansion, prevent the resurgence of militarism in Europe, and promote political integration across the Atlantic. Today, the Alliance includes 32 member states united by the principle of collective defense—an attack on one is considered an attack on all, as outlined in Article 5 of the North Atlantic Treaty. At its core, NATO functions through the North Atlantic Council (NAC), the highest decision-making body chaired by the Secretary General, where all decisions are made by consensus. While initially created to counter Cold War threats, NATO’s role has evolved to include crisis management, cybersecurity, counterterrorism, and cooperative security with global partners. In light of recent geopolitical tensions,  especially Russia’s aggression in Ukraine, NATO has expanded its military presence on the eastern flank, launched major joint exercises like Steadfast Dart and BALTOPS. NATO also emphasizes strategic flexibility and innovation to confront emerging challenges while upholding its core values of democracy, collective security, and transatlantic unity.</p>
                        </div>
                        <div>
                            <span class="block font-semibold text-gold"> • Topic : Establishing a Nuclear-Weapon-Free Zone (NWFZ) in the Middle East</span>
                            <span class="block font-semibold text-gold"> • Single Delegate</span>
                            <span class="block font-semibold text-gold"> • Level: Advanced</span>
                            <span class="block font-semibold text-gold"> • Venue: Online</span>
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
