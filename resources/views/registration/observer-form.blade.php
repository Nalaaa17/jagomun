@extends('layouts.app')

@section('content')
    <div class="bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            {{-- WIZARD / STEPPER (Disesuaikan untuk 2 Langkah) --}}
            <div class="mb-10 px-4">
                <div id="stepper" class="flex items-center max-w-lg mx-auto">
                    {{-- Step 1: Personal Details --}}
                    <div class="stepper-item active">
                        <div class="step-counter"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg></div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    {{-- Step 2: Payment --}}
                    <div class="stepper-item">
                        <div class="step-counter"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 21z" />
                            </svg></div>
                    </div>
                </div>
            </div>
            {{-- END STEPPER --}}

            <div class="bg-white shadow-2xl shadow-slate-300/20 rounded-xl p-8">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-slate-800">Registering as {{ $delegateType }}</h1>
                    <p class="text-slate-500 mt-2">Please fill out your details correctly in each step.</p>
                </div>

                <form id="registration-form" action="{{ route('registration.observerSubmit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="delegate_type" value="{{ $delegateType }}">

                    {{-- STEP 1: Personal Details --}}
                    <div id="step-1" class="form-step active-step">
                        <div class="step-content">
                            <h2 class="text-2xl font-semibold text-slate-700 mb-6 border-l-4 border-indigo-500 pl-4">
                                Personal Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="full_name" :value="__('Full Name')" />
                                    <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                                        :value="old('full_name')" required autofocus />
                                </div>
                                <div>
                                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                    <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date"
                                        name="date_of_birth" :value="old('date_of_birth')" required />
                                </div>
                                <div>
                                    <x-input-label for="age" :value="__('Age')" />
                                    <x-text-input id="age" class="block mt-1 w-full" type="number" name="age"
                                        :value="old('age')" required />
                                </div>
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender"
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                        required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" @if (old('gender') == 'Male') selected @endif>Male
                                        </option>
                                        <option value="Female" @if (old('gender') == 'Female') selected @endif>Female
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required />
                                </div>
                                <div>
                                    <x-input-label for="phone" :value="__('Contact Number')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                        :value="old('phone')" placeholder="e.g., +62 812-3456-7890" required />
                                </div>
                                <div>
                                    <x-input-label for="nationality" :value="__(
                                        Str::contains($delegateType, 'International') ? 'Nationality' : 'Domicile',
                                    )" />
                                    <x-text-input id="nationality" class="block mt-1 w-full" type="text"
                                        name="nationality" :value="old('nationality')" required />
                                </div>
                                <div>
                                    <x-input-label for="institution_name" :value="__('Institution')" />
                                    <x-text-input id="institution_name" class="block mt-1 w-full" type="text"
                                        name="institution_name" :value="old('institution_name')" required />
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label for="full_address" :value="__('Full Address')" />
                                    <textarea id="full_address" name="full_address" rows="3"
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                        required>{{ old('full_address') }}</textarea>
                                </div>

                                {{-- ====================================================================== --}}
                                {{-- === AWAL PERUBAHAN: Menambahkan Council Preference === --}}
                                {{-- ====================================================================== --}}
                                <div class="md:col-span-2">
                                    <x-input-label for="council_preference_1" :value="__('Council Preference')" />
                                    <select id="council_preference_1" name="council_preference_1"
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                        required>
                                        <option value="">Select Council to Observe</option>
                                        <option value="UNEP" @if (old('council_preference_1') == 'UNEP') selected @endif>UNEP
                                            (Beginner, Offline)</option>
                                        <option value="UNHRC" @if (old('council_preference_1') == 'UNHRC') selected @endif>UNHRC
                                            (Beginner, Online)</option>
                                        <option value="IAEA" @if (old('council_preference_1') == 'IAEA') selected @endif>IAEA
                                            (Intermediate, Online)</option>
                                        <option value="NATO" @if (old('council_preference_1') == 'NATO') selected @endif>NATO
                                            (Advanced, Online)</option>
                                    </select>
                                </div>
                                {{-- ====================================================================== --}}
                                {{-- === AKHIR PERUBAHAN === --}}
                                {{-- ====================================================================== --}}

                                <div class="md:col-span-2 mt-4">
                                    <x-input-label :value="__('Attendance Method')" class="mb-2" />
                                    <div class="flex items-center space-x-6">
                                        <label for="attendance_offline" class="flex items-center cursor-pointer">
                                            <input id="attendance_offline" type="radio" name="attendance_type"
                                                value="Offline"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                                {{ old('attendance_type', 'Offline') == 'Offline' ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">Offline</span>
                                        </label>
                                        <label for="attendance_online" class="flex items-center cursor-pointer">
                                            <input id="attendance_online" type="radio" name="attendance_type"
                                                value="Online"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                                {{ old('attendance_type') == 'Online' ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">Online</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 2: Package, Payment & Confirmation --}}
                    <div id="step-2" class="form-step">
                        <div class="step-content">
                            <h2 class="text-2xl font-semibold text-slate-700 mb-6 border-l-4 border-indigo-500 pl-4">
                                Package & Payment</h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                {{-- Kolom Kiri: Pilihan Paket, Total --}}
                                <div class="space-y-6">
                                    <div>
                                        <x-input-label :value="__('Please select your package')" class="mb-3" />
                                        <div id="package-list" class="space-y-3"></div>
                                        <x-input-error :messages="$errors->get('package_type')" class="mt-2" />
                                    </div>

                                    <div id="total-pembayaran-display"
                                        class="bg-indigo-50 border-l-4 border-indigo-500 text-indigo-900 p-4 rounded-r-lg"
                                        role="alert">
                                        <p class="font-bold">Total to be paid:</p>
                                        <p id="biaya-paket" class="text-3xl font-extrabold"></p>
                                        <p id="nama-paket" class="text-sm mt-1"></p>
                                    </div>
                                    <div class="text-sm text-slate-600 p-4 bg-slate-50 rounded-lg">
                                        Please refer to JAGOMUN Official Instagram (@jagomun.2025) for the prices. Transfer
                                        the registration payment to:
                                        <br><strong class="text-slate-800">Bank Account:</strong> BRI: 095301059810538 A.N
                                        Nadia Aisha Syarif
                                        Seabank: 901044673651 A.N Nadia Aisha Syarif
                                        Jagobank: 109929292133 A.N Nadia Aisha Syarif
                                        <br><strong class="text-slate-800">E- wallet :</strong> Shopeepay:
                                        088289799127 A.N Pididididi
                                        <br><strong class="text-slate-800">PayPal:</strong>
                                        <a href="https://www.paypal.me/NadiaAishaSyarif" class="text-blue-600 underline" target="_blank">
                                           NadiaAishaSyarif
                                        </a>
                                    </div>
                                </div>
                                {{-- Kolom Kanan: File Uploads & Confirmation --}}
                                <div class="space-y-6">
                                    <div>
                                        <x-input-label for="payment_proof" :value="__('Payment Proof Upload')" />
                                        <label for="payment_proof"
                                            class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 mt-2 cursor-pointer hover:border-indigo-500 hover:bg-slate-50 transition duration-150 ease-in-out">
                                            <div class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-1 text-sm text-gray-600" id="payment_proof_filename">Click to
                                                    upload file. Max 2MB.</p>
                                            </div>
                                            <input id="payment_proof" name="payment_proof" type="file" class="hidden"
                                                accept=".jpg,.jpeg,.png,.pdf" required />
                                        </label>
                                    </div>
                                    <div>
                                        <label class="font-medium text-sm text-gray-700">Social Media Upload <a
                                                href="https://www.instagram.com/jagomun.2025" target="_blank"
                                                class="text-indigo-600 hover:underline">@jagomun.2025</a></label>
                                        <label for="social_media_proof"
                                            class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 mt-2 cursor-pointer hover:border-indigo-500 hover:bg-slate-50 transition duration-150 ease-in-out">
                                            <div class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-1 text-sm text-gray-600" id="social_media_proof_filename">
                                                    Click to upload file. Max 2MB.</p>
                                            </div>
                                            <input id="social_media_proof" name="social_media_proof" type="file"
                                                class="hidden" accept=".jpg,.jpeg,.png,.pdf" required />
                                        </label>
                                    </div>
                                    <div class="pt-4">
                                        <h3 class="text-lg font-semibold text-slate-700 mb-4">Final Confirmation</h3>
                                        <div class="space-y-4">
                                            <label for="info_confirmation" class="flex items-start cursor-pointer">
                                                <input id="info_confirmation" type="checkbox" name="info_confirmation"
                                                    value="1"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1"
                                                    required>
                                                <span class="ml-3 text-sm text-gray-700">I confirm that all the information
                                                    I have provided is true and correct.</span>
                                            </label>
                                            <label for="data_usage_agreement" class="flex items-start cursor-pointer">
                                                <input id="data_usage_agreement" type="checkbox"
                                                    name="data_usage_agreement" value="1"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1"
                                                    required>
                                                <span class="ml-3 text-sm text-gray-700">I agree to allow the organizing
                                                    committee to use my personal data for event-related purposes.</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="total_price" id="total_price_input" value="0">

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
                            {{ __('Submit Observer Registration') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CSS for Stepper & Form Steps --}}
    <style>
        .stepper-item {
            @apply flex items-center;
        }

        .stepper-item .step-counter {
            @apply relative flex items-center justify-center w-10 h-10 rounded-full font-semibold transition duration-500 ease-in-out bg-slate-200 text-slate-500 flex-shrink-0;
        }

        .stepper-item.active .step-counter {
            @apply bg-indigo-600 text-white;
        }

        .stepper-item.completed+.border-t-2 {
            @apply border-indigo-600;
        }

        .form-step {
            display: none;
        }

        .form-step.active-step {
            display: block;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Multi-Step Form Logic ---
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
                formSteps.forEach((step, index) => {
                    step.classList.toggle('active-step', index === currentStep);
                });
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

            // --- Payment and Package Logic ---
            const packagePrices = {
                'Non-Accommodation': 495000,
                'Online': 50000
            };

            const biayaPaketEl = document.getElementById('biaya-paket');
            const namaPaketEl = document.getElementById('nama-paket');
            const packageListContainer = document.getElementById('package-list');
            const attendanceOffline = document.getElementById('attendance_offline');
            const attendanceOnline = document.getElementById('attendance_online');
            const totalPriceInput = document.getElementById('total_price_input');

            Object.keys(packagePrices).forEach((name) => {
                const slug = name.toLowerCase().replace(/ /g, '-');
                const price = packagePrices[name];
                const formattedPrice = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(price);

                const label = document.createElement('label');
                label.htmlFor = `package_${slug}`;
                label.className =
                    "flex justify-between items-center cursor-pointer p-4 border rounded-lg has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500 has-[:checked]:ring-2 has-[:checked]:ring-indigo-200 transition-all";

                label.innerHTML = `
            <div class="flex items-center">
                <input id="package_${slug}" type="radio" name="package_type" value="${name}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" required>
                <span class="ml-3 text-sm font-medium text-gray-800">${name}</span>
            </div>
            <span class="text-sm font-semibold text-indigo-700">${formattedPrice}</span>
        `;
                if (packageListContainer) packageListContainer.appendChild(label);
            });

            const allPackageRadios = document.querySelectorAll('input[name="package_type"]');

            function updatePackageAndPriceState() {
                const isOnline = attendanceOnline.checked;

                allPackageRadios.forEach(radio => {
                    const isOnlinePackage = radio.value === 'Online';
                    const parentLabel = radio.closest('label');
                    if (isOnline) {
                        radio.disabled = !isOnlinePackage;
                        parentLabel.classList.toggle('opacity-50', !isOnlinePackage);
                    } else {
                        radio.disabled = isOnlinePackage;
                        parentLabel.classList.toggle('opacity-50', isOnlinePackage);
                    }
                });

                let selectedPackageInput = document.querySelector('input[name="package_type"]:checked');
                if (selectedPackageInput && selectedPackageInput.disabled) {
                    selectedPackageInput.checked = false;
                    selectedPackageInput = null;
                }

                if (!selectedPackageInput) {
                    const firstAvailable = document.querySelector('input[name="package_type"]:not(:disabled)');
                    if (firstAvailable) {
                        firstAvailable.checked = true;
                        selectedPackageInput = firstAvailable;
                    }
                }

                let currentPrice = 0;
                if (selectedPackageInput) {
                    const selectedPackageName = selectedPackageInput.value;
                    currentPrice = packagePrices[selectedPackageName] || 0;
                    const formattedPrice = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(currentPrice);
                    biayaPaketEl.textContent = formattedPrice;
                    namaPaketEl.textContent = `For package: ${selectedPackageName}`;
                } else {
                    biayaPaketEl.textContent = 'Rp 0';
                    namaPaketEl.textContent = 'Please select a package';
                }
                totalPriceInput.value = currentPrice;
            }

            if (packageListContainer) {
                packageListContainer.addEventListener('change', updatePackageAndPriceState);
            }
            attendanceOffline.addEventListener('change', updatePackageAndPriceState);
            attendanceOnline.addEventListener('change', updatePackageAndPriceState);

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
            setupFileUpload('social_media_proof', 'social_media_proof_filename');

            updatePackageAndPriceState();
        });
    </script>
@endsection
