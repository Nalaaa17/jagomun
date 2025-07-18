<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - JAGOMUN</title>

    {{-- Menggunakan Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

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
        /* Styling untuk Toggle Switch */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #4f46e5; /* indigo-600 */
            background-color: #4f46e5;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #4f46e5; /* indigo-600 */
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-white bg-indigo-600 rounded-lg">
                    <i class="ri-dashboard-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-mail-line mr-3"></i>
                    <span>Messages</span>
                </a>
                <a href="{{ route('admin.referrals.index') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <i class="ri-share-forward-line mr-3"></i>
                    <span>Referrals</span>
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
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-6 bg-white border-b md:border-none">
                <div class="flex items-center">
                    <button id="menu-btn" class="text-gray-600 md:hidden mr-4">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                    <h1 class="text-2xl font-semibold">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Welcome, Admin!</span>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <!-- Stat Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Total Pendaftar</span>
                            <p class="text-3xl font-bold">{{ $registrations->count() }}</p>
                        </div>
                        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                            <i class="ri-team-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Pendaftar Terverifikasi</span>
                            <p id="verified-count" class="text-3xl font-bold">{{ $registrations->where('is_verified', true)->count() }}</p>
                        </div>
                        <div class="bg-green-100 text-green-600 p-3 rounded-full">
                            <i class="ri-checkbox-circle-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Total Delegasi</span>
                            <p class="text-3xl font-bold">{{ $registrations->sum('delegate_count') + $registrations->where('registering_as', '!=', 'Delegation')->count() }}</p>
                        </div>
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                            <i class="ri-user-star-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Total Pendapatan</span>
                            <p class="text-3xl font-bold">Rp{{ number_format($registrations->sum('total_price') / 1000000, 1) }} Jt</p>
                        </div>
                        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                            <i class="ri-wallet-3-line text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Registrations Table -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Daftar Pendaftar Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pendaftar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($registrations as $reg)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $reg->full_name ?? $reg->institution_name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $reg->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reg->registering_as }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($reg->package_type == 'Full Accommodation') bg-blue-100 text-blue-800
                                                @elseif($reg->package_type == 'Non-Accommodation') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $reg->package_type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($reg->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                                <input type="checkbox" name="toggle" id="toggle-{{ $reg->id }}"
                                                       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer verification-checkbox"
                                                       data-id="{{ $reg->id }}"
                                                       @if($reg->is_verified) checked @endif />
                                                <label for="toggle-{{ $reg->id }}" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                            </div>
                                            <span class="text-xs text-gray-500 status-text-{{ $reg->id }}">{{ $reg->is_verified ? 'Verified' : 'Pending' }}</span>
                                        </td>
                                        {{-- ====================================================================== --}}
                                        {{-- === AWAL PERUBAHAN: Menambahkan Jam dan Menit === --}}
                                        {{-- ====================================================================== --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reg->created_at->format('d M Y, H:i') }}</td>
                                        {{-- ====================================================================== --}}
                                        {{-- === AKHIR PERUBAHAN === --}}
                                        {{-- ====================================================================== --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-4">
                                                <a href="{{ route('admin.registration.detail', $reg->id) }}" class="text-indigo-600 hover:text-indigo-900" title="View Details"><i class="ri-eye-line"></i></a>
                                                <form action="{{ route('admin.registration.destroy', $reg->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete"><i class="ri-delete-bin-line"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada pendaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('menu-btn');
            const sidebar = document.querySelector('.sidebar');

            if(menuBtn) {
                menuBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                });
            }

            const checkboxes = document.querySelectorAll('.verification-checkbox');
            const verifiedCountEl = document.getElementById('verified-count');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const registrationId = this.dataset.id;
                    const isChecked = this.checked;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const statusText = document.querySelector(`.status-text-${registrationId}`);

                    fetch(`/admin/registrations/${registrationId}/toggle-verification`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            verified: isChecked
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if(data.success) {
                            statusText.textContent = isChecked ? 'Verified' : 'Pending';
                            if(verifiedCountEl) {
                                let currentCount = parseInt(verifiedCountEl.textContent);
                                if(isChecked) {
                                    verifiedCountEl.textContent = currentCount + 1;
                                } else {
                                    verifiedCountEl.textContent = currentCount - 1;
                                }
                            }
                        } else {
                            this.checked = !isChecked;
                            alert('Gagal memperbarui status dari server.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.checked = !isChecked;
                        alert('Terjadi kesalahan. Periksa koneksi atau hubungi developer.');
                    });
                });
            });
        });
    </script>
</body>
</html>
