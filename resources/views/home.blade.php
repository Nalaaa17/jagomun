@extends('layouts.app')

@section('content')
    {{-- Hero Section (Inspirasi Amartha) --}}
    <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-24 px-4 overflow-hidden">
        {{-- Anda bisa menambahkan gambar latar belakang di sini --}}
        {{-- <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');"></div> --}}
        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6 animate__animated animate__fadeInDown">
                Membangun Masa Depan Bersama Jagomun
            </h1>
            <p class="text-xl md:text-2xl mb-10 opacity-90 animate__animated animate__fadeInUp">
                Wadah Inspirasi dan Inovasi untuk Pemuda Berprestasi.
            </p>
            <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-8 rounded-full text-lg shadow-lg transform transition duration-300 hover:scale-105 animate__animated animate__zoomIn">
                Daftar Sekarang!
            </a>
        </div>
    </section>

    {{-- About Us Section --}}
    <section class="py-16 bg-white px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Tentang Jagomun</h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-4">
                    Jagomun adalah sebuah komunitas yang berdedikasi untuk mengembangkan potensi pemuda melalui berbagai program edukatif, kreatif, dan inspiratif. Kami percaya bahwa setiap individu memiliki bakat unik yang perlu diasah.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Dengan fokus pada inovasi dan kolaborasi, Jagomun hadir sebagai platform bagi Anda untuk belajar, berkarya, dan memberikan dampak positif bagi lingkungan sekitar.
                </p>
                <a href="{{ route('about') }}" class="mt-6 inline-block text-blue-600 hover:text-blue-800 font-semibold">
                    Baca Selengkapnya &rarr;
                </a>
            </div>
            <div>
                {{-- Ganti path gambar sesuai dengan lokasi gambar Anda --}}
                <img src="{{ asset('images/about-jagomun.jpg') }}" alt="About Jagomun" class="rounded-lg shadow-xl">
                {{-- Pastikan folder 'public/images/' ada dan gambar 'about-jagomun.jpg' ada di dalamnya --}}
            </div>
        </div>
    </section>

    {{-- Call to Action / Join Us Section (Duplicate, can be moved/removed) --}}
    <section class="bg-blue-800 text-white py-20 px-4 text-center">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-bold mb-6">Bergabunglah dengan Komunitas Jagomun!</h2>
            <p class="text-xl mb-10 opacity-90">
                Dapatkan akses eksklusif ke acara, workshop, dan jaringan profesional. Mari tumbuh bersama.
            </p>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-10 rounded-full text-xl shadow-lg transform transition duration-300 hover:scale-105">
                Daftar Sekarang, Gratis!
            </a>
        </div>
    </section>
@endsection
