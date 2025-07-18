<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Councils - JAGOMUN 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F2EFEA; /* Ivory */
        }
        .text-navy { color: #1E2233; }
        .bg-navy { background-color: #1E2233; }
        .text-royal { color: #2D3B61; }
        .bg-royal { background-color: #2D3B61; }
        .text-gold { color: #B4976B; }
        .border-gold { border-color: #B4976B; }
        .text-champagne { color: #D6C4A4; }
        .gradient-text {
            background: linear-gradient(135deg, #B4976B 0%, #D6C4A4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        /* Efek hover untuk baris council */
        .council-row:hover {
            background-color: #F8F6F2; /* Sedikit lebih gelap dari Ivory */
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
                <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-white hover:text-gold">FAQ</a>
                <a href="{{ route('packages') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Packages</a>
                <a href="{{ route('registration.chooseType') }}" class="mobile-link block px-3 py-2 text-white hover:text-gold">Register Now</a>
            </div>
        </div>
    </nav>

    <main>
        {{-- Hero Section --}}
        <div class="relative pt-40 pb-24 px-4 sm:px-6 lg:pb-28 lg:px-8 bg-royal text-white text-center">
            <div class="absolute inset-0 bg-navy opacity-50"></div>
            <div class="relative max-w-7xl mx-auto">
                <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl gradient-text">
                    Our Councils
                </h1>
                <p class="mt-3 max-w-3xl mx-auto text-xl text-champagne sm:mt-4">
                    Explore the diverse range of committees at JAGOMUN 2025. Each council offers a unique platform to debate pressing global issues and shape the future.
                </p>
            </div>
        </div>

        {{-- Konten Utama Halaman Councils (Layout Baru) --}}
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="bg-ivory rounded-2xl shadow-lg overflow-hidden">

                    <!-- Council: UNEP -->
                    <div class="council-row p-8 border-b-2 border-champagne transition-colors duration-300 scroll-reveal">
                        <div class="md:flex md:items-start md:gap-8">
                            <div class="flex-shrink-0 md:w-1/4 mb-6 md:mb-0 text-center">
                                <img src="https://tse3.mm.bing.net/th/id/OIP.QRGvfYVr95-0jZVT5Qmf4gHaHa?pid=Api&P=0&h=180" alt="UNEP Logo" class="h-24 w-24 object-contain mx-auto mb-4 bg-white p-2 rounded-full shadow-md">
                                <h3 class="text-3xl font-bold text-navy">UNEP</h3>
                                <p class="text-sm text-royal font-medium">United Nations Environment Programme</p>
                                <div class="mt-4 space-y-1 text-sm">
                                    <span class="block font-semibold text-royal"><i class="ri-user-line align-middle text-gold"></i> Single Delegate</span>
                                    <span class="block font-semibold text-royal"><i class="ri-bar-chart-2-line align-middle text-gold"></i> Level: Beginner</span>
                                    <span class="block font-semibold text-royal"><i class="ri-building-4-line align-middle text-gold"></i> Venue: Offline</span>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <p class="text-royal mb-4 text-justify">The United Nations Environment Programme (UNEP), established in 1972, serves as the leading global body for environmental action. Its mission includes monitoring trends, supporting policies, and coordinating international responses. Yet today, the environmental crisis remains severe, revealing not only ecological danger but deep-rooted global inequality. UNEP must now lead with urgency and clarity.</p>
                                <div class="border-t-2 border-dashed border-champagne pt-4">
                                    <p class="font-semibold text-gold mb-2">Topic:</p>
                                    <h4 class="text-lg font-bold text-navy mb-4">Bridging the Green Divide: Ensuring Equitable Access and Just Transitions In the Global Green Economy</h4>

                                    {{-- Topic Preview Section --}}
                                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                                        <h5 class="font-semibold text-royal mb-2">Topic Preview:</h5>
                                        {{-- GANTI ISI DI BAWAH INI --}}
                                        <p class="text-sm text-gray-600 italic text-justify">As the world moves toward a greener future, not all countries are progressing equally. While the green economy is crucial to addressing climate change, it highlights clear gaps between developed and developing nations. Wealthier states lead in clean technologies, while many developing countries remain limited to supplying critical minerals like lithium and cobalt. These resources are often extracted under harmful conditions, causing deforestation and pollution, with little benefit returning to local communities. At the same time, many of these nations lack access to climate finance and do not have the institutions needed to join the transition fairly. This has created a Green Divide, where the Global South bears the costs but is left out of the progress. The current structure risks repeating old patterns of inequality under a new label. This committee must face that reality and work to change it. Delegates will explore how to strengthen cooperation, share green technologies, and make climate progress more just and inclusive. Only through fairness and solidarity can a truly sustainable future be achieved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Council: UNHRC -->
                    <div class="council-row p-8 border-b-2 border-champagne transition-colors duration-300 scroll-reveal">
                        <div class="md:flex md:items-start md:gap-8">
                            <div class="flex-shrink-0 md:w-1/4 mb-6 md:mb-0 text-center">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeBKFnOyTd9ArXORpIJhqONLcTMJYpqCghMM6FzjQ_jdsn2FypvPBLw0mzSlguhq9WerQ&usqp=CAU" alt="UNHRC Logo" class="h-24 w-24 object-contain mx-auto mb-4 bg-white p-2 rounded-full shadow-md">
                                <h3 class="text-3xl font-bold text-navy">UNHRC</h3>
                                <p class="text-sm text-royal font-medium">United Nations Human Rights Council</p>
                                <div class="mt-4 space-y-1 text-sm">
                                    <span class="block font-semibold text-royal"><i class="ri-user-line align-middle text-gold"></i> Single Delegate</span>
                                    <span class="block font-semibold text-royal"><i class="ri-bar-chart-2-line align-middle text-gold"></i> Level: Beginner</span>
                                    <span class="block font-semibold text-royal"><i class="ri-computer-line align-middle text-gold"></i> Venue: Online</span>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <p class="text-royal mb-4 text-justify">The UNHRC was established in 2006 to protect and promote human rights globally. It brings together governments to discuss challenges and work toward shared solutions. Key responsibilities include investigating abuses, addressing urgent human rights situations, and conducting Universal Periodic Reviews. In a world where rights are still denied to many, its work is more urgent than ever.</p>
                                <div class="border-t-2 border-dashed border-champagne pt-4">
                                    <p class="font-semibold text-gold mb-2">Topic:</p>
                                    <h4 class="text-lg font-bold text-navy mb-4">Ensuring the Right to Gender Identity Recognition Across Borders</h4>

                                    {{-- Topic Preview Section --}}
                                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                                        <h5 class="font-semibold text-royal mb-2">Topic Preview:</h5>
                                        {{-- GANTI ISI DI BAWAH INI --}}
                                        <p class="text-sm text-gray-600 italic text-justify">The right to legal gender recognition is a fundamental human right, and denying it can mean denying a person’s existence. For transgender and gender-diverse individuals, this recognition is essential to access education, healthcare, employment, and freedom of movement. Without it, many face discrimination, violence, and exclusion. The UNHRC has acknowledged this issue under the ICCPR, which guarantees recognition before the law, privacy, and protection from discrimination. Resolutions such as 27/32 and 32/2 have also affirmed the need to protect rights regardless of sexual orientation or gender identity, and led to the appointment of the Independent Expert on SOGI. However, many countries still lack fair and accessible laws for legal gender recognition. This leaves individuals vulnerable when traveling, studying, or seeking asylum due to mismatched documents. Legal uncertainty can lead to fear, rejection, or even statelessness. Delegates must now consider how international cooperation can ensure safe and equal recognition for all. This committee thus must act to uphold dignity, safety, and the right to live authentically across borders.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Council: IAEA -->
                    <div class="council-row p-8 border-b-2 border-champagne transition-colors duration-300 scroll-reveal">
                        <div class="md:flex md:items-start md:gap-8">
                            <div class="flex-shrink-0 md:w-1/4 mb-6 md:mb-0 text-center">
                                <img src="https://tse3.mm.bing.net/th/id/OIP.U11ynEbQ70OF3eIQpiaufgHaHa?pid=Api&P=0&h=180" alt="IAEA Logo" class="h-24 w-24 object-contain mx-auto mb-4 bg-white p-2 rounded-full shadow-md">
                                <h3 class="text-3xl font-bold text-navy">IAEA</h3>
                                <p class="text-sm text-royal font-medium">International Atomic Energy Agency</p>
                                <div class="mt-4 space-y-1 text-sm">
                                    <span class="block font-semibold text-royal"><i class="ri-user-line align-middle text-gold"></i> Single Delegate</span>
                                    <span class="block font-semibold text-royal"><i class="ri-bar-chart-2-line align-middle text-gold"></i> Level: Intermediate</span>
                                    <span class="block font-semibold text-royal"><i class="ri-computer-line align-middle text-gold"></i> Venue: Online</span>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <p class="text-royal mb-4 text-justify">The IAEA promotes the peaceful use of nuclear energy while preventing the spread of nuclear weapons. In the Middle East, the IAEA has been involved in discussions to support the creation of a Nuclear-Weapon-Free Zone (NWFZ). Despite decades of dialogue, progress has been limited due to political disagreements over verification and obligations.</p>
                                <div class="border-t-2 border-dashed border-champagne pt-4">
                                    <p class="font-semibold text-gold mb-2">Topic:</p>
                                    <h4 class="text-lg font-bold text-navy mb-4">Establishing a Nuclear-Weapon-Free Zone (NWFZ) in the Middle East</h4>

                                    {{-- Topic Preview Section --}}
                                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                                        <h5 class="font-semibold text-royal mb-2">Topic Preview:</h5>
                                        {{-- GANTI ISI DI BAWAH INI --}}
                                        <p class="text-sm text-gray-600 italic text-justify">The Middle East remains one of the most tense and complex regions in the world, where rivalries, unresolved conflicts, and nuclear tensions threaten both regional and global security. Central to this is the long-standing conflict between Israel, widely believed to possess undeclared nuclear weapons, and Iran, whose nuclear ambitions remain under intense international scrutiny. The concept of a Nuclear-Weapon-Free Zone (NWFZ) in the region, first proposed in 1974, has gained broad rhetorical support but little practical progress due to deep mistrust, power imbalances, and the absence of a regional security framework. Recent escalations, including military strikes and retaliatory actions, have intensified calls to address the risks of nuclear proliferation and potential arms races. This committee must assess </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Council: NATO -->
                    <div class="council-row p-8 transition-colors duration-300 scroll-reveal">
                        <div class="md:flex md:items-start md:gap-8">
                            <div class="flex-shrink-0 md:w-1/4 mb-6 md:mb-0 text-center">
                                <img src="https://tse4.mm.bing.net/th/id/OIP.aNjw8-Xrz8JfQTRj2p_gOAHaG_?pid=Api&P=0&h=180" alt="NATO Logo" class="h-24 w-24 object-contain mx-auto mb-4 bg-white p-2 rounded-full shadow-md">
                                <h3 class="text-3xl font-bold text-navy">NATO</h3>
                                <p class="text-sm text-royal font-medium">North Atlantic Treaty Organization</p>
                                <div class="mt-4 space-y-1 text-sm">
                                    <span class="block font-semibold text-royal"><i class="ri-user-line align-middle text-gold"></i> Single Delegate</span>
                                    <span class="block font-semibold text-royal"><i class="ri-bar-chart-2-line align-middle text-gold"></i> Level: Advanced</span>
                                    <span class="block font-semibold text-royal"><i class="ri-computer-line align-middle text-gold"></i> Venue: Online</span>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <p class="text-royal mb-4 text-justify">Established in 1949, NATO is a political and military alliance of 32 member states united by the principle of collective defense. While initially created to counter Cold War threats, NATO’s role has evolved to include crisis management, cybersecurity, and cooperative security. In light of recent geopolitical tensions, NATO emphasizes strategic flexibility and innovation to confront emerging challenges.</p>
                                <div class="border-t-2 border-dashed border-champagne pt-4">
                                    <p class="font-semibold text-gold mb-2">Topic:</p>
                                    <h4 class="text-lg font-bold text-navy mb-4">Ambiguity and Assurance: Navigating Eastern Security Commitments within the Alliance</h4>

                                    {{-- Topic Preview Section --}}
                                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                                        <h5 class="font-semibold text-royal mb-2">Topic Preview:</h5>
                                        {{-- GANTI ISI DI BAWAH INI --}}
                                        <p class="text-sm text-gray-600 italic text-justify">The ongoing Russia-Ukraine war remains a defining test for NATO’s unity, deterrence posture, and credibility in Eastern Europe. Following Russia’s full-scale invasion in 2022 and its continued occupation of Ukrainian territory, NATO has responded with increased military deployments, strengthened eastern defenses, and expanded support for Ukraine. Yet, divergent approaches, particularly the United States’ strategic ambiguity and bilateral diplomacy, have created uncertainty about the Alliance’s long-term commitment. As NATO formally recognizes Russia as a systemic and direct threat to Euro-Atlantic security, allies must navigate the tension between deterrence and escalation management. At the 2025 Hague Summit, leaders reaffirmed Article 5 and pledged to uphold a secure, rules-based order, but questions remain about how far the Alliance is willing to go to defend its eastern partners and maintain cohesion. This session challenges delegates to reconcile national interests with collective security, ensure credible assurance to eastern allies, and define NATO’s role in a shifting global power landscape.</p>
                                    </div>
                                </div>
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
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Scroll Reveal Animation
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
