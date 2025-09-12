<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Closed - JAGOMUN 2025</title>

    <!-- Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F2EFEA; /* Ivory background */
        }
        .bg-navy { background-color: #1E2233; }
        .text-gold { color: #B4976B; }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Navbar Section -->
    <nav class="bg-navy shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logo.png') }}" alt="JAGOMUN 2025 Logo" class="h-20 w-auto">
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main>
        <div class="flex items-center justify-center min-h-[calc(100vh-12rem)] py-12">
            <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-white shadow-xl rounded-lg p-8 transform transition-all hover:scale-105 duration-300">

                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="mx-auto h-24 w-24 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 9v2m0 4h.01M21 12A9 9 0 11 3 12a9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <!-- Heading -->
                    <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Registration Closed</h1>

                    <!-- Message -->
                    <p class="text-lg text-gray-600 leading-relaxed mb-8">
                        Registration for JAGOMUN 2025 is currently <span class="font-semibold">closed</span>.
                        Thank you for your interest and enthusiasm.
                        Please stay tuned for future announcements.
                    </p>

                    <!-- Action Button -->
                    <a href="{{ route('home') }}"
                       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg shadow-lg hover:shadow-xl">
                        Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-navy py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-white/70">
            <p>&copy; 2024 JAGOMUN. All Rights Reserved.</p>
            <p class="text-sm">Organized by UNEJ Model United Nations Club</p>
        </div>
    </footer>

</body>
</html>
