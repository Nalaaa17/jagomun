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
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="full_name" :value="__('Full Name')" />
                            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')" required autofocus />
                        </div>
                        <div>
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                        </div>
                        <div>
                            <x-input-label for="age" :value="__('Age')" />
                            <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required />
                        </div>
                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Select Gender</option>
                                <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                                <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('Contact Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" placeholder="e.g., +62 812-3456-7890" required />
                        </div>
                        <div>
                            <x-input-label for="nationality" :value="__(Str::contains($delegateType, 'International') ? 'Nationality' : 'Domicile')" />
                            <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" required />
                        </div>
                        <div>
                            <x-input-label for="institution_name" :value="__('Institution')" />
                            <x-text-input id="institution_name" class="block mt-1 w-full" type="text" name="institution_name" :value="old('institution_name')" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="full_address" :value="__('Full Address')" />
                            <textarea id="full_address" name="full_address" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('full_address') }}</textarea>
                        </div>
                        <div class="md:col-span-2 mt-4">
                            <x-input-label :value="__('Attendance Method')" class="mb-2" />
                            <div class="flex items-center space-x-6">
                                <label for="attendance_offline" class="flex items-center cursor-pointer">
                                    <input id="attendance_offline" type="radio" name="attendance_type" value="Offline" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" {{ old('attendance_type', 'Offline') == 'Offline' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Offline</span>
                                </label>
                                <label for="attendance_online" class="flex items-center cursor-pointer">
                                    <input id="attendance_online" type="radio" name="attendance_type" value="Online" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" {{ old('attendance_type') == 'Online' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Online</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="experience-document-section">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Experience & Documents</h2>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <div>
                            <x-input-label for="previous_mun_experience" :value="__('Previous MUN Experience (if any)')" />
                            <p class="text-sm text-gray-600 mb-1">Format: MUN Name_Council_Year. Separate with a new line for multiple entries.</p>
                            <textarea id="previous_mun_experience" name="previous_mun_experience" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('previous_mun_experience') }}</textarea>
                        </div>
                        <div>
                            <x-input-label for="mun_awards" :value="__('MUN Awards (if any)')" />
                            <p class="text-sm text-gray-600 mb-1">Format: Award_MUN Name_Year. Separate with a new line for multiple entries.</p>
                            <textarea id="mun_awards" name="mun_awards" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('mun_awards') }}</textarea>
                        </div>
                        <div class="md:col-span-1">
                            <x-input-label for="student_id" :value="__('Student ID (Required - PDF format)')" />
                             <input id="student_id" name="student_id" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept=".pdf" required/>
                        </div>
                        <div class="md:col-span-1">
                            <x-input-label for="parental_consent" :value="__('Parental Consent Letter (PDF - If applicable)')" />
                            <p class="text-sm text-gray-600 mb-1">Required only for applicants aged 17 and below who will attend the offline conference. Template: <a href="http://bit.ly/ParentalConsentLetterJAGOMUN2025" target="_blank" class="text-blue-600 hover:underline">Download here</a></p>
                             <input id="parental_consent" name="parental_consent" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept=".pdf"/>
                        </div>
                         <div>
                            <x-input-label for="partnership_code" :value="__('Partnership Delegates Code')" />
                            <p class="text-sm text-gray-600 mb-1">If not applicable, you may write (-)</p>
                            <x-text-input id="partnership_code" class="block mt-1 w-full" type="text" name="partnership_code" :value="old('partnership_code', '-')" required />
                        </div>
                    </div>
                </div>
            </div>

            <div id="council-preferences-section">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Council and Country Preference</h2>
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 1</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="council_preference_1" :value="__('Council Preference')" />
                                <select id="council_preference_1" name="council_preference_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">Select Council</option>
                                    <option value="UNEP" @if(old('council_preference_1') == 'UNEP') selected @endif>UNEP (Beginner, Offline)</option>
                                    <option value="UNHRC" @if(old('council_preference_1') == 'UNHRC') selected @endif>UNHRC (Beginner, Online)</option>
                                    <option value="IAEA" @if(old('council_preference_1') == 'IAEA') selected @endif>IAEA (Intermediate, Online)</option>
                                    <option value="NATO" @if(old('council_preference_1') == 'NATO') selected @endif>NATO (Advanced, Online)</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="country_preference_1_1" :value="__('First Country Preference')" />
                                <x-text-input id="country_preference_1_1" class="block mt-1 w-full" type="text" name="country_preference_1_1" :value="old('country_preference_1_1')" required />
                            </div>
                            <div>
                                <x-input-label for="country_preference_1_2" :value="__('Second Country Preference')" />
                                <x-text-input id="country_preference_1_2" class="block mt-1 w-full" type="text" name="country_preference_1_2" :value="old('country_preference_1_2')" required />
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="reason_for_council_preference_1" :value="__('Reason for Your Choice of Council')" />
                                <textarea id="reason_for_council_preference_1" name="reason_for_council_preference_1" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('reason_for_council_preference_1') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 2</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="council_preference_2" :value="__('Council Preference')" />
                                <select id="council_preference_2" name="council_preference_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">Select Council</option>
                                    <option value="UNEP" @if(old('council_preference_2') == 'UNEP') selected @endif>UNEP (Beginner, Offline)</option>
                                    <option value="UNHRC" @if(old('council_preference_2') == 'UNHRC') selected @endif>UNHRC (Beginner, Online)</option>
                                    <option value="IAEA" @if(old('council_preference_2') == 'IAEA') selected @endif>IAEA (Intermediate, Online)</option>
                                    <option value="NATO" @if(old('council_preference_2') == 'NATO') selected @endif>NATO (Advanced, Online)</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="country_preference_2_1" :value="__('First Country Preference')" />
                                <x-text-input id="country_preference_2_1" class="block mt-1 w-full" type="text" name="country_preference_2_1" :value="old('country_preference_2_1')" required />
                            </div>
                            <div>
                                <x-input-label for="country_preference_2_2" :value="__('Second Country Preference')" />
                                <x-text-input id="country_preference_2_2" class="block mt-1 w-full" type="text" name="country_preference_2_2" :value="old('country_preference_2_2')" required />
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="reason_for_council_preference_2" :value="__('Reason for Your Choice of Council')" />
                                <textarea id="reason_for_council_preference_2" name="reason_for_council_preference_2" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('reason_for_council_preference_2') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="package-selection-section">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Package & Payment</h2>
                    <div class="space-y-4">
                        <x-input-label :value="__('Please select your package')" />
                        <div id="package-list" class="space-y-2"></div>
                        <x-input-error :messages="$errors->get('package_type')" class="mt-2" />
                    </div>
                    {{-- AWAL PERUBAHAN: Checkbox dihapus, hanya ada hidden input --}}
                    <input type="hidden" name="needs_accommodation" id="needs_accommodation_input" value="0">
                    {{-- AKHIR PERUBAHAN --}}
                    <input type="hidden" name="total_price" id="total_price_input" value="0">
                </div>
            </div>

            <div id="payment-section" class="mt-8">
                 <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <div id="total-pembayaran-display" class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded-md mb-8" role="alert">
                        <p class="font-bold">Total to be paid:</p>
                        <p id="biaya-paket" class="text-3xl font-extrabold"></p>
                        <p id="nama-paket" class="text-sm mt-1"></p>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment & Social Media Proof</h2>
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-2">
                            Please refer to Indonesia MUN Official Instagram (@indonesiamun) for the prices. Transfer the registration payment to:
                            <br><strong>Bank Account:</strong> Mahisa Akib 747373067600 (CIMB Niaga)
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
                            <input id="payment_proof" name="payment_proof" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" required />
                        </label>
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
                            <input id="social_media_proof" name="social_media_proof" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" required />
                        </label>
                    </div>
                </div>
            </div>

            <div id="confirmation-section">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                     <h2 class="text-2xl font-semibold text-gray-700 mb-6">Confirmation</h2>
                     <div class="space-y-4">
                        <label for="info_confirmation" class="flex items-start cursor-pointer">
                            <input id="info_confirmation" type="checkbox" name="info_confirmation" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1" required>
                            <span class="ml-2 text-sm text-gray-700">I confirm that all the information I have provided above is true and correct.</span>
                        </label>
                        <label for="data_usage_agreement" class="flex items-start cursor-pointer">
                             <input id="data_usage_agreement" type="checkbox" name="data_usage_agreement" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1" required>
                             <span class="ml-2 text-sm text-gray-700">I agree to allow the organizing committee to use my personal data for administrative and event-related purposes.</span>
                         </label>
                     </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                 <button type="submit" id="submit-btn" class="w-full sm:w-auto px-8 py-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors">
                    {{ __('Submit Individual Registration') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const packagePrices = {
        'Full Accommodation': 1145000,
        'Non-Accommodation': 505000,
        'Online': 95000
    };

    const biayaPaketEl = document.getElementById('biaya-paket');
    const namaPaketEl = document.getElementById('nama-paket');
    const packageListContainer = document.getElementById('package-list');
    const attendanceOffline = document.getElementById('attendance_offline');
    const attendanceOnline = document.getElementById('attendance_online');
    const needsAccommodationInput = document.getElementById('needs_accommodation_input'); // Menggunakan ID baru
    const totalPriceInput = document.getElementById('total_price_input');

    Object.keys(packagePrices).forEach((name) => {
        const slug = name.toLowerCase().replace(/ /g, '-');
        const price = packagePrices[name];
        const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);

        const label = document.createElement('label');
        label.htmlFor = `package_${slug}`;
        label.className = "flex justify-between items-center cursor-pointer p-3 border rounded-md has-[:checked]:bg-blue-100 has-[:checked]:border-blue-400";

        label.innerHTML = `
            <div class="flex items-center">
                <input id="package_${slug}" type="radio" name="package_type" value="${name}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                <span class="ml-3 text-sm font-medium text-gray-800">${name}</span>
            </div>
            <span class="text-sm font-semibold text-indigo-700">${formattedPrice}</span>
        `;
        if(packageListContainer) packageListContainer.appendChild(label);
    });

    const allPackageRadios = document.querySelectorAll('input[name="package_type"]');

    function updateState() {
        const selectedPackageInput = document.querySelector('input[name="package_type"]:checked');
        let currentPrice = 0;

        if (selectedPackageInput) {
            const selectedPackageName = selectedPackageInput.value;
            currentPrice = packagePrices[selectedPackageName];
            const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(currentPrice);

            biayaPaketEl.textContent = formattedPrice;
            namaPaketEl.textContent = `For package: ${selectedPackageName}`;
        } else {
            biayaPaketEl.textContent = '';
            namaPaketEl.textContent = 'Please select a package';
        }

        totalPriceInput.value = currentPrice;

        // AWAL PERUBAHAN: Logika untuk mengatur nilai akomodasi
        if (selectedPackageInput && selectedPackageInput.value === 'Full Accommodation') {
            needsAccommodationInput.value = '1';
        } else {
            needsAccommodationInput.value = '0';
        }
        // AKHIR PERUBAHAN

        const isOnline = attendanceOnline.checked;
        allPackageRadios.forEach(radio => {
            const isOnlinePackage = radio.value === 'Online';
            if (isOnline) {
                radio.disabled = !isOnlinePackage;
                if (!isOnlinePackage && radio.checked) radio.checked = false;
            } else {
                radio.disabled = isOnlinePackage;
                if (isOnlinePackage && radio.checked) radio.checked = false;
            }
        });

        const firstAvailable = document.querySelector('input[name="package_type"]:not(:disabled)');
        let currentlySelected = document.querySelector('input[name="package_type"]:checked');
        if (!currentlySelected && firstAvailable) {
            firstAvailable.checked = true;
            currentlySelected = firstAvailable;
        }

        if (currentlySelected) {
             currentPrice = packagePrices[currentlySelected.value];
             biayaPaketEl.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(currentPrice);
             namaPaketEl.textContent = `For package: ${currentlySelected.value}`;
             totalPriceInput.value = currentPrice;
             // Perbarui status akomodasi lagi setelah auto-select
             needsAccommodationInput.value = currentlySelected.value === 'Full Accommodation' ? '1' : '0';
        } else {
             biayaPaketEl.textContent = '';
             namaPaketEl.textContent = 'Please select a package';
             totalPriceInput.value = 0;
             needsAccommodationInput.value = '0';
        }
    }

    packageListContainer.addEventListener('change', updateState);
    attendanceOffline.addEventListener('change', updateState);
    attendanceOnline.addEventListener('change', updateState);

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

    updateState();
});
</script>
@endsection
