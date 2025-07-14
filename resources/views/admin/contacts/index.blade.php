<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Contact Messages</title>

    {{-- Menggunakan Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Menggunakan Alpine.js dari CDN untuk interaktivitas --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Ikon dari Remix Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* gray-100 */
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="text-gray-800">

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="sidebar fixed inset-y-0 left-0 bg-white w-64 p-6 shadow-lg z-20 md:relative md:translate-x-0">
            <div class="flex items-center mb-10">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-indigo-600">JAGOMUN</a>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-2.5 text-white bg-indigo-600 rounded-lg">
                    <i class="ri-mail-line mr-3"></i>
                    <span>Messages</span>
                </a>
                <a href="{{ route('admin.registrations.export') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-file-excel-2-line mr-3"></i>
                    <span>Download Excel</span>
                </a>
            </nav>
            <div class="absolute bottom-6 left-6 right-6">
                <a href="{{ route('admin.login') }}" class="flex items-center justify-center w-full px-4 py-2.5 text-gray-600 bg-gray-200 hover:bg-red-100 hover:text-red-600 rounded-lg">
                    <i class="ri-logout-box-r-line mr-3"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden" x-data="{ showModal: false, messageDetails: {} }">
            <header class="flex justify-between items-center p-6 bg-white border-b md:border-none">
                <div class="flex items-center">
                    <button id="menu-btn" class="text-gray-600 md:hidden mr-4">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                    <h1 class="text-2xl font-semibold">Contact Messages</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Welcome, Admin!</span>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($messages as $message)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $message->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-sm truncate" title="{{ $message->message }}">{{ Str::limit($message->message, 70) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button @click="showModal = true; messageDetails = {{ json_encode($message) }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                                                <i class="ri-eye-line mr-1"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No messages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $messages->links() }}
                    </div>
                </div>
            </main>

            <!-- Modal untuk menampilkan detail pesan -->
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed z-30 inset-0 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen text-center p-4">
                    <div @click="showModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <div x-show="showModal" x-transition class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Message from <span x-text="messageDetails.name"></span></h3>
                                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                                    <i class="ri-close-line text-2xl"></i>
                                </button>
                            </div>
                            <div class="mt-4 space-y-4">
                                <p class="text-sm text-gray-600"><strong>Email:</strong> <a :href="'mailto:' + messageDetails.email" class="text-indigo-600" x-text="messageDetails.email"></a></p>
                                <p class="text-sm text-gray-600"><strong>Received:</strong> <span x-text="new Date(messageDetails.created_at).toLocaleString('id-ID', { dateStyle: 'full', timeStyle: 'short' })"></span></p>
                                <div class="mt-2 pt-4 border-t">
                                    <p class="text-sm font-medium text-gray-700">Message:</p>
                                    <p class="text-base text-gray-800 whitespace-pre-wrap mt-1" x-text="messageDetails.message"></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse items-center">
                             <form :action="'/admin/contacts/' + messageDetails.id" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                            </form>
                            <button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('menu-btn');
            const sidebar = document.querySelector('.sidebar');

            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
