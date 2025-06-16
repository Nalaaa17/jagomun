@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-8 text-center" style="background-color: #8B4513; color: white;">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-600 text-white mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold mb-10">Registering as {{ $type }}. Where are you from?</h1>

        <form action="{{ route('registration.processDelegateType') }}" method="POST">
            @csrf
            <input type="hidden" name="parent_type" value="{{ $type }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-items-center">
                {{-- National Delegate (Indonesia) --}}
                <label class="cursor-pointer">
                    <input type="radio" name="delegate_type" value="National Delegate" class="hidden peer" required>
                    <div class="bg-white p-6 rounded-full shadow-lg peer-checked:ring-4 peer-checked:ring-blue-500 transition-all duration-300" style="background-color: #D2B48C; border: 2px solid #A0522D;">
                        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-blue-700 text-white mb-4">
                            {{-- Ganti SVG dengan ikon bendera Indonesia jika memungkinkan atau ikon yang relevan --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l7 7m-2 2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-800">National Delegate (Indonesia)</p>
                    </div>
                </label>

                {{-- International Delegate --}}
                <label class="cursor-pointer">
                    <input type="radio" name="delegate_type" value="International Delegate" class="hidden peer">
                    <div class="bg-white p-6 rounded-full shadow-lg peer-checked:ring-4 peer-checked:ring-blue-500 transition-all duration-300" style="background-color: #D2B48C; border: 2px solid #A0522D;">
                        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-blue-700 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 0110 15c0 1.5-.536 3.013-1.464 4.396M12 18h.01M2 13.25l2.455 2.115M14 11.25l2.455 2.115" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-800">International Delegate</p>
                    </div>
                </label>
            </div>

            <div class="mt-10">
                <x-primary-button>
                    {{ __('Next Step') }}
                </x-primary-button>
            </div>
            <x-input-error :messages="$errors->get('delegate_type')" class="mt-4" />
        </form>
    </div>
</div>
@endsection
