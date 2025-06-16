@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-8 text-center" style="background-color: #8B4513; color: white;">
        <h1 class="text-3xl font-bold mb-10">I am registering as</h1>

        <form action="{{ route('registration.processType') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
                {{-- Individual Delegate --}}
                <label class="cursor-pointer">
                    <input type="radio" name="registration_type" value="Individual Delegate" class="hidden peer" required>
                    <div class="bg-white p-6 rounded-lg shadow-lg peer-checked:ring-4 peer-checked:ring-blue-500 transition-all duration-300" style="background-color: #D2B48C; border: 2px solid #A0522D;">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-700 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-800">Individual Delegate</p>
                    </div>
                </label>

                {{-- Delegation (min. 4) --}}
                <label class="cursor-pointer">
                    <input type="radio" name="registration_type" value="Delegation" class="hidden peer">
                    <div class="bg-white p-6 rounded-lg shadow-lg peer-checked:ring-4 peer-checked:ring-blue-500 transition-all duration-300" style="background-color: #D2B48C; border: 2px solid #A0522D;">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-700 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h2a2 2 0 002-2V4a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h2m3-10h4m-4 4h4m-1-9a1 1 0 11-2 0 1 1 0 012 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /> {{-- Multiple people icon --}}
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-800">Delegation (min. 4)</p>
                    </div>
                </label>

                {{-- Observer --}}
                <label class="cursor-pointer">
                    <input type="radio" name="registration_type" value="Observer" class="hidden peer">
                    <div class="bg-white p-6 rounded-lg shadow-lg peer-checked:ring-4 peer-checked:ring-blue-500 transition-all duration-300" style="background-color: #D2B48C; border: 2px solid #A0522D;">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-700 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-800">Observer</p>
                    </div>
                </label>
            </div>

            <div class="mt-10">
                <x-primary-button>
                    {{ __('Next Step') }}
                </x-primary-button>
            </div>
            <x-input-error :messages="$errors->get('registration_type')" class="mt-4" />
        </form>
    </div>
</div>
@endsection
