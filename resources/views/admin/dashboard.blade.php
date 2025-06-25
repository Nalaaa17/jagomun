<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Daftar Pendaftar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .lightbox {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex; justify-content: center; align-items: center;
            z-index: 1000; opacity: 0; visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }
        .lightbox.active { opacity: 1; visibility: visible; }
        .lightbox-content { max-width: 90%; max-height: 90%; position: relative; }
        .lightbox-content img { display: block; width: auto; max-height: 90vh; margin: 0 auto; }
        .lightbox-close {
            position: absolute; top: 20px; right: 30px;
            color: white; font-size: 30px; font-weight: bold;
            cursor: pointer; opacity: 0.7; transition: opacity 0.2s ease-in-out;
        }
        .lightbox-close:hover { opacity: 1; }
        th, td {
            white-space: nowrap;
            padding: 0.75rem 1rem;
        }
        th {
            padding: 0.75rem 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    <div id="lightbox" class="lightbox hidden">
        <span id="lightbox-close" class="lightbox-close">&times;</span>
        <div class="lightbox-content">
            <img id="lightbox-image" src="" alt="Enlarged Image">
        </div>
    </div>

    {{-- Navbar Admin --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="text-xl font-bold text-gray-800">JAGOMUN Admin</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.contacts.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900">Messages</a>
                    <a href="{{ route('admin.login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($registrations->isEmpty())
                        <p class="text-gray-600">Belum ada pendaftar.</p>
                    @else
                        <div class="overflow-x-auto">
                            <div class="min-w-full">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Daftar Sebagai</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pendaftar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Institusi</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Telepon</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-blue-50">P1: Council</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-blue-50">P1: Negara 1</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-blue-50">P1: Negara 2</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-blue-50">P1: Alasan 1</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-blue-50">P1: Alasan 2</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-green-50">P2: Council</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-green-50">P2: Negara 1</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-green-50">P2: Negara 2</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-green-50">P2: Alasan 1</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-green-50">P2: Alasan 2</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-yellow-50">P3: Council</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-yellow-50">P3: Negara 1</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-yellow-50">P3: Negara 2</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-yellow-50">P3: Alasan 1</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase bg-yellow-50">P3: Alasan 2</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bukti Bayar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bukti Medsos</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Diverifikasi</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($registrations as $reg)
                                        <tr>
                                            <td class="px-6 py-4">{{ $reg->id }}</td>
                                            <td class="px-6 py-4">{{ $reg->registering_as }}</td>
                                            <td class="px-6 py-4">{{ $reg->delegate_type ?? '-' }}</td>
                                            <td class="px-6 py-4">{{ $reg->full_name ?? '-' }}</td>
                                            <td class="px-6 py-4">
                                                @if($reg->registering_as == 'Delegation')
                                                    {{ $reg->institution_name }} ({{ $reg->delegates->count() }} Delegasi)
                                                @else
                                                    {{ $reg->institution_name ?? '-' }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">{{ $reg->email ?? '-' }}</td>
                                            <td class="px-6 py-4">{{ $reg->phone ?? '-' }}</td>
                                            @if($reg->registering_as != 'Delegation')
                                                <td class="px-4 py-4 bg-blue-50">{{ $reg->council_preference_1 ?? '-' }}</td>
                                                <td class="px-4 py-4 bg-blue-50">{{ $reg->country_preference_1_1 ?? '-' }}</td>
                                                <td class="px-4 py-4 bg-blue-50">{{ $reg->country_preference_1_2 ?? '-' }}</td>
                                                <td class="px-4 py-4 text-gray-500 bg-blue-50" title="{{ $reg->reason_for_first_country_preference_1 }}">{{ Str::limit($reg->reason_for_first_country_preference_1, 20, '...') }}</td>
                                                <td class="px-4 py-4 text-gray-500 bg-blue-50" title="{{ $reg->reason_for_second_country_preference_1 }}">{{ Str::limit($reg->reason_for_second_country_preference_1, 20, '...') }}</td>
                                                <td class="px-4 py-4 bg-green-50">{{ $reg->council_preference_2 ?? '-' }}</td>
                                                <td class="px-4 py-4 bg-green-50">{{ $reg->country_preference_2_1 ?? '-' }}</td>
                                                <td class="px-4 py-4 bg-green-50">{{ $reg->country_preference_2_2 ?? '-' }}</td>
                                                <td class="px-4 py-4 text-gray-500 bg-green-50" title="{{ $reg->reason_for_first_country_preference_2 }}">{{ Str::limit($reg->reason_for_first_country_preference_2, 20, '...') }}</td>
                                                <td class="px-4 py-4 text-gray-500 bg-green-50" title="{{ $reg->reason_for_second_country_preference_2 }}">{{ Str::limit($reg->reason_for_second_country_preference_2, 20, '...') }}</td>
                                                <td class="px-4 py-4 bg-yellow-50">{{ $reg->council_preference_3 ?? '-' }}</td>
                                                <td class="px-4 py-4 bg-yellow-50">{{ $reg->country_preference_3_1 ?? '-' }}</td>
                                                <td class="px-4 py-4 bg-yellow-50">{{ $reg->country_preference_3_2 ?? '-' }}</td>
                                                <td class="px-4 py-4 text-gray-500 bg-yellow-50" title="{{ $reg->reason_for_first_country_preference_3 }}">{{ Str::limit($reg->reason_for_first_country_preference_3, 20, '...') }}</td>
                                                <td class="px-4 py-4 text-gray-500 bg-yellow-50" title="{{ $reg->reason_for_second_country_preference_3 }}">{{ Str::limit($reg->reason_for_second_country_preference_3, 20, '...') }}</td>
                                            @else
                                                @for ($i = 0; $i < 15; $i++)
                                                    <td class="px-4 py-4 text-gray-400 italic">-</td>
                                                @endfor
                                            @endif
                                            <td class="px-6 py-4 w-48">
                                                @if($reg->payment_proof_path && file_exists(public_path('storage/' . $reg->payment_proof_path)))
                                                    <img src="{{ asset('storage/' . $reg->payment_proof_path) }}" alt="Bukti Pembayaran" class="lightbox-trigger w-full h-auto max-h-40 object-contain border border-gray-200 p-1 rounded-sm shadow-sm cursor-pointer transition-transform transform hover:scale-110" data-lightbox-image="{{ asset('storage/' . $reg->payment_proof_path) }}">
                                                @else
                                                    <span class="text-gray-500">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 w-48 align-top">
                                                @if($reg->registering_as == 'Delegation' && $reg->delegates->isNotEmpty())
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($reg->delegates as $delegate)
                                                            @if($delegate->social_media_upload)
                                                                <img src="{{ asset('storage/' . $delegate->social_media_upload) }}" alt="Bukti Medsos Delegasi {{ $delegate->delegate_number }}" class="lightbox-trigger h-16 w-16 object-cover border border-gray-300 rounded-sm shadow-sm cursor-pointer transition-transform transform hover:scale-110" data-lightbox-image="{{ asset('storage/' . $delegate->social_media_upload) }}">
                                                            @endif
                                                        @endforeach
                                                        @if($reg->delegates->whereNotNull('social_media_upload')->isEmpty())
                                                            <span class="text-gray-500">Tidak Ada</span>
                                                        @endif
                                                    </div>
                                                @else
                                                    @if($reg->social_media_proof_path && Storage::disk('public')->exists($reg->social_media_proof_path))
                                                        <img src="{{ asset('storage/' . $reg->social_media_proof_path) }}" alt="Bukti Medsos" class="lightbox-trigger h-24 w-24 object-contain border border-gray-300 rounded-sm shadow-sm cursor-pointer transition-transform transform hover:scale-110" data-lightbox-image="{{ asset('storage/' . $reg->social_media_proof_path) }}">
                                                    @else
                                                        <span class="text-gray-500">Tidak Ada</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">{{ $reg->created_at->format('d M Y H:i') }}</td>

                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center">
                                                    <input
                                                        type="checkbox"
                                                        class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer verification-checkbox"
                                                        data-id="{{ $reg->id }}"
                                                        @if($reg->is_verified) checked @endif
                                                    >
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 text-right font-medium">
                                                <a href="{{ route('admin.registration.detail', ['registration' => $reg->id]) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Kode lightbox (tidak diubah)
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxClose = document.getElementById('lightbox-close');
            document.querySelectorAll('.lightbox-trigger').forEach(trigger => {
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();
                    lightboxImage.src = this.dataset.lightboxImage;
                    lightbox.classList.add('active');
                    lightbox.classList.remove('hidden');
                });
            });
            function closeLightbox() {
                lightbox.classList.remove('active');
                lightbox.classList.add('hidden');
            }
            lightboxClose.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', function (event) {
                if (event.target === this) {
                    closeLightbox();
                }
            });

            // --- KODE BARU UNTUK MENYIMPAN STATUS CHECKBOX ---
            const checkboxes = document.querySelectorAll('.verification-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const registrationId = this.dataset.id;
                    const isChecked = this.checked;

                    // Mengambil CSRF token dari meta tag
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Kirim data ke server menggunakan Fetch API (AJAX)
                    fetch(`/admin/registrations/${registrationId}/toggle-verification`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            verified: isChecked // Mengirim status dengan key 'verified'
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
                            console.log(data.message); // Tampilkan pesan sukses di console
                        } else {
                            alert('Gagal memperbarui status dari server.');
                            this.checked = !isChecked;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Periksa koneksi atau hubungi developer.');
                        this.checked = !isChecked; // Kembalikan checkbox ke keadaan semula jika ada error
                    });
                });
            });
        });
    </script>

</body>
</html>
