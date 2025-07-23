@extends('layouts.app')

@section('content')
    <div class="bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            {{-- WIZARD / STEPPER --}}
            <div class="mb-10 px-4">
                <div id="stepper" class="flex items-center max-w-2xl mx-auto">
                    {{-- Step 1: Setup --}}
                    <div class="stepper-item active">
                        <div class="step-counter"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6M9 11.25h6M9 15.75h6M9 20.25h6" />
                            </svg></div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    {{-- Step 2: Delegates --}}
                    <div class="stepper-item">
                        <div class="step-counter"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3.75 3.75 0 0115 9.75v6.038c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 15.788V9.75A3.75 3.75 0 016.75 6h.008a3.75 3.75 0 013.742 3.75z" />
                            </svg></div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    {{-- Step 3: Payment --}}
                    <div class="stepper-item">
                        <div class="step-counter"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 21z" />
                            </svg></div>
                    </div>
                </div>
            </div>
            {{-- END STEPPER --}}

            <div class="bg-white shadow-2xl shadow-slate-300/20 rounded-xl p-8">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-slate-800">Registering as Delegation ({{ $delegateType }})</h1>
                    <p class="text-slate-500 mt-2">Please follow the steps to complete your delegation registration.</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg mb-6" role="alert">
                        <p class="font-bold">Oops! There were some problems with your input.</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="delegation-form" action="{{ route('registration.delegationSubmit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="delegate_type" value="{{ $delegateType }}">

                    <div id="step-1" class="form-step active-step">
                        <div class="step-content">
                            {{-- Institution Details --}}
                            <div class="border border-slate-200 p-6 rounded-lg mb-6">
                                <h2 class="text-xl font-semibold text-slate-700 mb-4">Institution Detail</h2>
                                <x-input-label for="institution_name" :value="__('Institution Name')" />
                                <x-text-input id="institution_name" class="block mt-1 w-full" type="text"
                                    name="institution_name" :value="old('institution_name')" required />
                                <x-input-error :messages="$errors->get('institution_name')" class="mt-2" />
                            </div>

                            {{-- Delegation Information --}}
                            <div class="border border-slate-200 p-6 rounded-lg">
                                <h2 class="text-xl font-semibold text-slate-700 mb-4">Delegation Information</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                    {{-- Package Type Selection --}}
                                    <div>
                                        <p class="block font-medium text-sm text-gray-700 mb-3">1. Select Package Type for
                                            Delegation:</p>
                                        <div id="package-selector" class="space-y-3">
                                            <label for="package_type_full"
                                                class="flex items-center cursor-pointer p-3 border rounded-md has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500">
                                                <input type="radio" id="package_type_full" name="package_type"
                                                    value="Full Accommodation" class="h-4 w-4 text-indigo-600" required>
                                                <span class="ml-3 text-sm text-gray-800">Full Accommodation</span>
                                            </label>
                                            <label for="package_type_non"
                                                class="flex items-center cursor-pointer p-3 border rounded-md has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500">
                                                <input type="radio" id="package_type_non" name="package_type"
                                                    value="Non-Accommodation" class="h-4 w-4 text-indigo-600" required>
                                                <span class="ml-3 text-sm text-gray-800">Non-Accommodation</span>
                                            </label>
                                            <label for="package_type_online"
                                                class="flex items-center cursor-pointer p-3 border rounded-md has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500">
                                                <input type="radio" id="package_type_online" name="package_type"
                                                    value="Online" class="h-4 w-4 text-indigo-600" required>
                                                <span class="ml-3 text-sm text-gray-800">Online</span>
                                            </label>
                                        </div>
                                    </div>
                                    {{-- Delegate Count Selection --}}
                                    <div>
                                        <p class="block font-medium text-sm text-gray-700 mb-3">2. How many delegates in
                                            your group?</p>
                                        <div id="delegate-selector" class="space-y-3">
                                            @foreach ([2, 3, 4, 5] as $count)
                                                <label for="delegate_count_{{ $count }}"
                                                    class="flex items-center cursor-pointer p-3 border rounded-md has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500">
                                                    <input type="radio" id="delegate_count_{{ $count }}"
                                                        name="delegate_count" value="{{ $count }}"
                                                        class="h-4 w-4 text-indigo-600" required>
                                                    <span class="ml-3 text-sm text-gray-800">{{ $count }}
                                                        delegates</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="step-2" class="form-step">
                        <div class="step-content">
                            <h2 class="text-2xl font-semibold text-slate-700 mb-6 border-l-4 border-indigo-500 pl-4">
                                Delegate Details</h2>
                            <p class="text-slate-500 mb-6 -mt-4 pl-5">Please fill in the details for each delegate below.
                            </p>

                            {{-- Delegate Forms will be injected here by JavaScript --}}
                            <div id="delegates-container" class="space-y-8"></div>
                        </div>
                    </div>

                    <div id="step-3" class="form-step">
                        <div class="step-content">
                            <h2 class="text-2xl font-semibold text-slate-700 mb-6 border-l-4 border-indigo-500 pl-4">
                                Payment</h2>

                            {{-- Dynamic Price Display --}}
                            <div id="total-payment-display"
                                class="bg-indigo-50 border-l-4 border-indigo-500 text-indigo-900 p-4 rounded-r-lg mb-6 hidden"
                                role="alert">
                                <p class="font-bold">Total to be paid</p>
                                <p id="total-price" class="text-3xl font-extrabold"></p>
                                <p id="price-breakdown" class="text-sm mt-1"></p>
                            </div>

                            {{-- Referral Code Input --}}
                            <div class="my-6">
                                <x-input-label for="referral_code" :value="__('Referral Code (Optional)')" />
                                <div class="relative">
                                    <x-text-input id="referral_code" name="referral_code" type="text"
                                        class="mt-1 block w-full md:w-1/2 pr-10"
                                        placeholder="Enter delegation discount code" />
                                    <div id="referral-loading" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                        style="top: 50%; transform: translateY(-50%); right: 0.75rem;">
                                        <svg class="animate-spin h-5 w-5 text-indigo-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div id="referral-status" class="text-sm mt-2 h-5"></div>
                            </div>

                            {{-- ====================================================================== --}}
                            {{-- === AWAL PERUBAHAN: Menambahkan informasi pembayaran === --}}
                            {{-- ====================================================================== --}}
                            <div class="text-sm text-slate-600 p-4 bg-slate-100 rounded-lg mb-6 border border-slate-200">
                                <p class="mb-2">Please refer to JAGOMUN Official Instagram @jagomun.2025 for the prices.
                                    Transfer the registration payment to:</p>
                                <div class="space-y-2 pl-4">
                                    <div>
                                        <strong class="text-slate-800">Bank Account:</strong>
                                        <ul class="list-disc list-inside ml-4">
                                            <li>BRI: 095301059810538 (A.N Nadia Aisha Syarif)</li>
                                            <li>Seabank: 901044673651 (A.N Nadia Aisha Syarif)</li>
                                            <li>Jago Bank: 109929292133 (A.N Nadia Aisha Syarif)</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <strong class="text-slate-800">E-wallet:</strong>
                                        <ul class="list-disc list-inside ml-4">
                                            <li>ShopeePay: 088289799127 (A.N Pididididi)</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <strong class="text-slate-800">PayPal:</strong> -
                                    </div>
                                </div>
                            </div>
                            {{-- ====================================================================== --}}
                            {{-- === AKHIR PERUBAHAN === --}}
                            {{-- ====================================================================== --}}

                            {{-- Payment Proof Upload --}}
                            <div>
                                <x-input-label for="payment_proof" :value="__('Payment Proof Upload (for the whole delegation)')" class="mb-2" />
                                <label for="payment_proof"
                                    class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 cursor-pointer hover:border-indigo-500 hover:bg-slate-50 transition duration-150 ease-in-out">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-1 text-sm text-gray-600" id="payment_proof_filename">Click to upload
                                            file. Max 2MB.</p>
                                    </div>
                                    <input id="payment_proof" name="payment_proof" type="file" class="hidden"
                                        accept=".jpg,.jpeg,.png,.pdf" required />
                                </label>
                                <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- FORM NAVIGATION BUTTONS --}}
                    <div class="flex items-center justify-between mt-12 pt-6 border-t border-slate-200">
                        <button type="button" id="prev-btn"
                            class="px-6 py-2 bg-slate-200 text-slate-800 font-semibold rounded-lg hover:bg-slate-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            Previous
                        </button>
                        <button type="button" id="next-btn"
                            class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors">
                            Next Step
                        </button>
                        <button type="submit" id="submit-btn"
                            class="hidden px-8 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors">
                            {{ __('Submit Delegation Registration') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="delegate-template">
        <div
            class="delegate-form-block border border-slate-200 p-6 rounded-lg bg-white relative shadow-md shadow-slate-200/50">
            <h3 class="delegate-title text-xl font-semibold text-slate-800 mb-6 border-b border-slate-200 pb-4">Delegate #
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                {{-- Hidden inputs for server-side logic --}}
                <input type="hidden" name="delegates[__INDEX__][package_type]" value="">
                <input type="hidden" name="delegates[__INDEX__][needs_accommodation]" value="">
                <input type="hidden" name="delegates[__INDEX__][attendance_type]" value="">

                {{-- Personal Info --}}
                <h4 class="md:col-span-2 text-lg font-semibold text-slate-700 border-b pb-2">Personal Information</h4>
                <div>
                    <x-input-label for="delegates[__INDEX__][full_name]" :value="__('Full Name')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][full_name]"
                        required />
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][email]" :value="__('Email')" />
                    <x-text-input class="block mt-1 w-full" type="email" name="delegates[__INDEX__][email]" required />
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][date_of_birth]" :value="__('Date of Birth')" />
                    <x-text-input class="block mt-1 w-full" type="date" name="delegates[__INDEX__][date_of_birth]"
                        required />
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][age]" :value="__('Age')" />
                    <x-text-input class="block mt-1 w-full" type="number" name="delegates[__INDEX__][age]" required />
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][gender]" :value="__('Gender')" />
                    <select name="delegates[__INDEX__][gender]"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                        required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][phone]" :value="__('Contact Number')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][phone]"
                        placeholder="+62 812..." required />
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="delegates[__INDEX__][full_address]" :value="__('Full Address')" />
                    <textarea name="delegates[__INDEX__][full_address]" rows="3"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                        required></textarea>
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][nationality]" :value="__(Str::contains($delegateType, 'International') ? 'Nationality' : 'Domicile')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][nationality]"
                        required />
                </div>

                {{-- Experience --}}
                <h4 class="md:col-span-2 text-lg font-semibold text-slate-700 border-b pb-2 mt-4">Experience & Documents
                </h4>
                <div class="md:col-span-2">
                    <x-input-label for="delegates[__INDEX__][previous_mun_experience]" :value="__('Previous MUN Experience (if any)')" />
                    <textarea name="delegates[__INDEX__][previous_mun_experience]" rows="3"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="delegates[__INDEX__][mun_awards]" :value="__('MUN Awards (if any)')" />
                    <textarea name="delegates[__INDEX__][mun_awards]" rows="3"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][student_id]" :value="__('Student ID (PDF)')" />
                    <input name="delegates[__INDEX__][student_id]" type="file" class="input-file-basic"
                        accept=".pdf" required />
                </div>
                <div class="md:col-span-1">
                    <x-input-label for="parental_consent" :value="__('Parental Consent Letter (PDF - If applicable)')" />
                    <p class="text-sm text-slate-500 mb-1">Required for applicants under 18 attending offline. Template: <a
                            href="http://bit.ly/ParentalConsentLetterJAGOMUN2025" target="_blank"
                            class="text-indigo-600 hover:underline font-semibold">Download here</a></p>
                    <input id="parental_consent" name="parental_consent" type="file"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        accept=".pdf" />
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="delegates[__INDEX__][social_media_proof_path]" :value="__('Social Media Upload (Optional)')" />
                    <p class="font-medium text-sm text-gray-700">Social Media Upload <a
                            href="https://www.instagram.com/jagomun.2025" target="_blank"
                            class="text-indigo-600 hover:underline">@jagomun.2025</a></p>
                    <input name="delegates[__INDEX__][social_media_proof_path]" type="file" class="input-file-basic"
                        accept=".jpg,.jpeg,.png,.pdf" />
                </div>

                {{-- Council Preferences --}}
                <h4 class="md:col-span-2 text-lg font-semibold text-slate-700 border-b pb-2 mt-4">Council Preferences</h4>
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 border-b border-slate-200 pb-6">
                    <div class="md:col-span-3 font-semibold text-slate-600">Council Preference 1</div>
                    <div>
                        <x-input-label :value="__('Council')" />
                        <select name="delegates[__INDEX__][council_preference_1]" class="input-select-basic" required>
                            <option value="">Select Council</option>
                            <option value="UNEP">UNEP (Beginner, Offline)</option>
                            <option value="UNHRC">UNHRC (Beginner, Online)</option>
                            <option value="IAEA">IAEA (Intermediate, Online)</option>
                            <option value="NATO">NATO (Advanced, Online)</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label :value="__('Country 1')" />
                        <x-text-input name="delegates[__INDEX__][country_preference_1_1]" class="block mt-1 w-full"
                            type="text" required />
                    </div>
                    <div>
                        <x-input-label :value="__('Country 2')" />
                        <x-text-input name="delegates[__INDEX__][country_preference_1_2]" class="block mt-1 w-full"
                            type="text" required />
                    </div>
                    <div class="md:col-span-3">
                        <x-input-label :value="__('Reason for Council Choice')" />
                        <textarea name="delegates[__INDEX__][reason_for_council_preference_1]" rows="3"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            required></textarea>
                    </div>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3 font-semibold text-slate-600">Council Preference 2</div>
                    <div>
                        <x-input-label :value="__('Council')" />
                        <select name="delegates[__INDEX__][council_preference_2]" class="input-select-basic" required>
                            <option value="">Select Council</option>
                            <option value="UNEP">UNEP (Beginner, Offline)</option>
                            <option value="UNHRC">UNHRC (Beginner, Online)</option>
                            <option value="IAEA">IAEA (Intermediate, Online)</option>
                            <option value="NATO">NATO (Advanced, Online)</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label :value="__('Country 1')" />
                        <x-text-input name="delegates[__INDEX__][country_preference_2_1]" class="block mt-1 w-full"
                            type="text" required />
                    </div>
                    <div>
                        <x-input-label :value="__('Country 2')" />
                        <x-text-input name="delegates[__INDEX__][country_preference_2_2]" class="block mt-1 w-full"
                            type="text" required />
                    </div>
                    <div class="md:col-span-3">
                        <x-input-label :value="__('Reason for Council Choice')" />
                        <textarea name="delegates[__INDEX__][reason_for_council_preference_2]" rows="3"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            required></textarea>
                    </div>
                </div>

                {{-- Confirmation --}}
                <h4 class="md:col-span-2 text-lg font-semibold text-slate-700 border-b pb-2 mt-4">Confirmation</h4>
                <div class="md:col-span-2 space-y-3">
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" name="delegates[__INDEX__][info_confirmation]" value="1"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1"
                            required>
                        <span class="ml-3 text-sm text-gray-700">I confirm that all the information I have provided is true
                            and correct.</span>
                    </label>
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" name="delegates[__INDEX__][data_usage_agreement]" value="1"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1"
                            required>
                        <span class="ml-3 text-sm text-gray-700">I agree to allow the organizing committee to use my
                            personal data for administrative and event-related purposes.</span>
                    </label>
                </div>
            </div>
        </div>
    </template>

    {{-- CSS UNTUK STEPPER & FORM --}}
    <style>
        .stepper-item {
            @apply flex items-center;
        }

        .stepper-item .step-counter {
            @apply relative flex items-center justify-center w-10 h-10 rounded-full font-semibold transition duration-500 ease-in-out bg-slate-200 text-slate-500 flex-shrink-0;
        }

        .stepper-item .step-name {
            @apply ml-3 text-sm font-medium text-slate-500;
        }

        .stepper-item.completed .step-counter,
        .stepper-item.active .step-counter {
            @apply bg-indigo-600 text-white;
        }

        .stepper-item.completed .step-name,
        .stepper-item.active .step-name {
            @apply text-slate-800;
        }

        #stepper>.border-t-2 {
            @apply mx-4;
        }

        .stepper-item.completed+.border-t-2,
        .stepper-item.active+.border-t-2 {
            @apply border-indigo-600;
        }

        .form-step {
            display: none;
        }

        .form-step.active-step {
            display: block;
        }

        /* Basic styles for inputs inside template to avoid repeating long class lists */
        .input-file-basic {
            @apply block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-1;
        }

        .input-select-basic {
            @apply border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full;
        }

        .input-textarea-basic {
            @apply border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full;
        }
    </style>

    {{-- SCRIPT GABUNGAN: Multi-Step Navigation + Dynamic Delegate Forms --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===================================
            //  MULTI-STEP NAVIGATION LOGIC
            // ===================================
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            const formSteps = Array.from(document.querySelectorAll('.form-step'));
            const stepperItems = Array.from(document.querySelectorAll('.stepper-item'));
            let currentStep = 0;

            nextBtn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    if (currentStep < formSteps.length - 1) {
                        currentStep++;
                        updateFormSteps();
                    }
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateFormSteps();
                }
            });

            function validateStep(stepIndex) {
                const currentStepElement = formSteps[stepIndex];
                const inputs = currentStepElement.querySelectorAll(
                    'input[required], select[required], textarea[required]');
                let isValid = true;
                for (const input of inputs) {
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        isValid = false;
                        break;
                    }
                }
                return isValid;
            }

            function updateFormSteps() {
                formSteps.forEach((step, index) => step.classList.toggle('active-step', index === currentStep));
                updateStepper();
                updateButtons();
            }

            function updateStepper() {
                stepperItems.forEach((item, index) => {
                    item.classList.toggle('active', index === currentStep);
                    item.classList.toggle('completed', index < currentStep);
                });
            }

            function updateButtons() {
                prevBtn.disabled = currentStep === 0;
                nextBtn.classList.toggle('hidden', currentStep === formSteps.length - 1);
                submitBtn.classList.toggle('hidden', currentStep !== formSteps.length - 1);
            }
            updateFormSteps();

            // ===================================
            //  DELEGATION FORM LOGIC
            // ===================================
            const container = document.getElementById('delegates-container');
            const template = document.getElementById('delegate-template');
            const delegateSelector = document.getElementById('delegate-selector');
            const packageSelector = document.getElementById('package-selector');
            const paymentDisplay = document.getElementById('total-payment-display');
            const totalPriceEl = document.getElementById('total-price');
            const priceBreakdownEl = document.getElementById('price-breakdown');

            const referralCodeInput = document.getElementById('referral_code');
            const referralStatusEl = document.getElementById('referral-status');
            const referralLoadingEl = document.getElementById('referral-loading');
            const csrfToken = document.querySelector('input[name="_token"]').value;
            let currentDiscount = 0;

            const pricing = {
                'Full Accommodation': {
                    2: 2240000,
                    3: 3360000,
                    4: 4480000,
                    5: 5600000
                },
                'Non-Accommodation': {
                    2: 990000,
                    3: 1485000,
                    4: 1980000,
                    5: 2475000
                },
                'Online': {
                    2: 180000,
                    3: 261000,
                    4: 340000,
                    5: 410000
                }
            };

            const oldDelegates = {!! json_encode(old('delegates')) !!} || [];
            const oldPackageType = "{{ old('package_type') }}";
            const oldDelegateCount = "{{ old('delegate_count') }}";

            const renderForms = (count, packageType) => {
                container.innerHTML = '';
                const needsAccommodation = packageType === 'Full Accommodation';
                const attendanceType = packageType === 'Online' ? 'Online' : 'Offline';

                for (let i = 0; i < count; i++) {
                    const clone = template.content.cloneNode(true);
                    let html = clone.firstElementChild.innerHTML;
                    html = html.replace(/__INDEX__/g, i);
                    const newBlock = document.createElement('div');
                    newBlock.innerHTML = html;
                    newBlock.className = template.content.firstElementChild.className;

                    newBlock.querySelector('.delegate-title').textContent = `Delegate #${i + 1}`;
                    newBlock.querySelector(`[name="delegates[${i}][package_type]"]`).value = packageType;
                    newBlock.querySelector(`[name="delegates[${i}][needs_accommodation]"]`).value =
                        needsAccommodation ? '1' : '0';
                    newBlock.querySelector(`[name="delegates[${i}][attendance_type]"]`).value = attendanceType;

                    container.appendChild(newBlock);
                }
            };

            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            async function checkReferralCode() {
                const code = referralCodeInput.value.trim();
                if (code === '') {
                    currentDiscount = 0;
                    referralStatusEl.textContent = '';
                    updatePrice();
                    return;
                }

                referralLoadingEl.classList.remove('hidden');
                referralStatusEl.textContent = '';

                try {
                    const response = await fetch("{{ route('referrals.check') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            code: code
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.valid) {
                        currentDiscount = parseFloat(data.discount_amount);
                        referralStatusEl.innerHTML =
                            `<span class="font-semibold text-green-600">✅ ${data.message}</span>`;
                    } else {
                        currentDiscount = 0;
                        referralStatusEl.innerHTML =
                            `<span class="font-semibold text-red-600">❌ ${data.message || 'Invalid code.'}</span>`;
                    }
                } catch (error) {
                    currentDiscount = 0;
                    referralStatusEl.innerHTML =
                        `<span class="font-semibold text-red-600">❌ Error connecting to server.</span>`;
                } finally {
                    referralLoadingEl.classList.add('hidden');
                    updatePrice();
                }
            }

            const updatePrice = () => {
                const selectedPackage = document.querySelector('input[name="package_type"]:checked');
                const selectedCount = document.querySelector('input[name="delegate_count"]:checked');

                if (selectedPackage && selectedCount) {
                    const packageType = selectedPackage.value;
                    const delegateCount = parseInt(selectedCount.value, 10);
                    let price = pricing[packageType]?.[delegateCount] ?? 0;

                    price -= currentDiscount;
                    price = Math.max(0, price);

                    totalPriceEl.textContent = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(price);
                    let breakdownText = `${delegateCount} delegates for ${packageType}`;
                    if (currentDiscount > 0) {
                        breakdownText += ` (with referral discount)`;
                    }
                    priceBreakdownEl.textContent = breakdownText;

                    paymentDisplay.classList.remove('hidden');
                } else {
                    paymentDisplay.classList.add('hidden');
                }
            };

            const populateOldData = () => {
                if (oldDelegates.length > 0) {
                    oldDelegates.forEach((data, index) => {
                        if (index < container.children.length) {
                            const delegateBlock = container.children[index];
                            Object.keys(data).forEach(key => {
                                const input = delegateBlock.querySelector(
                                    `[name="delegates[${index}][${key}]"]`);
                                if (input) {
                                    if (input.type === 'checkbox') input.checked = !!data[key];
                                    else input.value = data[key];
                                }
                            });
                        }
                    });
                }
            };

            const updateAndRender = () => {
                const selectedPackage = document.querySelector('input[name="package_type"]:checked');
                const selectedCount = document.querySelector('input[name="delegate_count"]:checked');
                if (selectedPackage && selectedCount) {
                    renderForms(parseInt(selectedCount.value, 10), selectedPackage.value);
                    populateOldData();
                } else {
                    container.innerHTML =
                        `<div class="text-center text-slate-500 bg-slate-100 p-6 rounded-lg">Please select a package and number of delegates in Step 1 to see the forms here.</div>`;
                }
                updatePrice();
            };

            packageSelector.addEventListener('change', updateAndRender);
            delegateSelector.addEventListener('change', updateAndRender);
            referralCodeInput.addEventListener('input', debounce(checkReferralCode, 500));

            function setupFileUpload(inputId, textId) {
                const input = document.getElementById(inputId);
                const text = document.getElementById(textId);
                if (input && text) {
                    input.addEventListener('change', () => {
                        text.textContent = input.files.length > 0 ? input.files[0].name :
                            'Click to upload file. Max 2MB.';
                    });
                }
            }
            setupFileUpload('payment_proof', 'payment_proof_filename');

            if (oldPackageType) document.querySelector(`input[name="package_type"][value="${oldPackageType}"]`)
                .checked = true;
            if (oldDelegateCount) document.querySelector(
                `input[name="delegate_count"][value="${oldDelegateCount}"]`).checked = true;
            updateAndRender();
        });
    </script>
@endsection
