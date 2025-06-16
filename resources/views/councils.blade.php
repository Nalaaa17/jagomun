@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Dewan dan Struktur Organisasi</h1>

        <div class="bg-white shadow-xl rounded-lg p-8 mb-10">
            <p class="text-lg text-gray-700 leading-relaxed mb-4">
                Struktur organisasi Jagomun dirancang untuk mendukung efisiensi dan kolaborasi dalam mencapai visi dan misi kami. Kami memiliki beberapa dewan atau divisi yang masing-masing bertanggung jawab atas bidang tertentu.
            </p>
            <p class="text-lg text-gray-700 leading-relaxed">
                Berikut adalah gambaran umum dewan-dewan yang ada di Jagomun:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Contoh Card Dewan 1 --}}
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Dewan Eksekutif</h3>
                <p class="text-gray-600">Bertanggung jawab atas pengambilan keputusan strategis dan operasional harian organisasi.</p>
            </div>

            {{-- Contoh Card Dewan 2 --}}
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Dewan Program & Acara</h3>
                <p class="text-gray-600">Fokus pada perencanaan, pengembangan, dan pelaksanaan semua program dan acara Jagomun.</p>
            </div>

            {{-- Contoh Card Dewan 3 --}}
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Dewan Komunikasi & Media</h3>
                <p class="text-gray-600">Mengelola semua aspek komunikasi eksternal dan internal, termasuk media sosial dan publikasi.</p>
            </div>

            {{-- Tambahkan lebih banyak dewan jika perlu --}}
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Dewan Keanggotaan & Relasi</h3>
                <p class="text-gray-600">Bertanggung jawab untuk pengembangan anggota, perekrutan, dan menjaga hubungan baik dengan para stakeholder.</p>
            </div>
        </div>

        {{-- Anda bisa menambahkan diagram struktur organisasi atau daftar anggota dewan di sini --}}
    </div>
@endsection
