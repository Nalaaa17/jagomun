@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-6">Detail Pendaftaran Delegasi</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali ke Dashboard Admin</a>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-lg mb-6">
                    <div>
                        <h2 class="text-xl font-semibold mb-3">Informasi Umum Delegasi</h2>
                        <p><strong>Daftar Sebagai:</strong> {{ $registration->registering_as }}</p>
                        <p><strong>Tipe Delegasi:</strong> {{ $registration->delegate_type ?? '-' }}</p>
                        <p><strong>Nama Institusi:</strong> {{ $registration->institution_name }}</p>
                        <p><strong>Butuh Akomodasi:</strong> {{ $registration->do_you_need_accommodation ? 'Ya' : 'Tidak' }}</p>
                        <p><strong>Referral Code:</strong> {{ $registration->referral_code ?? '-' }}</p>
                        <p><strong>Tanggal Daftar:</strong> {{ $registration->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold mb-3">Bukti Unggahan</h2>
                        <p class="mb-2"><strong>Bukti Pembayaran:</strong></p>
                        @if($registration->payment_proof_path && Storage::disk('public')->exists($registration->payment_proof_path))
                            <a href="{{ Storage::disk('public')->url($registration->payment_proof_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Gambar/PDF</a>
                            <img src="{{ Storage::disk('public')->url($registration->payment_proof_path) }}" alt="Bukti Pembayaran" class="h-32 w-auto mt-2 object-cover border border-gray-300">
                        @else
                            <p>Tidak ada bukti pembayaran.</p>
                        @endif

                        <p class="mt-4 mb-2"><strong>Bukti Media Sosial:</strong></p>
                        @if($registration->social_media_proof_path && Storage::disk('public')->exists($registration->social_media_proof_path))
                            <a href="{{ Storage::disk('public')->url($registration->social_media_proof_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Gambar/PDF</a>
                            <img src="{{ Storage::disk('public')->url($registration->social_media_proof_path) }}" alt="Bukti Medsos" class="h-32 w-auto mt-2 object-cover border border-gray-300">
                        @else
                            <p>Tidak ada bukti media sosial.</p>
                        @endif
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-4 mt-8">Daftar Delegasi</h2>

                @if($registration->delegates->isEmpty())
                    <p class="text-gray-600">Tidak ada delegasi terdaftar untuk pendaftaran ini.</p>
                @else
                    <div class="space-y-6">
                        @foreach($registration->delegates as $delegate)
                            <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                                <h3 class="text-xl font-semibold mb-3">Delegasi #{{ $delegate->delegate_number }} - {{ $delegate->full_name }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div>
                                        <p><strong>Email:</strong> {{ $delegate->email }}</p>
                                        <p><strong>Telepon:</strong> {{ $delegate->phone }}</p>
                                        <p><strong>Kewarganegaraan:</strong> {{ $delegate->nationality }}</p>
                                        <p><strong>Pengalaman MUN:</strong> {{ $delegate->mun_experience ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Preferensi Council 1:</p>
                                        <p>Council: {{ $delegate->council_preference_1 ?? '-' }}</p>
                                        <p>Negara 1: {{ $delegate->country_preference_1_1 ?? '-' }}</p>
                                        <p>Negara 2: {{ $delegate->country_preference_1_2 ?? '-' }}</p>
                                        <p>Alasan 1: {{ $delegate->reason_for_first_country_preference_1 ?? '-' }}</p>
                                        <p>Alasan 2: {{ $delegate->reason_for_second_country_preference_1 ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Preferensi Council 2:</p>
                                        <p>Council: {{ $delegate->council_preference_2 ?? '-' }}</p>
                                        <p>Negara 1: {{ $delegate->country_preference_2_1 ?? '-' }}</p>
                                        <p>Negara 2: {{ $delegate->country_preference_2_2 ?? '-' }}</p>
                                        <p>Alasan 1: {{ $delegate->reason_for_first_country_preference_2 ?? '-' }}</p>
                                        <p>Alasan 2: {{ $delegate->reason_for_second_country_preference_2 ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Preferensi Council 3:</p>
                                        <p>Council: {{ $delegate->council_preference_3 ?? '-' }}</p>
                                        <p>Negara 1: {{ $delegate->country_preference_3_1 ?? '-' }}</p>
                                        <p>Negara 2: {{ $delegate->country_preference_3_2 ?? '-' }}</p>
                                        <p>Alasan 1: {{ $delegate->reason_for_first_country_preference_3 ?? '-' }}</p>
                                        <p>Alasan 2: {{ $delegate->reason_for_second_country_preference_3 ?? '-' }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="font-semibold mb-2">Bukti Medsos Delegasi:</p>
                                        @if($delegate->social_media_upload && Storage::disk('public')->exists($delegate->social_media_upload))
                                            <a href="{{ Storage::disk('public')->url($delegate->social_media_upload) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                                            <img src="{{ Storage::disk('public')->url($delegate->social_media_upload) }}" alt="Bukti Medsos Delegasi" class="h-24 w-auto mt-2 object-cover border border-gray-300">
                                        @else
                                            <p>Tidak ada bukti media sosial.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
