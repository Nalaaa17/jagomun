<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - JAGOMUN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center bg-cover" style="background-image: url('https://images.pexels.com/photos/1366957/pexels-photo-1366957.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
        <div class="absolute inset-0 bg-[#1E2233] opacity-70"></div>
        <div class="relative max-w-md w-full bg-white p-8 rounded-2xl shadow-xl z-10">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-[#1E2233]">Admin Panel Login</h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="username" name="username" type="text" autocomplete="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#B4976B] focus:border-[#B4976B] sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#B4976B] focus:border-[#B4976B] sm:text-sm">
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#1E2233] hover:bg-[#2D3B61] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B4976B]">
                            Sign in
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
