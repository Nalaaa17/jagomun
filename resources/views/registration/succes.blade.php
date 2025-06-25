<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - JAGOMUN 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F2EFEA; /* Ivory */
        }
        .text-navy { color: #1E2233; }
        .bg-navy { background-color: #1E2233; }
        .text-royal { color: #2D3B61; }
        .text-gold { color: #B4976B; }
        .bg-gold { background-color: #B4976B; }
        .text-champagne { color: #D6C4A4; }
        .text-success { color: #22C55E; } /* green-500 */

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-ivory">

    <!-- Navigation -->
    <nav class="sticky top-0 w-full z-50 bg-navy shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <h1 class="text-2xl font-bold text-white">JAGOMUN</h1>
                    <p class="text-xs text-gold font-semibold pt-2">2025</p>
                </a>
            </div>
        </div>
    </nav>

    <main class="min-h-[80vh] flex items-center justify-center">
        <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white shadow-xl rounded-2xl p-8 sm:p-12 animate-fadeInUp">
                <div class="mb-6">
                    <svg class="mx-auto h-24 w-24 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold text-navy mb-4">Registration Successful!</h1>
                <p class="text-lg text-royal leading-relaxed mb-8">
                    Thank you for registering. Your data has been received and will be processed shortly.
                    <br>
                    Please check your email (including spam/junk folders) for confirmation and details on the next steps.
                </p>
                <a href="{{ route('home') }}" class="inline-block bg-gold hover:opacity-90 text-navy font-bold py-3 px-8 rounded-lg transition duration-300 text-lg">
                    Back to Homepage
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-navy py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-champagne">
            <p>&copy; 2025 JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UKM UNEJ Model United Nations Club</p>
        </div>
    </footer>

</body>
</html>
