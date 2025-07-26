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
                    <p class="text-gray-500">Tinjau informasi lengkap untuk <span class="font-semibold text-indigo-600">{{ $registration->registering_as == 'Delegation' ? $registration->institution_name : $registration->full_name }}</span></p>
                </div>
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

            @if($registration->registering_as == 'Delegation')
                {{-- Tampilan untuk Delegasi --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Ringkasan Delegasi</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6">
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Institusi</dt><dd class="text-gray-800 font-semibold text-lg">{{ $registration->institution_name }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Jumlah Delegasi</dt><dd class="text-gray-800 font-semibold">{{ $registration->delegate_count }} Orang</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Jenis Paket</dt><dd class="text-gray-800 font-semibold">{{ $registration->package_type ?? 'N/A' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Total Harga</dt><dd class="text-indigo-600 font-semibold text-lg">Rp {{ number_format($registration->total_price, 0, ',', '.') }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Kontak Utama</dt><dd class="text-gray-800">{{ $registration->full_name ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Email Kontak</dt><dd class="text-gray-800">{{ $registration->email ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Telepon Kontak</dt><dd class="text-gray-800">{{ $registration->phone ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Referral Code</dt><dd class="text-gray-800 font-semibold">{{ $registration->partnership_code ?? '-' }}</dd></div>
                        </dl>
                    </div>
                </div>

                @foreach($registration->delegates as $delegate)
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Detail Delegasi #{{ $loop->iteration }}: <span class="text-indigo-700">{{ $delegate->full_name }}</span></h2>
                    </div>
                    <div class="p-6 space-y-8">
                        {{-- Detail Personal per Delegasi --}}
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-4">Personal Information</h3>
                            <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6">
                                <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Email</dt><dd class="text-gray-800">{{ $delegate->email ?? '-' }}</dd></div>
                                <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">No. Telepon</dt><dd class="text-gray-800">{{ $delegate->phone ?? '-' }}</dd></div>
                                <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Tanggal Lahir</dt><dd class="text-gray-800">{{ $delegate->date_of_birth ? \Carbon\Carbon::parse($delegate->date_of_birth)->format('d F Y') : '-' }}</dd></div>
                                <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Usia</dt><dd class="text-gray-800">{{ $delegate->age ?? '-' }}</dd></div>
                                <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Gender</dt><dd class="text-gray-800">{{ $delegate->gender ?? '-' }}</dd></div>
                                <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Kebangsaan</dt><dd class="text-gray-800">{{ $delegate->nationality ?? '-' }}</dd></div>
                                <div class="space-y-1 lg:col-span-3"><dt class="font-medium text-gray-500 text-sm">Alamat Lengkap</dt><dd class="text-gray-800 whitespace-normal">{{ $delegate->full_address ?? '-' }}</dd></div>
                            </dl>
                        </div>
                        <hr>
                        {{-- Preferensi Council per Delegasi --}}
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-4">Council Preferences</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <p class="font-semibold text-gray-800">Preferensi #1: {{ $delegate->council_preference_1 ?? '-' }}</p>
                                    <p class="text-sm text-gray-600">Negara: <span class="font-medium text-gray-700">{{ $delegate->country_preference_1_1 ?? '-' }} & {{ $delegate->country_preference_1_2 ?? '-' }}</span></p>
                                    <p class="text-sm text-gray-500 mt-1 italic">Alasan: "{{ $delegate->reason_for_council_preference_1 ?? '-' }}"</p>
                                </div>
                                <div class="border-l-4 border-green-500 pl-4">
                                    <p class="font-semibold text-gray-800">Preferensi #2: {{ $delegate->council_preference_2 ?? '-' }}</p>
                                    <p class="text-sm text-gray-600">Negara: <span class="font-medium text-gray-700">{{ $delegate->country_preference_2_1 ?? '-' }} & {{ $delegate->country_preference_2_2 ?? '-' }}</span></p>
                                    <p class="text-sm text-gray-500 mt-1 italic">Alasan: "{{ $delegate->reason_for_council_preference_2 ?? '-' }}"</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Dokumen & Konfirmasi per Delegasi --}}
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-4">Dokumen & Konfirmasi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2 text-sm"><i class="ri-profile-line align-middle mr-1"></i> ID Pelajar</h4>
                                    @if($delegate->student_id_path && Storage::disk('public')->exists($delegate->student_id_path))
                                        <a href="{{ asset('storage/' . $delegate->student_id_path) }}" target="_blank" class="block text-center p-4 bg-blue-50 hover:bg-blue-100 border-2 border-dashed rounded-lg text-blue-700 font-semibold">Lihat PDF</a>
                                    @else
                                        <div class="text-center py-6 border-2 border-dashed rounded-lg text-gray-400">Tidak ada</div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2 text-sm"><i class="ri-parent-line align-middle mr-1"></i> Izin Orang Tua</h4>
                                    @if($delegate->parental_consent_path && Storage::disk('public')->exists($delegate->parental_consent_path))
                                        <a href="{{ asset('storage/' . $delegate->parental_consent_path) }}" target="_blank" class="block text-center p-4 bg-blue-50 hover:bg-blue-100 border-2 border-dashed rounded-lg text-blue-700 font-semibold">Lihat PDF</a>
                                    @else
                                        <div class="text-center py-6 border-2 border-dashed rounded-lg text-gray-400">Tidak ada</div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2 text-sm"><i class="ri-share-line align-middle mr-1"></i> Bukti Media Sosial</h4>
                                    @if($delegate->social_media_proof_path && Storage::disk('public')->exists($delegate->social_media_proof_path))
                                        <a href="{{ asset('storage/' . $delegate->social_media_proof_path) }}" class="lightbox-trigger">
                                            <img src="{{ asset('storage/' . $delegate->social_media_proof_path) }}" alt="Bukti Medsos" class="w-full h-20 object-cover border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow cursor-pointer">
                                        </a>
                                    @else
                                        <div class="text-center py-6 border-2 border-dashed rounded-lg text-gray-400">Tidak ada</div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="flex items-center gap-4">
                                    <i class="ri-checkbox-circle-line text-2xl {{ $delegate->info_confirmation ? 'text-green-500' : 'text-gray-400' }}"></i>
                                    <div>
                                        <h4 class="font-semibold text-gray-700">Konfirmasi Informasi</h4>
                                        <p class="text-sm text-gray-500">{{ $delegate->info_confirmation ? 'Dikonfirmasi' : 'Belum dikonfirmasi' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <i class="ri-shield-check-line text-2xl {{ $delegate->data_usage_agreement ? 'text-green-500' : 'text-gray-400' }}"></i>
                                    <div>
                                        <h4 class="font-semibold text-gray-700">Persetujuan Data</h4>
                                        <p class="text-sm text-gray-500">{{ $delegate->data_usage_agreement ? 'Disetujui' : 'Belum disetujui' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Bukti Pembayaran Utama Delegasi --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Bukti Pembayaran Delegasi</h2>
                    </div>
                    <div class="p-6">
                        @if($registration->payment_proof_path && Storage::disk('public')->exists($registration->payment_proof_path))
                            <a href="{{ asset('storage/' . $registration->payment_proof_path) }}" class="lightbox-trigger">
                                <img src="{{ asset('storage/' . $registration->payment_proof_path) }}" alt="Bukti Pembayaran" class="w-full md:w-1/2 lg:w-1/3 object-cover border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow cursor-pointer">
                            </a>
                        @else
                            <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada bukti pembayaran.</div>
                        @endif
                    </div>
                </div>

            @else
                {{-- Tampilan untuk Individual / Observer --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Informasi Pendaftar</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6">
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">ID Registrasi</dt><dd class="text-gray-800 font-semibold">{{ $registration->id }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Daftar Sebagai</dt><dd class="text-gray-800">{{ $registration->registering_as }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Tipe Delegasi</dt><dd class="text-gray-800">{{ $registration->delegate_type ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Nama Kontak</dt><dd class="text-gray-800">{{ $registration->full_name ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Email Kontak</dt><dd class="text-gray-800">{{ $registration->email ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">No. Telepon</dt><dd class="text-gray-800">{{ $registration->phone ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Tanggal Lahir</dt><dd class="text-gray-800">{{ $registration->date_of_birth ? \Carbon\Carbon::parse($registration->date_of_birth)->format('d F Y') : '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Usia</dt><dd class="text-gray-800">{{ $registration->age ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Gender</dt><dd class="text-gray-800">{{ $registration->gender ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Institusi</dt><dd class="text-gray-800">{{ $registration->institution_name ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Domisili/Kebangsaan</dt><dd class="text-gray-800">{{ $registration->nationality ?? '-' }}</dd></div>


                            @if($registration->registering_as == 'Observer')
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Council to Observe</dt><dd class="text-gray-800 font-semibold">{{ $registration->council_preference_1 ?? '-' }}</dd></div>
                            @endif



                            <div class="space-y-1 lg:col-span-3"><dt class="font-medium text-gray-500 text-sm">Alamat Lengkap</dt><dd class="text-gray-800 whitespace-normal">{{ $registration->full_address ?? '-' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Metode Kehadiran</dt>
                                <dd class="font-medium">
                                    @if($registration->attendance_type == 'Offline')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Offline</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Online</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Jenis Paket</dt><dd class="text-gray-800 font-semibold">{{ $registration->package_type ?? 'N/A' }}</dd></div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Total Harga</dt>
                                <dd class="text-gray-800 font-semibold text-lg text-indigo-600">
                                    Rp {{ number_format($registration->total_price, 0, ',', '.') }}
                                </dd>
                            </div>
                            <div class="space-y-1"><dt class="font-medium text-gray-500 text-sm">Kode Partner</dt><dd class="text-gray-800">{{ $registration->partnership_code ?? '-' }}</dd></div>
                            <div class="space-y-1 lg:col-span-2"><dt class="font-medium text-gray-500 text-sm">Tanggal Daftar</dt><dd class="text-gray-800">{{ $registration->created_at->format('l, d F Y - H:i T') }}</dd></div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Dokumen Pendukung</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2"><i class="ri-wallet-3-line align-middle mr-1"></i> Bukti Pembayaran</h3>
                            @if($registration->payment_proof_path && Storage::disk('public')->exists($registration->payment_proof_path))
                                <a href="{{ asset('storage/' . $registration->payment_proof_path) }}" class="lightbox-trigger">
                                    <img src="{{ asset('storage/' . $registration->payment_proof_path) }}" alt="Bukti Pembayaran" class="w-full h-auto object-cover border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow cursor-pointer">
                                </a>
                            @else
                                <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada bukti.</div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2"><i class="ri-share-line align-middle mr-1"></i> Bukti Media Sosial</h3>
                            @if($registration->social_media_proof_path && Storage::disk('public')->exists($registration->social_media_proof_path))
                                <a href="{{ asset('storage/' . $registration->social_media_proof_path) }}" class="lightbox-trigger">
                                    <img src="{{ asset('storage/' . $registration->social_media_proof_path) }}" alt="Bukti Medsos" class="w-full h-auto object-cover border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow cursor-pointer">
                                </a>
                            @else
                                <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada bukti.</div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2"><i class="ri-profile-line align-middle mr-1"></i> ID Pelajar</h3>
                            @if($registration->student_id_path && Storage::disk('public')->exists($registration->student_id_path))
                                <a href="{{ asset('storage/' . $registration->student_id_path) }}" target="_blank" class="block text-center p-4 bg-blue-50 hover:bg-blue-100 border-2 border-dashed rounded-lg text-blue-700 font-semibold">Lihat PDF</a>
                            @else
                                <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada.</div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2"><i class="ri-parent-line align-middle mr-1"></i> Izin Orang Tua</h3>
                            @if($registration->parental_consent_path && Storage::disk('public')->exists($registration->parental_consent_path))
                                <a href="{{ asset('storage/' . $registration->parental_consent_path) }}" target="_blank" class="block text-center p-4 bg-blue-50 hover:bg-blue-100 border-2 border-dashed rounded-lg text-blue-700 font-semibold">Lihat PDF</a>
                            @else
                                <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-400">Tidak ada.</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Konfirmasi & Persetujuan</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-center gap-4">
                            <i class="ri-checkbox-circle-line text-2xl {{ $registration->info_confirmation ? 'text-green-500' : 'text-gray-400' }}"></i>
                            <div>
                                <h4 class="font-semibold text-gray-700">Konfirmasi Informasi</h4>
                                <p class="text-sm text-gray-500">{{ $registration->info_confirmation ? 'Dikonfirmasi' : 'Belum dikonfirmasi' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="ri-shield-check-line text-2xl {{ $registration->data_usage_agreement ? 'text-green-500' : 'text-gray-400' }}"></i>
                            <div>
                                <h4 class="font-semibold text-gray-700">Persetujuan Data</h4>
                                <p class="text-sm text-gray-500">{{ $registration->data_usage_agreement ? 'Disetujui' : 'Belum disetujui' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if (is_null($registration->delegation_id))
                            <div class="space-y-1 lg:col-span-3">
                                <dt class="font-medium text-gray-500 text-sm">Preferensi Council #1</dt>
                                <dd class="text-gray-800">
                                    <div><strong>Nama Council:</strong> {{ $registration->council_preference_1 ?? '-' }}</div>
                                    <div><strong>Negara:</strong> {{ $registration->country_preference_1_1 ?? '-' }} & {{ $registration->country_preference_1_2 ?? '-' }}</div>
                                    <div class="italic text-sm text-gray-600"><strong>Alasan:</strong> "{{ $registration->reason_for_council_preference_1 ?? '-' }}"</div>
                                </dd>
                            </div>
                            <div class="space-y-1 lg:col-span-3">
                                <dt class="font-medium text-gray-500 text-sm">Preferensi Council #2</dt>
                                <dd class="text-gray-800">
                                    <div><strong>Nama Council:</strong> {{ $registration->council_preference_2 ?? '-' }}</div>
                                    <div><strong>Negara:</strong> {{ $registration->country_preference_2_1 ?? '-' }} & {{ $registration->country_preference_2_2 ?? '-' }}</div>
                                    <div class="italic text-sm text-gray-600"><strong>Alasan:</strong> "{{ $registration->reason_for_council_preference_2 ?? '-' }}"</div>
                                </dd>
                            </div>
                @endif
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
