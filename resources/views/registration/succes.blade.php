@extends('layouts.app')

@section('title', 'Registrasi Berhasil') {{-- Opsional: untuk judul halaman dinamis --}}

@section('content')
<div class="flex items-center justify-center min-h-[60vh] py-12">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white shadow-xl rounded-lg p-8 transform transition-all hover:scale-105 duration-300">
            <div class="mb-6">
                {{-- Menggunakan warna hijau dari Tailwind (misal: green-500) --}}
                <svg class="mx-auto h-24 w-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            {{-- Menggunakan warna-warna standar Tailwind agar lebih mudah dikelola --}}
            <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Registration Successful!</h1>

            <p class="text-lg text-gray-600 leading-relaxed mb-8">
                Thank you for registering. Your data has been received and will be processed shortly.
                <br>
                Please check your email (including spam/junk folders) for confirmation and details on the next steps.
            </p>

            <a href="{{ route('home') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg shadow-lg hover:shadow-xl">
                Back to Homepage
            </a>
        </div>
    </div>
</div>
@endsection
