@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
    <div class="bg-white shadow-xl rounded-lg p-8">
        <div class="mb-6">
            <svg class="mx-auto h-24 w-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Registrasi Berhasil!</h1>
        <p class="text-lg text-gray-600 mb-6">
            Terima kasih telah mendaftar. Data Anda telah kami terima dan akan segera kami proses.
            <br>
            Silakan cek email Anda (termasuk folder spam/junk) untuk konfirmasi dan detail langkah selanjutnya.
        </p>
        <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
