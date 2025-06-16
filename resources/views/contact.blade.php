@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Hubungi Kami</h1>

        <div class="bg-white shadow-xl rounded-lg p-8 mb-10 md:grid md:grid-cols-2 md:gap-8">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Kirim Pesan kepada Kami</h2>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Pesan Anda:</label>
                        <textarea id="message" name="message" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 md:mt-0">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Informasi Kontak Lainnya</h2>
                <p class="text-lg text-gray-700 mb-2"><strong>Alamat:</strong> Jl. Contoh No. 123, Jember, Jawa Timur, Indonesia</p>
                <p class="text-lg text-gray-700 mb-2"><strong>Email:</strong> info@jagomun.com</p>
                <p class="text-lg text-gray-700 mb-2"><strong>Telepon:</strong> +62 812-3456-7890</p>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    {{-- Ganti # dengan link sosial media Anda --}}
                    <a href="https://facebook.com/jagomun" target="_blank" class="text-blue-600 hover:text-blue-800">Facebook</a>
                    <a href="https://instagram.com/jagomun_official" target="_blank" class="text-blue-600 hover:text-blue-800">Instagram</a>
                    <a href="https://twitter.com/jagomun" target="_blank" class="text-blue-600 hover:text-blue-800">Twitter (X)</a>
                </div>
            </div>
        </div>
    </div>
@endsection
