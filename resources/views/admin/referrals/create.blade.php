<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Referral Code - JAGOMUN Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        .sidebar { transition: transform 0.3s ease-in-out; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }
    </style>
</head>
<body class="text-gray-800">
    <div class="flex h-screen bg-gray-100">
        <aside class="sidebar fixed inset-y-0 left-0 bg-white w-64 p-6 shadow-lg z-20 md:relative md:translate-x-0">
            <div class="flex items-center mb-10">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-indigo-600">JAGOMUN</a>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-dashboard-line mr-3"></i><span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-mail-line mr-3"></i><span>Messages</span>
                </a>
                <a href="{{ route('admin.referrals.index') }}" class="flex items-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg">
                    <i class="ri-share-forward-line mr-3"></i><span>Referrals</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-file-excel-2-line mr-3"></i><span>Download Excel</span>
                </a>
            </nav>
            <div class="absolute bottom-6 left-6 right-6">
                <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 text-gray-600 bg-gray-200 hover:bg-red-100 hover:text-red-600 rounded-lg">
                    <i class="ri-logout-box-r-line mr-3"></i><span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-6 bg-white border-b md:border-none shadow-sm">
                <div class="flex items-center">
                    <button id="menu-btn" class="text-gray-600 md:hidden mr-4"><i class="ri-menu-line text-2xl"></i></button>
                    <h1 class="text-2xl font-semibold">Add New Referral Code</h1>
                </div>
                <div class="flex items-center space-x-4"><span class="text-sm">Welcome, Admin!</span></div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="bg-white p-8 rounded-xl shadow-md max-w-2xl mx-auto">
                    <form action="{{ route('admin.referrals.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Referral Code</label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. JAGOMUN25" required>
                                @error('code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="discount_amount" class="block text-sm font-medium text-gray-700">Discount Amount (Rp)</label>
                                <input type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="e.g. 50000" required>
                                @error('discount_amount')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="expires_at" class="block text-sm font-medium text-gray-700">Expires At (Optional)</label>
                                <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                                @error('expires_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" checked>
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">Set as Active</label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-4">
                            <a href="{{ route('admin.referrals.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save Code</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('menu-btn')?.addEventListener('click', () => {
                document.querySelector('.sidebar')?.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
