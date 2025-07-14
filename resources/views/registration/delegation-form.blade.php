@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-8" style="background-color: #D2B48C; border: 2px solid #A0522D;">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-600 text-white mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path d="M14 14.252V22H4V14.252A4.5 4.5 0 0 1 8.5 10H14a4.5 4.5 0 0 1 4.5 4.5V22H16V14.5A2.5 2.5 0 0 0 13.5 12H9.5A2.5 2.5 0 0 0 7 14.5V22H6V14.252A4.5 4.5 0 0 1 9.5 10h4.001A4.5 4.5 0 0 1 14 14.252ZM8.5 9A3.5 3.5 0 1 1 8.5 2a3.5 3.5 0 0 1 0 7ZM15.5 9a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">I am Registering as Delegation ({{ $delegateType }})</h1>
            <p class="text-gray-700">Please fill out your institution and all delegate details below.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                <p class="font-bold">Oops! There were some problems with your input.</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registration.delegationSubmit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="delegate_type" value="{{ $delegateType }}">

            {{-- Institution Details --}}
            <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Institution Detail</h2>
                <x-input-label for="institution_name" :value="__('Institution Name')" />
                <x-text-input id="institution_name" class="block mt-1 w-full" type="text" name="institution_name" :value="old('institution_name')" required />
                <x-input-error :messages="$errors->get('institution_name')" class="mt-2" />
            </div>

            {{-- AWAL PERUBAHAN: Bagian Pemilihan Paket dan Jumlah Delegasi --}}
            <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Delegation Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="block font-medium text-sm text-gray-700 mb-3">Select Package Type for Delegation:</p>
                        <div id="package-selector" class="space-y-2">
                            <label for="package_type_full" class="flex items-center cursor-pointer">
                                <input type="radio" id="package_type_full" name="package_type" value="Full Accommodation" class="h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-800">Full Accommodation</span>
                            </label>
                            <label for="package_type_non" class="flex items-center cursor-pointer">
                                <input type="radio" id="package_type_non" name="package_type" value="Non-Accommodation" class="h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-800">Non-Accommodation</span>
                            </label>
                             <label for="package_type_online" class="flex items-center cursor-pointer">
                                <input type="radio" id="package_type_online" name="package_type" value="Online" class="h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-800">Online</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <p class="block font-medium text-sm text-gray-700 mb-3">How many delegates are in your group?</p>
                        <div id="delegate-selector" class="space-y-2">
                            @foreach ([2, 3, 4, 5] as $count)
                                <label for="delegate_count_{{ $count }}" class="flex items-center cursor-pointer">
                                    <input type="radio" id="delegate_count_{{ $count }}" name="delegate_count" value="{{ $count }}" class="h-4 w-4 text-indigo-600">
                                    <span class="ml-2 text-sm text-gray-800">{{ $count }} delegates</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- AKHIR PERUBAHAN --}}

            {{-- Delegate Forms Container --}}
            <div id="delegates-container" class="space-y-8">
                {{-- JavaScript will populate this area --}}
            </div>

            {{-- Payment Section --}}
            <div class="mt-12">
                <div class="border border-gray-300 p-6 rounded-lg bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment</h2>

                    {{-- AWAL PERUBAHAN: Tampilan Harga Dinamis --}}
                    <div id="total-payment-display" class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded-md mb-8 hidden" role="alert">
                        <p class="font-bold">Total yang harus dibayar</p>
                        <p id="total-price" class="text-3xl font-extrabold"></p>
                        <p id="price-breakdown" class="text-sm mt-1"></p>
                    </div>
                    {{-- AKHIR PERUBAHAN --}}

                    <div class="mb-6">
                        <x-input-label for="payment_proof" :value="__('Payment Proof Upload (for the whole delegation)')" />
                        <input id="payment_proof" name="payment_proof" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-1" accept=".jpg,.jpeg,.png,.pdf" required/>
                        <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end mt-8">
                <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors">
                    {{ __('Submit Delegation Registration') }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Template for a single delegate form -->
<template id="delegate-template">
    <div class="delegate-form-block border border-gray-300 p-6 rounded-lg bg-orange-50 bg-opacity-20 relative">
        <div class="flex justify-between items-center mb-6 border-b border-gray-300 pb-4">
            <h3 class="text-xl font-semibold text-gray-800 delegate-title">Delegate #</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
            {{-- Hidden inputs for package type and accommodation status --}}
            <input type="hidden" name="delegates[__INDEX__][package_type]" value="">
            <input type="hidden" name="delegates[__INDEX__][needs_accommodation]" value="">
            <input type="hidden" name="delegates[__INDEX__][attendance_type]" value="">

            {{-- Personal Info --}}
            <h4 class="md:col-span-2 text-lg font-semibold text-gray-700 border-b pb-2">Personal Information</h4>
            <div>
                <x-input-label for="delegates[__INDEX__][full_name]" :value="__('Full Name')" />
                <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][full_name]" required />
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][email]" :value="__('Email')" />
                <x-text-input class="block mt-1 w-full" type="email" name="delegates[__INDEX__][email]" required />
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][date_of_birth]" :value="__('Date of Birth')" />
                <x-text-input class="block mt-1 w-full" type="date" name="delegates[__INDEX__][date_of_birth]" required />
            </div>
             <div>
                <x-input-label for="delegates[__INDEX__][age]" :value="__('Age')" />
                <x-text-input class="block mt-1 w-full" type="number" name="delegates[__INDEX__][age]" required />
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][gender]" :value="__('Gender')" />
                <select name="delegates[__INDEX__][gender]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                    <option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option>
                </select>
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][phone]" :value="__('Contact Number')" />
                <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][phone]" placeholder="+62 812..." required />
            </div>
            <div class="md:col-span-2">
                <x-input-label for="delegates[__INDEX__][full_address]" :value="__('Full Address')" />
                <textarea name="delegates[__INDEX__][full_address]" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required></textarea>
            </div>
             <div>
                <x-input-label for="delegates[__INDEX__][nationality]" :value="__('Nationality')" />
                <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][nationality]" required />
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][partnership_code]" :value="__('Partnership Code')" />
                <x-text-input class="block mt-1 w-full" type="text" name="delegates[__INDEX__][partnership_code]" value="-" required />
            </div>

            {{-- Experience --}}
            <h4 class="md:col-span-2 text-lg font-semibold text-gray-700 border-b pb-2 mt-4">Experience & Documents</h4>
            <div class="md:col-span-2">
                <x-input-label for="delegates[__INDEX__][previous_mun_experience]" :value="__('Previous MUN Experience (if any)')" />
                <textarea name="delegates[__INDEX__][previous_mun_experience]" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
            </div>
            <div class="md:col-span-2">
                <x-input-label for="delegates[__INDEX__][mun_awards]" :value="__('MUN Awards (if any)')" />
                <textarea name="delegates[__INDEX__][mun_awards]" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][student_id]" :value="__('Student ID (PDF)')" />
                <input name="delegates[__INDEX__][student_id]" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-1" accept=".pdf" required />
            </div>
            <div>
                <x-input-label for="delegates[__INDEX__][parental_consent]" :value="__('Parental Consent (PDF, if <= 17 y.o)')" />
                <input name="delegates[__INDEX__][parental_consent]" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-1" accept=".pdf" />
            </div>
             <div class="md:col-span-2">
                <x-input-label for="delegates[__INDEX__][social_media_proof_path]" :value="__('Social Media Proof (Optional)')" />
                <input name="delegates[__INDEX__][social_media_proof_path]" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-1" accept=".jpg,.jpeg,.png,.pdf" />
            </div>

            {{-- Council Preferences --}}
            <h4 class="md:col-span-2 text-lg font-semibold text-gray-700 border-b pb-2 mt-4">Council Preferences</h4>
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 border-b border-gray-200 pb-6">
                <div class="md:col-span-3 font-semibold">Council Preference 1</div>
                <div>
                    <x-input-label for="delegates[__INDEX__][council_preference_1]" :value="__('Council')" />
                    <select name="delegates[__INDEX__][council_preference_1]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                         <option value="">Select Council</option><option value="UNEP">UNEP</option><option value="UNHRC">UNHRC</option><option value="IAEA">IAEA</option><option value="NATO">NATO</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][country_preference_1_1]" :value="__('Country 1')" />
                    <x-text-input name="delegates[__INDEX__][country_preference_1_1]" class="block mt-1 w-full" type="text" required />
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][country_preference_1_2]" :value="__('Country 2')" />
                    <x-text-input name="delegates[__INDEX__][country_preference_1_2]" class="block mt-1 w-full" type="text" required />
                </div>
                <div class="md:col-span-3">
                    <x-input-label for="delegates[__INDEX__][reason_for_council_preference_1]" :value="__('Reason for Council Choice')" />
                    <textarea name="delegates[__INDEX__][reason_for_council_preference_1]" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required></textarea>
                </div>
            </div>
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                 <div class="md:col-span-3 font-semibold">Council Preference 2</div>
                <div>
                    <x-input-label for="delegates[__INDEX__][council_preference_2]" :value="__('Council')" />
                    <select name="delegates[__INDEX__][council_preference_2]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                         <option value="">Select Council</option><option value="UNEP">UNEP</option><option value="UNHRC">UNHRC</option><option value="IAEA">IAEA</option><option value="NATO">NATO</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][country_preference_2_1]" :value="__('Country 1')" />
                    <x-text-input name="delegates[__INDEX__][country_preference_2_1]" class="block mt-1 w-full" type="text" required />
                </div>
                <div>
                    <x-input-label for="delegates[__INDEX__][country_preference_2_2]" :value="__('Country 2')" />
                    <x-text-input name="delegates[__INDEX__][country_preference_2_2]" class="block mt-1 w-full" type="text" required />
                </div>
                <div class="md:col-span-3">
                    <x-input-label for="delegates[__INDEX__][reason_for_council_preference_2]" :value="__('Reason for Council Choice')" />
                    <textarea name="delegates[__INDEX__][reason_for_council_preference_2]" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required></textarea>
                </div>
            </div>

             {{-- Confirmation --}}
            <h4 class="md:col-span-2 text-lg font-semibold text-gray-700 border-b pb-2 mt-4">Confirmation</h4>
            <div class="md:col-span-2 space-y-3">
                <label class="flex items-start cursor-pointer">
                    <input type="checkbox" name="delegates[__INDEX__][info_confirmation]" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1" required>
                    <span class="ml-2 text-sm text-gray-700">I confirm that all the information I have provided is true and correct.</span>
                </label>
                <label class="flex items-start cursor-pointer">
                     <input type="checkbox" name="delegates[__INDEX__][data_usage_agreement]" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1" required>
                     <span class="ml-2 text-sm text-gray-700">I agree to allow the organizing committee to use my personal data for administrative and event-related purposes.</span>
                 </label>
            </div>
        </div>
    </div>
</template>

{{-- AWAL PERUBAHAN: Logika JavaScript Diperbarui Total --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('delegates-container');
    const template = document.getElementById('delegate-template');
    const delegateSelector = document.getElementById('delegate-selector');
    const packageSelector = document.getElementById('package-selector');

    const paymentDisplay = document.getElementById('total-payment-display');
    const totalPriceEl = document.getElementById('total-price');
    const priceBreakdownEl = document.getElementById('price-breakdown');

    // Data harga sesuai permintaan
    const pricing = {
        'Full Accommodation': { 2: 2240000, 3: 3360000, 4: 4480000, 5: 5600000 },
        'Non-Accommodation': { 2: 990000, 3: 1485000, 4: 1980000, 5: 2475000 },
        'Online': { 2: 180000, 3: 261000, 4: 340000, 5: 410000 }
    };

    const oldDelegates = {!! json_encode(old('delegates')) !!} || [];
    const oldPackageType = "{{ old('package_type', 'Full Accommodation') }}";
    const oldDelegateCount = "{{ old('delegate_count', 2) }}";

    const renderForms = (count, packageType) => {
        container.innerHTML = ''; // Hapus form yang ada
        const needsAccommodation = packageType === 'Full Accommodation';
        const attendanceType = packageType === 'Online' ? 'Online' : 'Offline';

        for (let i = 0; i < count; i++) {
            const clone = template.content.cloneNode(true);
            const newBlock = clone.firstElementChild;
            newBlock.innerHTML = newBlock.innerHTML.replace(/__INDEX__/g, i);

            const title = newBlock.querySelector('.delegate-title');
            if (title) title.textContent = `Delegate #${i + 1}`;

            // Set hidden input values for each delegate
            newBlock.querySelector(`[name="delegates[${i}][package_type]"]`).value = packageType;
            newBlock.querySelector(`[name="delegates[${i}][needs_accommodation]"]`).value = needsAccommodation ? '1' : '0';
            newBlock.querySelector(`[name="delegates[${i}][attendance_type]"]`).value = attendanceType;

            container.appendChild(newBlock);
        }
    };

    const updatePrice = () => {
        const selectedPackage = document.querySelector('input[name="package_type"]:checked');
        const selectedCount = document.querySelector('input[name="delegate_count"]:checked');

        if (selectedPackage && selectedCount) {
            const packageType = selectedPackage.value;
            const delegateCount = parseInt(selectedCount.value, 10);
            const price = pricing[packageType]?.[delegateCount] ?? 0;

            totalPriceEl.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);
            priceBreakdownEl.textContent = `${delegateCount} delegates for ${packageType}`;
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
                        const input = delegateBlock.querySelector(`[name="delegates[${index}][${key}]"]`);
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
            populateOldData(); // Re-populate after rendering
        } else {
            container.innerHTML = ''; // Clear forms if nothing is selected
        }
        updatePrice();
    };

    // Event Listeners
    packageSelector.addEventListener('change', updateAndRender);
    delegateSelector.addEventListener('change', updateAndRender);

    // Initial Setup
    const initialPackageRadio = document.querySelector(`input[name="package_type"][value="${oldPackageType}"]`);
    if (initialPackageRadio) initialPackageRadio.checked = true;

    const initialCountRadio = document.getElementById(`delegate_count_${oldDelegateCount}`);
    if (initialCountRadio) initialCountRadio.checked = true;

    // Initial render based on old data or defaults
    updateAndRender();
});
</script>
{{-- AKHIR PERUBAHAN --}}
@endsection
