<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pendaftaran - {{ $registration->full_name ?? $registration->institution_name }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .toggle-checkbox:checked {
            right: 0;
            border-color: #4F46E5; /* indigo-600 */
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #4F46E5; /* indigo-600 */
        }

        /* CSS untuk Lightbox */
        .lightbox {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            display: flex; justify-content: center; align-items: center;
            z-index: 1000; opacity: 0; visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            padding: 1rem;
        }
        .lightbox.active {
            opacity: 1; visibility: visible;
        }
        .lightbox-content {
            max-width: 95%; max-height: 95%;
        }
        .lightbox-content img {
            display: block; width: auto; max-height: 90vh;
            margin: 0 auto; border-radius: 0.5rem;
        }
        .lightbox-close {
            position: absolute; top: 20px; right: 30px;
            color: white; font-size: 3rem; font-weight: bold;
            cursor: pointer; opacity: 0.7; transition: opacity 0.2s ease;
        }
        .lightbox-close:hover {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div id="image-lightbox" class="lightbox">
        <span id="lightbox-close" class="lightbox-close">&times;</span>
        <div class="lightbox-content">
            <img id="lightbox-image" src="" alt="Gambar Diperbesar">
        </div>
    </div>

    {{-- Navbar Khusus Admin --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">JAGOMUN Admin</a>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900">Dashboard</a>
                    <a href="{{ route('admin.contacts.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900">Messages</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten Utama Halaman --}}
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Detail Pendaftaran</h1>
                    <p class="text-gray-500">Tinjau informasi lengkap untuk <span class="font-semibold text-indigo-600">{{ $registration->full_name ?? $registration->institution_name }}</span></p>
                </div>
                {{-- =============================================== --}}
                {{-- PERUBAHAN DI SINI: Menambahkan Tombol Hapus --}}
                {{-- =============================================== --}}
                <div class="flex items-center gap-4 bg-white p-3 rounded-lg shadow-sm border">
                    <span id="verification-status-text" class="font-semibold {{ $registration->is_verified ? 'text-green-600' : 'text-red-600' }}">
                        Status: {{ $registration->is_verified ? 'Telah Diverifikasi' : 'Belum Diverifikasi' }}
                    </span>
                    <button id="toggle-verification-button" class="px-4 py-2 text-sm font-medium text-white rounded-md transition-colors {{ $registration->is_verified ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-600 hover:bg-green-700' }}">
                        {{ $registration->is_verified ? 'Batal Verifikasi' : 'Verifikasi Sekarang' }}
                    </button>
                    <form action="{{ route('admin.registration.destroy', $registration->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this registration? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Umum</h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-4">
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">ID Registrasi</dt><dd class="text-gray-800 font-semibold">{{ $registration->id }}</dd></div>
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Daftar Sebagai</dt><dd class="text-gray-800">{{ $registration->registering_as }}</dd></div>
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Tipe Delegasi</dt><dd class="text-gray-800">{{ $registration->delegate_type ?? '-' }}</dd></div>
                        <div class="space-y-1">
                            <dt class="font-medium text-gray-500 text-sm">Jenis Paket</dt>
                            <dd class="text-gray-800 font-semibold">{{ $registration->package_type ?? 'N/A for Delegation' }}</dd>
                        </div>
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Nama Kontak</dt><dd class="text-gray-800">{{ $registration->full_name ?? '-' }}</dd></div>
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Email Kontak</dt><dd class="text-gray-800">{{ $registration->email ?? '-' }}</dd></div>
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">No. Telepon</dt><dd class="text-gray-800">{{ $registration->phone ?? '-' }}</dd></div>
                        <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Institusi</dt><dd class="text-gray-800">{{ $registration->institution_name ?? '-' }}</dd></div>
                        <div class="space-y-1">
                            <dt class="font-medium text-gray-500 text-sm">
                                @if(Str::contains($registration->delegate_type, 'National'))
                                    Domisili
                                @else
                                    Kewarganegaraan
                                @endif
                            </dt>
                            <dd class="text-gray-800">{{ $registration->nationality ?? '-' }}</dd>
                        </div>
                        <div class="space-y-1">
                            <dt class="font-medium text-gray-500 text-sm">Butuh Akomodasi</dt>
                            <dd class="font-semibold {{ $registration->do_you_need_accommodation ? 'text-green-600' : 'text-gray-700' }}">
                                {{ $registration->do_you_need_accommodation ? 'Ya' : 'Tidak' }}
                            </dd>
                        </div>
                        <div class="space-y-1">
                            <dt class="font-medium text-gray-500 text-sm">Metode Kehadiran</dt>
                            <dd class="font-medium">
                                @if($registration->attendance_type == 'Offline')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Offline</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Online</span>
                                @endif
                            </dd>
                        </div>
                        <div class="space-y-1 col-span-1 md:col-span-3"><dt class="font-medium text-gray-500 text-sm">Tanggal Daftar</dt><dd class="text-gray-800">{{ $registration->created_at->format('l, d F Y - H:i T') }}</dd></div>
                    </dl>
                </div>
            </div>

            @if($registration->registering_as == 'Individual Delegate' || $registration->registering_as == 'Observer')
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Preferensi Council</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <div class="space-y-4">
                            <div class="border-l-4 border-blue-500 pl-4">
                                <p class="font-semibold text-gray-800">Preferensi #1: {{ $registration->council_preference_1 ?? '-' }}</p>
                                <p class="text-sm text-gray-600">Negara: <span class="font-medium text-gray-700">{{ $registration->country_preference_1_1 ?? '-' }} & {{ $registration->country_preference_1_2 ?? '-' }}</span></p>
                                <p class="text-sm text-gray-500 mt-1 italic">"{{ $registration->reason_for_first_country_preference_1 ?? '-' }}" & "{{ $registration->reason_for_second_country_preference_1 ?? '-' }}"</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4">
                                <p class="font-semibold text-gray-800">Preferensi #2: {{ $registration->council_preference_2 ?? '-' }}</p>
                                <p class="text-sm text-gray-600">Negara: <span class="font-medium text-gray-700">{{ $registration->country_preference_2_1 ?? '-' }} & {{ $registration->country_preference_2_2 ?? '-' }}</span></p>
                                <p class="text-sm text-gray-500 mt-1 italic">"{{ $registration->reason_for_first_country_preference_2 ?? '-' }}" & "{{ $registration->reason_for_second_country_preference_2 ?? '-' }}"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Dokumen Pendukung</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2"><i class="ri-wallet-3-line align-middle mr-1"></i> Bukti Pembayaran</h3>
                        @if($registration->payment_proof_path && Storage::disk('public')->exists($registration->payment_proof_path))
                            <a href="{{ asset('storage/' . $registration->payment_proof_path) }}" class="lightbox-trigger">
                                <img src="{{ asset('storage/' . $registration->payment_proof_path) }}" alt="Bukti Pembayaran" class="w-full h-auto object-cover border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow cursor-pointer">
                            </a>
                        @else
                            <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada bukti pembayaran.</div>
                        @endif
                    </div>
                    @if($registration->registering_as != 'Delegation')
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2"><i class="ri-share-line align-middle mr-1"></i> Bukti Media Sosial</h3>
                        @if($registration->social_media_proof_path && Storage::disk('public')->exists($registration->social_media_proof_path))
                            <a href="{{ asset('storage/' . $registration->social_media_proof_path) }}" class="lightbox-trigger">
                                <img src="{{ asset('storage/' . $registration->social_media_proof_path) }}" alt="Bukti Medsos" class="w-full h-auto object-cover border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow cursor-pointer">
                            </a>
                        @else
                            <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada bukti media sosial.</div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            @if($registration->registering_as == 'Delegation')
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Anggota Delegasi <span class="text-base font-normal text-gray-500">({{ $registration->delegates->count() }} orang)</span></h2>
                </div>
                <div class="p-6 space-y-6">
                    @forelse($registration->delegates as $delegate)
                    <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-indigo-700 mb-6 border-b border-indigo-200 pb-3">
                            Delegasi #{{ $delegate->delegate_number }}: {{ $delegate->full_name }}
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-3">Informasi Personal</h4>
                                <dl class="text-sm grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-3">
                                    <div class="sm:col-span-1 font-medium text-gray-500">Email</div>
                                    <div class="sm:col-span-2 font-medium text-gray-800">{{ $delegate->email }}</div>

                                    <div class="sm:col-span-1 font-medium text-gray-500">Telepon</div>
                                    <div class="sm:col-span-2 font-medium text-gray-800">{{ $delegate->phone }}</div>

                                    <div class="sm:col-span-1 font-medium text-gray-500">
                                        @if(Str::contains($registration->delegate_type, 'National'))
                                            Domisili
                                        @else
                                            Kewarganegaraan
                                        @endif
                                    </div>
                                    <div class="sm:col-span-2 font-medium text-gray-800">{{ $delegate->nationality ?? '-' }}</div>

                                    <div class="sm:col-span-1 font-medium text-gray-500">Jenis Paket</div>
                                    <div class="sm:col-span-2 font-medium text-gray-800">{{ $delegate->package_type ?? '-' }}</div>

                                    <div class="sm:col-span-1 font-medium text-gray-500">Butuh Akomodasi</div>
                                    <div class="sm:col-span-2 font-medium text-gray-800">
                                        @if($delegate->do_you_need_accommodation)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ya</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak</span>
                                        @endif
                                    </div>
                                </dl>
                            </div>
                            <hr class="border-gray-200">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-3">Preferensi Council</h4>
                                <div class="space-y-4">
                                    <div class="border-l-4 border-blue-500 pl-4">
                                        <p class="font-semibold text-gray-800">Preferensi #1: {{ $delegate->council_preference_1 ?? '-' }}</p>
                                        <p class="text-sm text-gray-600">Negara: {{ $delegate->country_preference_1_1 ?? '-' }} & {{ $delegate->country_preference_1_2 ?? '-' }}</p>
                                        <p class="text-sm text-gray-500 italic">"{{ $delegate->reason_for_first_country_preference_1 ?? '-' }}" & "{{ $delegate->reason_for_second_country_preference_1 ?? '-' }}"</p>
                                    </div>
                                    <div class="border-l-4 border-green-500 pl-4">
                                        <p class="font-semibold text-gray-800">Preferensi #2: {{ $delegate->council_preference_2 ?? '-' }}</p>
                                        <p class="text-sm text-gray-600">Negara: {{ $delegate->country_preference_2_1 ?? '-' }} & {{ $delegate->country_preference_2_2 ?? '-' }}</p>
                                        <p class="text-sm text-gray-500 italic">"{{ $delegate->reason_for_first_country_preference_2 ?? '-' }}" & "{{ $delegate->reason_for_second_country_preference_2 ?? '-' }}"</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-gray-200">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-3">Bukti Media Sosial</h4>
                                @if($delegate->social_media_upload && Storage::disk('public')->exists($delegate->social_media_upload))
                                    <a href="{{ asset('storage/' . $delegate->social_media_upload) }}" class="lightbox-trigger inline-block">
                                        <img src="{{ asset('storage/' . $delegate->social_media_upload) }}" alt="Bukti Medsos Delegasi" class="h-48 w-auto object-contain border border-gray-200 bg-white p-1 rounded-md shadow-sm cursor-pointer hover:shadow-md transition-shadow">
                                    </a>
                                @else
                                    <p class="text-gray-400 text-sm italic">Tidak ada bukti.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada anggota delegasi yang terdaftar.</div>
                    @endforelse
                </div>
            </div>
            @endif

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LOGIKA UNTUK TOMBOL VERIFIKASI ---
            const toggleButton = document.getElementById('toggle-verification-button');
            const statusText = document.getElementById('verification-status-text');
            if (toggleButton && statusText) {
                toggleButton.addEventListener('click', function() {
                    const registrationId = "{{ $registration->id }}";
                    const nextStatus = !statusText.classList.contains('text-green-600');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch(`/admin/registrations/${registrationId}/toggle-verification`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ verified: nextStatus })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal memperbarui status');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const isVerified = nextStatus;
                            statusText.textContent = `Status: ${isVerified ? 'Telah Diverifikasi' : 'Belum Diverifikasi'}`;
                            statusText.classList.toggle('text-green-600', isVerified);
                            statusText.classList.toggle('text-red-600', !isVerified);

                            toggleButton.textContent = isVerified ? 'Batal Verifikasi' : 'Verifikasi Sekarang';
                            toggleButton.classList.toggle('bg-yellow-500', isVerified);
                            toggleButton.classList.toggle('hover:bg-yellow-600', isVerified);
                            toggleButton.classList.toggle('bg-green-600', !isVerified);
                            toggleButton.classList.toggle('hover:bg-green-700', !isVerified);
                        } else {
                            alert('Gagal memperbarui status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });
                });
            }

            // --- LOGIKA UNTUK LIGHTBOX GAMBAR ---
            const lightbox = document.getElementById('image-lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxClose = document.getElementById('lightbox-close');
            const imageTriggers = document.querySelectorAll('.lightbox-trigger');

            function openLightbox(e) {
                e.preventDefault();
                const imageUrl = this.getAttribute('href');
                lightboxImage.setAttribute('src', imageUrl);
                lightbox.classList.add('active');
            }

            function closeLightbox() {
                lightbox.classList.remove('active');
                lightboxImage.setAttribute('src', '');
            }

            imageTriggers.forEach(trigger => {
                trigger.addEventListener('click', openLightbox);
            });

            if (lightboxClose) {
                lightboxClose.addEventListener('click', closeLightbox);
            }

            if (lightbox) {
                lightbox.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeLightbox();
                    }
                });
            }
        });
    </script>

</body>
</html>
