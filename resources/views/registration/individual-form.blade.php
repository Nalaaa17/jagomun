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
            <div id="personal-details-section">
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
                            {{-- =============================================== --}}
                            {{-- PERUBAHAN DI SINI: Label dinamis --}}
                            {{-- =============================================== --}}
                            <x-input-label for="nationality" :value="__(Str::contains($delegateType, 'International') ? 'Nationality' : 'Domicile')" />
                            <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" required />
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="institution" :value="__('Institution')" />
                            <x-text-input id="institution" class="block mt-1 w-full" type="text" name="institution" :value="old('institution')" />
                            <x-input-error :messages="$errors->get('institution')" class="mt-2" />
                        </div>
                        <div class="md:col-span-2 mt-4">
                            <x-input-label :value="__('Attendance Method')" class="mb-2" />
                            <div class="flex items-center space-x-6">
                                <label for="attendance_offline" class="flex items-center cursor-pointer">
                                    <input id="attendance_offline" type="radio" name="attendance_type" value="Offline" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" checked>
                                    <span class="ml-2 text-sm text-gray-700">Offline</span>
                                </label>
                                <label for="attendance_online" class="flex items-center cursor-pointer">
                                    <input id="attendance_online" type="radio" name="attendance_type" value="Online" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Online</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('attendance_type')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Council Preferences --}}
            <div id="council-preferences-section">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Council Preferences</h2>
                    <p class="text-gray-600 mb-4">You can set your preferred councils and countries here.</p>
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 1</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="council_preference_1" :value="__('Council Preference')" />
                                <select id="council_preference_1" name="council_preference_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Council</option><option value="UNSC">UNSC</option><option value="UNHRC">UNHRC</option><option value="WHO">WHO</option><option value="ECOSOC">ECOSOC</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="country_preference_1_1" :value="__('Country Preference 1')" />
                                <select id="country_preference_1_1" name="country_preference_1_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Country</option><option value="USA">USA</option><option value="China">China</option><option value="Indonesia">Indonesia</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="country_preference_1_2" :value="__('Country Preference 2')" />
                                <select id="country_preference_1_2" name="country_preference_1_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Country</option><option value="Germany">Germany</option><option value="Japan">Japan</option><option value="Brazil">Brazil</option>
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="reason_for_first_country_preference_1" :value="__('Reason for First Country Preference')" />
                                <textarea id="reason_for_first_country_preference_1" name="reason_for_first_country_preference_1" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="reason_for_second_country_preference_1" :value="__('Reason for Second Country Preference')" />
                                <textarea id="reason_for_second_country_preference_1" name="reason_for_second_country_preference_1" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 2</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="council_preference_2" :value="__('Council Preference')" />
                                <select id="council_preference_2" name="council_preference_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Council</option><option value="UNSC">UNSC</option><option value="UNHRC">UNHRC</option><option value="WHO">WHO</option><option value="ECOSOC">ECOSOC</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="country_preference_2_1" :value="__('Country Preference 1')" />
                                <select id="country_preference_2_1" name="country_preference_2_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Country</option><option value="USA">USA</option><option value="China">China</option><option value="Indonesia">Indonesia</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="country_preference_2_2" :value="__('Country Preference 2')" />
                                <select id="country_preference_2_2" name="country_preference_2_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Country</option><option value="Germany">Germany</option><option value="Japan">Japan</option><option value="Brazil">Brazil</option>
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="reason_for_first_country_preference_2" :value="__('Reason for First Country Preference')" />
                                <textarea id="reason_for_first_country_preference_2" name="reason_for_first_country_preference_2" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="reason_for_second_country_preference_2" :value="__('Reason for Second Country Preference')" />
                                <textarea id="reason_for_second_country_preference_2" name="reason_for_second_country_preference_2" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Package Selection --}}
            <div id="package-selection-section">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Package Selection</h2>
                    <div class="space-y-4">
                        <x-input-label :value="__('Please select your package')" />
                        <div id="package-list" class="space-y-2">
                            {{-- Pilihan paket akan dibuat oleh JavaScript di sini --}}
                        </div>
                        <x-input-error :messages="$errors->get('package_type')" class="mt-2" />
                    </div>

                    <div id="package-details-container" class="mt-4">
                        <div id="details-full" class="package-details hidden p-4 bg-gray-50 rounded-md border border-gray-200">
                            <h4 class="font-semibold text-gray-800 mb-2">What you get:</h4>
                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                                <li>Hotel Accommodation (4 Days, 3 Nights)</li><li>Airport/Station Transfer</li><li>Transportation during the event</li><li>Full Access to All Conference Sessions</li><li>Delegate Kit & Certificate</li><li>Coffee Breaks & Meals</li><li>Social Night & Gala Dinner Access</li>
                            </ul>
                        </div>
                        <div id="details-non" class="package-details hidden p-4 bg-gray-50 rounded-md border border-gray-200">
                             <h4 class="font-semibold text-gray-800 mb-2">What you get:</h4>
                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                                <li>Full Access to All Conference Sessions</li><li>Delegate Kit & Certificate</li><li>Coffee Breaks & Meals</li><li>Social Night & Gala Dinner Access</li><li class="text-gray-500"><em>(Does not include hotel and transportation)</em></li>
                            </ul>
                        </div>
                         <div id="details-online" class="package-details hidden p-4 bg-gray-50 rounded-md border border-gray-200">
                            <h4 class="font-semibold text-gray-800 mb-2">What you get:</h4>
                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                                <li>Full Access to All Conference Sessions via Zoom/Platform</li><li>Digital Delegate Kit</li><li>E-Certificate</li><li>Opportunity to win awards</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="needs_accommodation" class="flex items-center cursor-pointer">
                            <input type="hidden" name="needs_accommodation" value="0">
                            <input id="needs_accommodation" type="checkbox" name="needs_accommodation" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @if(old('needs_accommodation', false)) checked @endif>
                            <span class="ml-2 text-sm text-gray-700">{{ __('I need accommodation') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('needs_accommodation')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div id="continue-button-container" class="flex items-center justify-end mt-4">
                 <button type="button" id="lanjut-bayar-btn" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                    Lanjutkan ke Pembayaran
                </button>
            </div>

            <div id="payment-section" class="hidden mt-8">
                 <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <div id="total-pembayaran-display" class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded-md mb-8" role="alert">
                        <p class="font-bold">Total yang harus dibayar:</p>
                        <p id="biaya-paket" class="text-3xl font-extrabold"></p>
                        <p id="nama-paket" class="text-sm mt-1"></p>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment & Social Media Proof</h2>
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-2">
                            Please refer to Indonesia MUN Official Instagram (@indonesiamun) for the prices. Transfer the registration payment to:
                            <br><strong>Rekening Bank:</strong> Mahisa Akib 747373067600 (CIMB Niaga)
                            <br><strong>PayPal:</strong> nanasiyah0@gmail.com (PayPal)
                        </p>
                    </div>
                    <div class="mb-6">
                        <x-input-label for="payment_proof" :value="__('Payment Proof Upload')" />
                        <label for="payment_proof" class="flex items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <p class="mt-1 text-sm text-gray-600" id="payment_proof_filename">Please upload your file. Max size 2 MB.</p>
                                <p class="text-xs text-gray-500">Upload a proof of payment</p>
                            </div>
                            <input id="payment_proof" name="payment_proof" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                        </label>
                        <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="social_media_proof" :value="__('Social Media Upload (Click ')" />
                        <a href="#" target="_blank" class="text-blue-600 hover:underline">Click to see the petition template</a>)
                        <label for="social_media_proof" class="flex items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <div class="text-center">
                                 <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <p class="mt-1 text-sm text-gray-600" id="social_media_proof_filename">Please upload your file. Max size 2 MB.</p>
                                <p class="text-xs text-gray-500">Upload a proof of social media post/share</p>
                            </div>
                            <input id="social_media_proof" name="social_media_proof" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                        </label>
                        <x-input-error :messages="$errors->get('social_media_proof')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                 <button type="submit" id="submit-btn" class="hidden ml-4 px-8 py-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors">
                     {{ __('Submit Individual Registration') }}
                 </button>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const packagePrices = {
        'Full Accommodation': 1500000,
        'Non-Accommodation': 850000,
        'Online': 350000
    };

    const lanjutBtn = document.getElementById('lanjut-bayar-btn');
    const submitBtn = document.getElementById('submit-btn');
    const continueButtonContainer = document.getElementById('continue-button-container');
    const paymentSection = document.getElementById('payment-section');
    const biayaPaketEl = document.getElementById('biaya-paket');
    const namaPaketEl = document.getElementById('nama-paket');

    const attendanceOffline = document.getElementById('attendance_offline');
    const attendanceOnline = document.getElementById('attendance_online');
    const needsAccommodationCheckbox = document.getElementById('needs_accommodation');
    const allDetails = document.querySelectorAll('.package-details');
    const packageListContainer = document.getElementById('package-list');

    Object.keys(packagePrices).forEach((name, index) => {
        const slug = name.toLowerCase().replace(/ /g, '-');
        const price = packagePrices[name];
        const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);

        const label = document.createElement('label');
        label.htmlFor = `package_${slug}`;
        label.className = "flex justify-between items-center cursor-pointer p-3 border rounded-md has-[:checked]:bg-blue-100 has-[:checked]:border-blue-400";

        label.innerHTML = `
            <div class="flex items-center">
                <input id="package_${slug}" type="radio" name="package_type" value="${name}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" ${index === 0 ? 'checked' : ''}>
                <span class="ml-3 text-sm font-medium text-gray-800">${name}</span>
            </div>
            <span class="text-sm font-semibold text-indigo-700">${formattedPrice}</span>
        `;
        if(packageListContainer) packageListContainer.appendChild(label);
    });

    const allPackageRadios = document.querySelectorAll('input[name="package_type"]');
    const packageFull = document.getElementById('package_full-accommodation');
    const packageNon = document.getElementById('package_non-accommodation');
    const packageOnline = document.getElementById('package_online');

    function updatePriceDisplay() {
        const selectedPackageInput = document.querySelector('input[name="package_type"]:checked');
        if (!selectedPackageInput) return;
        const selectedPackageName = selectedPackageInput.value;
        const price = packagePrices[selectedPackageName];
        const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);
        biayaPaketEl.textContent = formattedPrice;
        namaPaketEl.textContent = `For package: ${selectedPackageName}`;
    }

    function updatePackageDetails() {
        allDetails.forEach(detail => detail.classList.add('hidden'));
        const selectedPackage = document.querySelector('input[name="package_type"]:checked');
        if (!selectedPackage) return;

        if (selectedPackage.value.includes('Full')) {
            document.getElementById('details-full').classList.remove('hidden');
        } else if (selectedPackage.value.includes('Non')) {
            document.getElementById('details-non').classList.remove('hidden');
        } else if (selectedPackage.value.includes('Online')) {
            document.getElementById('details-online').classList.remove('hidden');
        }
    }

    function updatePackageState() {
        if (attendanceOnline.checked) {
            if(packageOnline) packageOnline.checked = true;
            if(packageFull) packageFull.disabled = true;
            if(packageNon) packageNon.disabled = true;
            if(packageOnline) packageOnline.disabled = false;
        } else {
            if(packageFull) packageFull.disabled = false;
            if(packageNon) packageNon.disabled = false;
            if(packageOnline) packageOnline.disabled = true;
            if (packageOnline && packageOnline.checked) {
                if(packageFull) packageFull.checked = true;
            }
        }

        const currentSelected = document.querySelector('input[name="package_type"]:checked');
        if (currentSelected && currentSelected.value.includes('Full') && !currentSelected.disabled) {
            needsAccommodationCheckbox.checked = true;
            needsAccommodationCheckbox.disabled = true;
        } else {
            needsAccommodationCheckbox.checked = false;
            needsAccommodationCheckbox.disabled = true;
        }

        updatePackageDetails();
        if (!paymentSection.classList.contains('hidden')) {
            updatePriceDisplay();
        }
    }

    if (lanjutBtn) {
        lanjutBtn.addEventListener('click', function() {
            if (!document.querySelector('input[name="package_type"]:checked')) {
                alert('Please select your package first!');
                return;
            }
            updatePriceDisplay();
            paymentSection.classList.remove('hidden');
            submitBtn.classList.remove('hidden');
            continueButtonContainer.classList.add('hidden');
            paymentSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }

    [attendanceOffline, attendanceOnline, ...allPackageRadios].forEach(el => {
        if(el) el.addEventListener('change', updatePackageState);
    });

    function setupFileUpload(inputId, textId) {
        const input = document.getElementById(inputId);
        const text = document.getElementById(textId);
        if(input && text) {
            input.addEventListener('change', () => {
                text.textContent = input.files.length > 0 ? input.files[0].name : 'Please upload your file. Max size 2 MB.';
            });
        }
    }
    setupFileUpload('payment_proof', 'payment_proof_filename');
    setupFileUpload('social_media_proof', 'social_media_proof_filename');

    updatePackageState();
});
</script>
@endsection
