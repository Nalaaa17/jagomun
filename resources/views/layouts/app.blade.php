<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jagomun') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        {{-- Header/Navbar --}}
        <nav class="bg-gray-800 text-white shadow-md" x-data="{ open: false }"> {{-- Tambahkan x-data="{ open: false }" di sini --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">Jagomun</a>
                        {{-- Atau gunakan gambar logo: <img src="{{ asset('path/to/your/logo.png') }}" alt="Jagomun Logo" class="h-9 w-auto"> --}}
                    </div>

                    {{-- Navigation Links (Desktop) --}}
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ __('About') }}
                        </x-nav-link>
                        <x-nav-link :href="route('councils')" :active="request()->routeIs('councils')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ __('Councils') }}
                        </x-nav-link>
                        <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ __('Contact') }}
                        </x-nav-link>
                        <x-nav-link :href="route('registration.chooseType')" :active="request()->routeIs('registration.chooseType') || request()->routeIs('registration.*')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ __('Register') }}
                        </x-nav-link>

                        {{-- Search Icon (Placeholder) --}}
                        <button type="button" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>

                    {{-- Mobile Menu Button --}}
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Responsive Navigation Menu (Mobile) --}}
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('councils')" :active="request()->routeIs('councils')">
                        {{ __('Councils') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                        {{ __('Contact') }}
                    </x-responsive-nav-link>
                    {{-- Ini yang diperbaiki: Menggunakan x-responsive-nav-link --}}
                    <x-responsive-nav-link :href="route('registration.chooseType')" :active="request()->routeIs('registration.chooseType') || request()->routeIs('registration.*')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>

                </div>

                {{-- Tidak ada bagian untuk user yang sudah login di mobile menu juga --}}
                {{-- Anda bisa menambahkan ini kembali jika nanti butuh dashboard/profile untuk user yang sudah register --}}
            </div>
        </nav>

        {{-- Page Content --}}
        <main>
            {{-- Flash messages (for success/error notifications) --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto mt-4 max-w-7xl" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.414l-2.651 2.65a1.2 1.2 0 1 1-1.697-1.697L8.303 9.717 5.651 7.065a1.2 1.2 0 0 1 1.697-1.697L10 8.02l2.651-2.65a1.2 1.2 0 0 1 1.697 1.697l-2.651 2.651 2.651 2.65a1.2 1.2 0 0 1 0 1.697z"/></svg>
                    </span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto mt-4 max-w-7xl" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.414l-2.651 2.65a1.2 1.2 0 1 1-1.697-1.697L8.303 9.717 5.651 7.065a1.2 1.2 0 0 1 1.697-1.697L10 8.02l2.651-2.65a1.2 1.2 0 0 1 1.697 1.697l-2.651 2.651 2.651 2.65a1.2 1.2 0 0 1 0 1.697z"/></svg>
                    </span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto mt-4 max-w-7xl" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="mt-3 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-gray-800 text-white p-6 mt-8">
            <div class="max-w-7xl mx-auto text-center text-sm">
                &copy; {{ date('Y') }} Jagomun. All rights reserved.
                <div class="mt-2">
                    <a href="#" class="text-gray-400 hover:text-white mx-2">Kebijakan Privasi</a> |
                    <a href="#" class="text-gray-400 hover:text-white mx-2">Syarat & Ketentuan</a>
                </div>
                <div class="mt-3 flex justify-center space-x-4">
                    {{-- Social Media Icons --}}
                    {{-- Facebook --}}
                    <a href="#" class="text-gray-400 hover:text-white" aria-label="Facebook">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22H12c5.523 0 10-4.477 10-10z" clip-rule="evenodd" /></svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="#" class="text-gray-400 hover:text-white" aria-label="Instagram">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.792.058.971.045 1.77.201 2.413.468.654.271 1.21.644 1.772 1.206.562.562.935 1.119 1.206 1.772.267.643.423 1.442.468 2.413.045 1.008.058 1.352.058 3.792s-.013 2.784-.058 3.792c-.045.971-.201 1.77-.468 2.413-.271.654-.644 1.21-1.206 1.772-.562.562-1.119.935-1.772 1.206-.643.267-1.442.423-2.413.468-1.008.045-1.352.058-3.792.058s-2.784-.013-3.792-.058c-.971-.045-1.77-.201-2.413-.468-.654-.271-1.21-.644-1.772-1.206-.562-.562-.935-1.119-1.206-1.772-.267-.643-.423-1.442-.468-2.413-.045-1.008-.058-1.352-.058-3.792s.013-2.784.058-3.792c.045-.971.201-1.77.468-2.413.271-.654.644-1.21 1.206-1.772.562-.562 1.119-.935 1.772-1.206.643-.267 1.442-.423 2.413-.468C9.531 2.013 9.875 2 12.315 2zm0 2.18c-2.31 0-2.67.01-3.618.054-.875.04-1.354.148-1.724.3-1.187.49-1.905 1.209-2.395 2.395-.152.37-.26.849-.3 1.724-.044.948-.054 1.307-.054 3.618s.01 2.67.054 3.618c.04.875.148 1.354.3 1.724.49 1.187 1.209 1.905 2.395 2.395.37.152.849.26 1.724.3.948.044 1.307.054 3.618.054s2.67-.01 3.618-.054c.875-.04 1.354-.148 1.724-.3 1.187-.49 1.905-1.209 2.395-2.395.152-.37.26-.849.3-1.724.044-.948.054-1.307.054-3.618s-.01-2.67-.054-3.618zM12.315 7.5c2.483 0 4.5 2.017 4.5 4.5s-2.017 4.5-4.5 4.5-4.5-2.017-4.5-4.5 2.017-4.5 4.5-4.5zm0 1.98c-1.39 0-2.52 1.13-2.52 2.52s1.13 2.52 2.52 2.52 2.52-1.13 2.52-2.52-1.13-2.52-2.52-2.52z" clip-rule="evenodd" /></svg>
                    </a>
                    {{-- Twitter / X --}}
                    <a href="#" class="text-gray-400 hover:text-white" aria-label="Twitter">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19.633 7.997c.412-.132.8-.292 1.159-.49 0 0 .66-.334 1.014-.541.2-.11.366-.192.51-.258v.001c.07.03.14.062.209.093.564.246 1.107.568 1.588.943v.002h.001c.215.178.435.342.662.496.224.153.456.295.694.423.238.127.48.243.725.345.245.102.492.193.74.272.247.079.497.143.748.192.25.049.502.083.754.101.252.018.506.027.759.027v-.001h.001c.245-.002.491-.008.735-.018.244-.01.488-.025.728-.044.238-.019.475-.04.708-.063.23-.023.459-.048.686-.076.226-.028.449-.058.67-.091.22-.033.439-.069.654-.108.215-.039.428-.08.636-.123.208-.043.414-.089.617-.138.203-.049.404-.101.601-.157.197-.056.392-.115.583-.178.191-.063.379-.13.564-.202.185-.072.366-.148.541-.228.175-.08.347-.165.513-.255.166-.09.327-.184.484-.282.156-.098.307-.2.454-.306.147-.105.287-.214.42-.326.133-.112.259-.228.376-.347.117-.119.227-.24.329-.364.101-.125.195-.253.279-.384.084-.131.159-.265.223-.402.064-.137.119-.276.163-.416.044-.14.077-.282.099-.426.022-.144.035-.289.035-.436v-.002c-.001-.137-.01-.275-.028-.41-.018-.135-.047-.268-.087-.4-.039-.133-.092-.262-.157-.386-.064-.124-.141-.242-.229-.355-.088-.112-.188-.218-.298-.316-.109-.098-.23-.189-.361-.27-.13-.081-.271-.154-.42-.22-.149-.066-.307-.123-.473-.173-.166-.05-.34-.09-.52-.12-.181-.03-.367-.051-.557-.063-.189-.012-.38-.016-.57-.016.27-.01 1.05-.008 2.37.005 1.57.016 3.09.07 4.31.258.983.153 1.907.417 2.653.791.701.344 1.259.78 1.63 1.282.41-.005 3.39-.013 3.39-.013V2.5c0-.276-.224-.5-.5-.5H1.5c-.276 0-.5.224-.5.5v19c0 .276.224.5.5.5h21.018c.276 0 .5-.224.5-.5v-1.045c-.001-.43-.016-.86-.045-1.285-.029-.425-.075-.845-.137-1.258-.063-.413-.146-.819-.248-1.21-.102-.391-.225-.769-.367-1.134-.142-.365-.306-.715-.49-.938-.024-.03-.047-.058-.071-.086-.073-.086-.151-.166-.234-.24-.083-.075-.171-.144-.263-.207z" /></svg>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
check ini
