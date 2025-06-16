@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-6">Admin Dashboard - Daftar Pendaftar</h1>

                @if($registrations->isEmpty())
                    <p class="text-gray-600">Belum ada pendaftar.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Daftar Sebagai
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipe Delegasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Utama / Institusi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bukti Pembayaran
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bukti Medsos
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Daftar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($registrations as $reg)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $reg->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $reg->registering_as }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $reg->delegate_type ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($reg->registering_as == 'Individual Delegate' || $reg->registering_as == 'Observer')
                                            {{ $reg->full_name }}
                                        @else
                                            {{ $reg->institution_name }} ({{ $reg->delegates->count() }} Delegasi)
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $reg->email ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900"> {{-- Hapus whitespace-nowrap --}}
                                        @if($reg->payment_proof_path && Storage::disk('public')->exists($reg->payment_proof_path))
                                            <div class="flex flex-col items-center"> {{-- Tambahkan flex-col untuk tata letak vertikal --}}
                                                <a href="{{ Storage::disk('public')->url($reg->payment_proof_path) }}" target="_blank" class="text-blue-600 hover:underline mb-1">Lihat Bukti</a>
                                                <img src="{{ Storage::disk('public')->url($reg->payment_proof_path) }}" alt="Bukti Pembayaran" class="h-20 w-20 object-contain border border-gray-200 p-1 rounded-sm"> {{-- Ubah h-16 ke h-20, object-cover ke object-contain, tambahkan border dan padding --}}
                                            </div>
                                        @else
                                            <span class="text-gray-500">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900"> {{-- Hapus whitespace-nowrap --}}
                                        @if($reg->social_media_proof_path && Storage::disk('public')->exists($reg->social_media_proof_path))
                                            <div class="flex flex-col items-center"> {{-- Tambahkan flex-col untuk tata letak vertikal --}}
                                                <a href="{{ Storage::disk('public')->url($reg->social_media_proof_path) }}" target="_blank" class="text-blue-600 hover:underline mb-1">Lihat Bukti</a>
                                                <img src="{{ Storage::disk('public')->url($reg->social_media_proof_path) }}" alt="Bukti Medsos" class="h-20 w-20 object-contain border border-gray-200 p-1 rounded-sm"> {{-- Ubah h-16 ke h-20, object-cover ke object-contain, tambahkan border dan padding --}}
                                            </div>
                                        @else
                                            <span class="text-gray-500">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $reg->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($reg->registering_as == 'Delegation')
                                            <a href="{{ route('admin.registration.detail', $reg->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail Delegasi</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
