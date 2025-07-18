<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Referral Management - JAGOMUN Admin</title>
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
                    <h1 class="text-2xl font-semibold">Referral Code Management</h1>
                </div>
                <div class="flex items-center space-x-4"><span class="text-sm">Welcome, Admin!</span></div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('admin.referrals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm">
                        <i class="ri-add-line -ml-1 mr-2"></i>
                        Add New Code
                    </a>
                </div>

                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Discount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expires At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($referrals as $referral)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $referral->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($referral->discount_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $referral->expires_at ? $referral->expires_at->format('d M Y') : 'Never' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($referral->is_active)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-4">
                                            <a href="{{ route('admin.referrals.edit', $referral->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit"><i class="ri-pencil-line"></i> Edit</a>
                                            <form action="{{ route('admin.referrals.destroy', $referral->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this code?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete"><i class="ri-delete-bin-line"></i> Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-500">
                                        <div class="flex flex-col items-center"><i class="ri-coupon-3-line text-4xl text-gray-400 mb-2"></i>No referral codes found.</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-white border-t">
                            {{ $referrals->links() }}
                        </div>
                    </div>
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
