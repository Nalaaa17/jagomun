@extends('layouts.guest')

@section('styles')
    {{-- Anda bisa memindahkan style ini ke file CSS terpisah atau ke layout utama --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script>
        // Konfigurasi Tailwind CSS untuk warna dan animasi kustom
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': '#1E2233',
                        'royal': '#2D3B61',
                        'gold': '#B4976B',
                        'champagne': '#D6C4A4',
                        'ivory': '#F2EFEA'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fadeInUp': 'fadeInUp 0.8s ease-out',
                        'slideInLeft': 'slideInLeft 0.8s ease-out',
                        'slideInRight': 'slideInRight 0.8s ease-out',
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 4s infinite'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F2EFEA !important;
        }

        .form-card {
            background-color: #FFFFFF;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            padding: 2rem;
        }

        .form-input-custom,
        .form-textarea-custom {
            border-color: #D1D5DB;
        }

        .form-input-custom:focus,
        .form-textarea-custom:focus {
            --tw-ring-color: #B4976B;
            border-color: #B4976B;
            box-shadow: 0 0 0 1px #B4976B;
        }

        .btn-submit-custom {
            background-color: #B4976B;
            color: #1E2233;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .btn-submit-custom:hover {
            opacity: 0.9;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="relative pt-12 pb-20 px-4 sm:px-6 lg:pb-28 lg:px-8 text-center">
            <div class="relative max-w-7xl mx-auto">
                <h1 class="text-4xl tracking-tight font-extrabold text-[#1E2233] sm:text-5xl md:text-6xl">Contact Us</h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-[#2D3B61] sm:mt-4">
                    We are always happy to hear from you.
                </p>
            </div>
        </div>

        <div class="pb-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- PERBAIKAN: Menampilkan pesan sukses dari Controller --}}
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md"
                        role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white shadow-2xl rounded-2xl overflow-hidden lg:grid lg:grid-cols-2 lg:gap-0">
                    <div class="p-8 sm:p-10">
                        <h2 class="text-2xl font-bold text-[#1E2233] mb-6">Send Us a Message</h2>
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="name" :value="__('Full Name')" />
                                    <x-text-input id="name" name="name" type="text"
                                        class="mt-1 block w-full form-input-custom" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email"
                                        class="mt-1 block w-full form-input-custom" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="message" :value="__('Your Message')" />
                                    <textarea id="message" name="message" rows="5"
                                        class="mt-1 block w-full form-textarea-custom border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required></textarea>
                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                </div>
                                <div>
                                    <button type="submit" class="w-full btn-submit-custom">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="p-8 sm:p-10 bg-[#1E2233] text-[#F2EFEA]">
                        <h2 class="text-2xl font-bold mb-6 text-white">Contact Information</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1"><svg class="h-6 w-6 text-[#B4976B]" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg></div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-white">Email</h3>
                                    <p class="mt-1 text-[#D6C4A4]">jagomunofficial@gmail.com</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1"><svg class="h-6 w-6 text-[#B4976B]" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg></div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-white">Phone</h3>
                                    <p class="mt-1 text-[#D6C4A4]">+62 812-1724-8675</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <h3 class="text-xl font-semibold mb-4 text-white">Follow Us</h3>
                            <div class="flex space-x-5">
                                <a href="https://facebook.com/jagomun" target="_blank"
                                    class="text-[#D6C4A4] hover:text-[#B4976B]"><span class="sr-only">Facebook</span><svg
                                        class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                            clip-rule="evenodd" />
                                    </svg></a>
                                <a href="https://instagram.com/jagomun_official" target="_blank"
                                    class="text-[#D6C4A4] hover:text-[#B4976B]"><span class="sr-only">Instagram</span><svg
                                        class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353-.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                            clip-rule="evenodd" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
