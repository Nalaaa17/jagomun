<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - JAGOMUN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#1E2233] relative">
    <!-- Background Image + Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.pexels.com/photos/1366957/pexels-photo-1366957.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
             alt="background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#1E2233] opacity-80"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-[#B4976B]/40 z-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Admin Panel</h1>
            <p class="text-[#B4976B] mt-2 text-sm">Secure Login Access</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100/80 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-white">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" required
                        class="mt-1 block w-full px-3 py-2 bg-[#1E2233]/60 text-white border border-[#B4976B]/50 rounded-md shadow-sm
                        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B4976B] focus:border-[#B4976B] sm:text-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full px-3 py-2 bg-[#1E2233]/60 text-white border border-[#B4976B]/50 rounded-md shadow-sm
                        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B4976B] focus:border-[#B4976B] sm:text-sm">
                </div>
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-md shadow-lg text-sm font-semibold
                               text-white bg-gradient-to-r from-[#B4976B] to-[#9c8159] hover:from-[#9c8159] hover:to-[#B4976B]
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B4976B]">
                        Sign In
                    </button>
                </div>
            </div>
        </form>

        <p class="text-center text-xs text-gray-300 mt-6">
            &copy; 2025 JAGOMUN. All rights reserved.
        </p>
    </div>
</body>
</html>
