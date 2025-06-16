@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-8" style="background-color: #D2B48C; border: 2px solid #A0522D;">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-600 text-white mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">I am Registering as {{ $delegateType }}</h1>
            <p class="text-gray-700">Please fill out your personal and preference details below.</p>
        </div>

        <form action="{{ route('registration.individualSubmit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="delegate_type" value="{{ $delegateType }}">

            {{-- Section: Personal Details --}}
            <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Personal Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="full_name" :value="__('Full Name')" />
                        <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')" required autofocus />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" placeholder="e.g., +62 812-3456-7890" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nationality" :value="__('Nationality')" />
                        <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" required />
                        <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <x-input-label for="institution" :value="__('Institution')" />
                        <x-text-input id="institution" class="block mt-1 w-full" type="text" name="institution" :value="old('institution')" />
                        <x-input-error :messages="$errors->get('institution')" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <x-input-label for="motivation_statement" :value="__('Why Jagomun (Motivation Statement)')" />
                        <textarea id="motivation_statement" name="motivation_statement" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('motivation_statement') }}</textarea>
                        <x-input-error :messages="$errors->get('motivation_statement')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- Council Preferences (Individual Delegate might not have this as extensive, but included for completeness) --}}
            <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Council Preferences</h2>
                <p class="text-gray-600 mb-4">You can set your preferred councils and countries here.</p>
                {{-- Ini bisa disederhanakan jika Individual Delegate hanya punya 1 preferensi --}}
                {{-- Saya menyertakan yang sama dengan form delegasi untuk kemudahan saat ini --}}
                @include('registration.partials.council-preferences', ['delegateIndex' => '', 'data' => old()])
            </div>


            {{-- Section: Payment & Social Media Proof --}}
            <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment & Social Media Proof</h2>

                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-2">
                        Please refer to Indonesia MUN Official Instagram (@indonesiamun) for the prices.
                        Transfer the registration payment to:
                        <br>
                        **Rekening Bank:** Mahisa Akib 747373067600 (CIMB Niaga)
                        <br>
                        **PayPal:** nanasiyah0@gmail.com (PayPal)
                    </p>
                </div>

                {{-- Payment Proof Upload --}}
                <div class="mb-6">
                    <x-input-label for="payment_proof" :value="__('Payment Proof Upload')" />
                    <label for="payment_proof" class="flex items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-600" id="payment_proof_filename">Please upload your file. Max size 2 MB.</p>
                            <p class="text-xs text-gray-500">Upload a proof of payment</p>
                        </div>
                        <input id="payment_proof" name="payment_proof" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                    </label>
                    <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                </div>

                {{-- Social Media Upload --}}
                <div class="mb-6">
                    <x-input-label for="social_media_proof" :value="__('Social Media Upload (Click ')" />
                    <a href="#" target="_blank" class="text-blue-600 hover:underline">Click to see the petition template</a>)
                    <label for="social_media_proof" class="flex items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-600" id="social_media_proof_filename">Please upload your file. Max size 2 MB.</p>
                            <p class="text-xs text-gray-500">Upload a proof of social media post/share</p>
                        </div>
                        <input id="social_media_proof" name="social_media_proof" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                    </label>
                    <x-input-error :messages="$errors->get('social_media_proof')" class="mt-2" />
                </div>

                {{-- Referral Code --}}
                <div class="mb-6">
                    <x-input-label for="referral_code" :value="__('Referral Code (Optional, leave blank if you don\'t have one)')" />
                    <x-text-input id="referral_code" class="block mt-1 w-full" type="text" name="referral_code" :value="old('referral_code')" placeholder="Enter your Referral Code Here" />
                    <x-input-error :messages="$errors->get('referral_code')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Submit Individual Registration') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle file name display for payment proof
        const paymentInput = document.getElementById('payment_proof');
        if (paymentInput) {
            paymentInput.addEventListener('change', function() {
                const filenameDisplay = document.getElementById('payment_proof_filename');
                if (this.files && this.files.length > 0) {
                    filenameDisplay.textContent = this.files[0].name;
                } else {
                    filenameDisplay.textContent = 'Please upload your file. Max size 2 MB.';
                }
            });
        }

        // Handle file name display for social media proof
        const socialInput = document.getElementById('social_media_proof');
        if (socialInput) {
            socialInput.addEventListener('change', function() {
                const filenameDisplay = document.getElementById('social_media_proof_filename');
                if (this.files && this.files.length > 0) {
                    filenameDisplay.textContent = this.files[0].name;
                } else {
                    filenameDisplay.textContent = 'Please upload your file. Max size 2 MB.';
                }
            });
        }
    });
</script>
@endsection
