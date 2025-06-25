<div class="bg-white shadow-xl rounded-lg p-8" style="background-color: #D2B48C; border: 2px solid #A0522D;">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-600 text-white mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">I am Registering as Delegation ({{ $delegateType }})</h1>
        <p class="text-gray-700">Please fill out your institution details and delegate information below.</p>
    </div>

    <form wire:submit.prevent="submitForm" enctype="multipart/form-data"> {{-- Tambahkan enctype untuk upload file --}}
        {{-- Section: Institution Detail --}}
        <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Institution Detail</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="institution_name" :value="__('Institution Name')" />
                    <x-text-input id="institution_name" class="block mt-1 w-full" type="text" wire:model.live="institution_name" required autofocus /> {{-- wire:model.live untuk validasi real-time --}}
                    <x-input-error :messages="$errors->get('institution_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="accommodation_checkbox" :value="__('Do you need accommodation?')" />

                    <div class="block mt-1">
                        <label for="accommodation_checkbox" class="inline-flex items-center">
                            <input id="accommodation_checkbox" type="checkbox"
                                wire:model="do_you_need_accommodation"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="ml-2 text-gray-700 font-medium">Yes, I need accommodation</span>
                        </label>
                        <x-input-error :messages="$errors->get('do_you_need_accommodation')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Delegate Personal Details (Dynamic with Livewire) --}}
        @foreach($delegates as $index => $delegate)
            <div class="border border-gray-300 p-6 rounded-lg mb-6 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Delegate {{ $index + 1 }}</h2>
                <p class="text-gray-600 mb-4">Personal Details</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="delegates.{{$index}}.full_name" :value="__('Full Name')" />
                        <x-text-input id="delegates.{{$index}}.full_name" class="block mt-1 w-full" type="text" wire:model.live="delegates.{{$index}}.full_name" required />
                        <x-input-error :messages="$errors->get('delegates.'.$index.'.full_name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="delegates.{{$index}}.email" :value="__('Email')" />
                        <x-text-input id="delegates.{{$index}}.email" class="block mt-1 w-full" type="email" wire:model.live="delegates.{{$index}}.email" required />
                        <x-input-error :messages="$errors->get('delegates.'.$index.'.email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="delegates.{{$index}}.phone" :value="__('Phone')" />
                        <x-text-input id="delegates.{{$index}}.phone" class="block mt-1 w-full" type="text" wire:model.live="delegates.{{$index}}.phone" placeholder="e.g., +62 812-3456-7890" required />
                        <x-input-error :messages="$errors->get('delegates.'.$index.'.phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="delegates.{{$index}}.nationality" :value="__('Nationality')" />
                        <x-text-input id="delegates.{{$index}}.nationality" class="block mt-1 w-full" type="text" wire:model.live="delegates.{{$index}}.nationality" required />
                        <x-input-error :messages="$errors->get('delegates.'.$index.'.nationality')" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <x-input-label for="delegates.{{$index}}.mun_experience" :value="__('MUN Experience (Format: MUN@_Board_Council)')" />
                        <x-text-input id="delegates.{{$index}}.mun_experience" class="block mt-1 w-full" type="text" wire:model.live="delegates.{{$index}}.mun_experience" />
                        <x-input-error :messages="$errors->get('delegates.'.$index.'.mun_experience')" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <x-input-label for="delegates.{{$index}}.social_media_upload" :value="__('Social Media Upload (Click ')" />
                        <a href="#" target="_blank" class="text-blue-600 hover:underline">to see the petition template</a>
                        <div wire>
                            <label for="delegates.{{$index}}.social_media_upload" class="flex items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600" x-text="document.getElementById('delegates.{{$index}}.social_media_upload')?.files[0]?.name || 'Upload a proof of social media post/share'"></p>
                                    <p class="text-xs text-gray-500">Please upload your file. Max size 2 MB.</p>
                                </div>
                                {{-- wire:model untuk upload file --}}
                                <input id="delegates.{{$index}}.social_media_upload" name="delegates[{{$index}}][social_media_upload]" type="file" class="hidden" wire:model="delegates.{{$index}}.social_media_upload" accept=".jpg,.jpeg,.png,.pdf" />
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('delegates.'.$index.'.social_media_upload')" class="mt-2" />
                    </div>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mt-8 mb-4">Council Preferences</h3>
                {{-- Council Preference 1 --}}
                <div class="border border-gray-300 p-6 rounded-lg mb-6 bg-gray-50">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="delegates.{{$index}}.council_preference_1" :value="__('Council Preference')" />
                            <select id="delegates.{{$index}}.council_preference_1" wire:model.live="delegates.{{$index}}.council_preference_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Council</option>
                                <option value="UNSC">UNSC</option>
                                <option value="UNHRC">UNHRC</option>
                                <option value="WHO">WHO</option>
                                <option value="ECOSOC">ECOSOC</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.council_preference_1')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="delegates.{{$index}}.country_preference_1_1" :value="__('Country Preference 1')" />
                            <select id="delegates.{{$index}}.country_preference_1_1" wire:model.live="delegates.{{$index}}.country_preference_1_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Country</option>
                                <option value="USA">USA</option>
                                <option value="China">China</option>
                                <option value="Indonesia">Indonesia</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.country_preference_1_1')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="delegates.{{$index}}.country_preference_1_2" :value="__('Country Preference 2')" />
                            <select id="delegates.{{$index}}.country_preference_1_2" wire:model.live="delegates.{{$index}}.country_preference_1_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Country</option>
                                <option value="Germany">Germany</option>
                                <option value="Japan">Japan</option>
                                <option value="Brazil">Brazil</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.country_preference_1_2')" class="mt-2" />
                        </div>
                        <div class="md:col-span-3">
                            <x-input-label for="delegates.{{$index}}.reason_for_first_country_preference_1" :value="__('Reason for First Country Preference')" />
                            <textarea id="delegates.{{$index}}.reason_for_first_country_preference_1" wire:model.live="delegates.{{$index}}.reason_for_first_country_preference_1" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.reason_for_first_country_preference_1')" class="mt-2" />
                        </div>
                        <div class="md:col-span-3">
                            <x-input-label for="delegates.{{$index}}.reason_for_second_country_preference_1" :value="__('Reason for Second Country Preference')" />
                            <textarea id="delegates.{{$index}}.reason_for_second_country_preference_1" wire:model.live="delegates.{{$index}}.reason_for_second_country_preference_1" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.reason_for_second_country_preference_1')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Council Preference 2 --}}
                <div class="border border-gray-300 p-6 rounded-lg mb-6 bg-gray-50">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="delegates.{{$index}}.council_preference_2" :value="__('Council Preference')" />
                            <select id="delegates.{{$index}}.council_preference_2" wire:model.live="delegates.{{$index}}.council_preference_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Council</option>
                                <option value="UNSC">UNSC</option>
                                <option value="UNHRC">UNHRC</option>
                                <option value="WHO">WHO</option>
                                <option value="ECOSOC">ECOSOC</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.council_preference_2')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="delegates.{{$index}}.country_preference_2_1" :value="__('Country Preference 1')" />
                            <select id="delegates.{{$index}}.country_preference_2_1" wire:model.live="delegates.{{$index}}.country_preference_2_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Country</option>
                                <option value="USA">USA</option>
                                <option value="China">China</option>
                                <option value="Indonesia">Indonesia</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.country_preference_2_1')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="delegates.{{$index}}.country_preference_2_2" :value="__('Country Preference 2')" />
                            <select id="delegates.{{$index}}.country_preference_2_2" wire:model.live="delegates.{{$index}}.country_preference_2_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Country</option>
                                <option value="Germany">Germany</option>
                                <option value="Japan">Japan</option>
                                <option value="Brazil">Brazil</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.country_preference_2_2')" class="mt-2" />
                        </div>
                        <div class="md:col-span-3">
                            <x-input-label for="delegates.{{$index}}.reason_for_first_country_preference_2" :value="__('Reason for First Country Preference')" />
                            <textarea id="delegates.{{$index}}.reason_for_first_country_preference_2" wire:model.live="delegates.{{$index}}.reason_for_first_country_preference_2" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.reason_for_first_country_preference_2')" class="mt-2" />
                        </div>
                        <div class="md:col-span-3">
                            <x-input-label for="delegates.{{$index}}.reason_for_second_country_preference_2" :value="__('Reason for Second Country Preference')" />
                            <textarea id="delegates.{{$index}}.reason_for_second_country_preference_2" wire:model.live="delegates.{{$index}}.reason_for_second_country_preference_2" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.reason_for_second_country_preference_2')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Council Preference 3 --}}
                <div class="border border-gray-300 p-6 rounded-lg mb-6 bg-gray-50">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="delegates.{{$index}}.council_preference_3" :value="__('Council Preference')" />
                            <select id="delegates.{{$index}}.council_preference_3" wire:model.live="delegates.{{$index}}.council_preference_3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Council</option>
                                <option value="UNSC">UNSC</option>
                                <option value="UNHRC">UNHRC</option>
                                <option value="WHO">WHO</option>
                                <option value="ECOSOC">ECOSOC</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.council_preference_3')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="delegates.{{$index}}.country_preference_3_1" :value="__('Country Preference 1')" />
                            <select id="delegates.{{$index}}.country_preference_3_1" wire:model.live="delegates.{{$index}}.country_preference_3_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Country</option>
                                <option value="USA">USA</option>
                                <option value="China">China</option>
                                <option value="Indonesia">Indonesia</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.country_preference_3_1')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="delegates.{{$index}}.country_preference_3_2" :value="__('Country Preference 2')" />
                            <select id="delegates.{{$index}}.country_preference_3_2" wire:model.live="delegates.{{$index}}.country_preference_3_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Country</option>
                                <option value="Germany">Germany</option>
                                <option value="Japan">Japan</option>
                                <option value="Brazil">Brazil</option>
                            </select>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.country_preference_3_2')" class="mt-2" />
                        </div>
                        <div class="md:col-span-3">
                            <x-input-label for="delegates.{{$index}}.reason_for_first_country_preference_3" :value="__('Reason for First Country Preference')" />
                            <textarea id="delegates.{{$index}}.reason_for_first_country_preference_3" wire:model.live="delegates.{{$index}}.reason_for_first_country_preference_3" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.reason_for_first_country_preference_3')" class="mt-2" />
                        </div>
                        <div class="md:col-span-3">
                            <x-input-label for="delegates.{{$index}}.reason_for_second_country_preference_3" :value="__('Reason for Second Country Preference')" />
                            <textarea id="delegates.{{$index}}.reason_for_second_country_preference_3" wire:model.live="delegates.{{$index}}.reason_for_second_country_preference_3" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-input-error :messages="$errors->get('delegates.'.$index.'.reason_for_second_country_preference_3')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Add/Remove Delegate Buttons --}}
            <div class="flex space-x-4 mt-6">
                <button type="button" wire:click="addEmptyDelegate()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Add Delegate
                </button>
                <button type="button" wire:click="removeDelegate({{ count($delegates) - 1 }})" @if(count($delegates) <= 4) disabled @endif class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50">
                    - Remove Delegate
                </button>
            </div>
            <x-input-error :messages="$errors->get('delegates')" class="mt-2" />
            @if($errors->has('delegates.*'))
                <p class="text-red-500 text-xs italic mt-2">Please ensure all required fields for each delegate are filled correctly.</p>
            @endif
        </div>

        {{-- Section: Payment & Social Media Proof (for the overall delegation) --}}
        <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment Proof</h2>

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
            <div wire>
    {{-- MODIFIED: Blok Payment Proof Upload yang sudah diperbaiki --}}
            <div class="mb-6">
                <x-input-label for="payment_proof" :value="__('Payment Proof Upload')" />
                {{-- Menggunakan loading state dari Livewire --}}
                <div wire:loading wire:target="payment_proof" class="text-sm text-gray-600">Uploading...</div>

                <label for="payment_proof" class="flex items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        @if ($payment_proof)
                            <p class="mt-1 text-sm text-green-600">File selected: {{ $payment_proof->getClientOriginalName() }}</p>
                        @else
                            <p class="mt-1 text-sm text-gray-600">Upload a proof of payment (e.g., transfer receipt)</p>
                            <p class="text-xs text-gray-500">Max size 2 MB.</p>
                        @endif
                    </div>
                    <input id="payment_proof" type="file" class="hidden" wire:model="payment_proof" accept=".jpg,.jpeg,.png,.pdf" />
                </label>
                <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
            </div>

            {{-- MODIFIED: Input untuk Social Media Proof Utama Dihapus karena tidak ada di form --}}

            {{-- Referral Code --}}
            <div class="mb-6">
                <x-input-label for="referral_code" :value="__('Referral Code (Optional)')" />
                <x-text-input id="referral_code" class="block mt-1 w-full" type="text" wire:model.live="referral_code" placeholder="Enter your Referral Code Here" />
                <x-input-error :messages="$errors->get('referral_code')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- Menambahkan loading state pada tombol submit --}}
            <x-primary-button type="submit" class="ml-4" wire:loading.attr="disabled" wire:target="submitForm">
                <span wire:loading.remove wire:target="submitForm">
                    Submit Delegation Registration
                </span>
                <span wire:loading wire:target="submitForm">
                    Processing...
                </span>
            </x-primary-button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        // This script is for file input visual updates.
        // Livewire's wire:model will handle the actual file binding.
        // We listen for changes on specific file inputs.
        function setupFileInputDisplay(inputId, displayId) {
            const fileInput = document.getElementById(inputId);
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    const filenameDisplay = document.getElementById(displayId);
                    if (this.files && this.files.length > 0) {
                        filenameDisplay.textContent = this.files[0].name;
                    } else {
                        filenameDisplay.textContent = filenameDisplay.dataset.defaultText || 'Please upload your file. Max size 2 MB.';
                    }
                });
                // Set default text for initial load
                const filenameDisplay = document.getElementById(displayId);
                if (filenameDisplay) {
                    filenameDisplay.dataset.defaultText = filenameDisplay.textContent;
                }
            }
        }

        // Setup for overall payment proof
        setupFileInputDisplay('payment_proof', 'payment_proof_filename_overall');

        // Setup for dynamic social media proofs (needs to be reactive to Livewire adding new inputs)
        // Livewire updates the DOM on each render, so old event listeners might break.
        // We can re-apply listeners after each Livewire update if necessary, or use Alpine.js inside wire:ignore.
        // For simplicity and avoiding constant re-attaching, we will rely on Livewire's wire:model for data.
        // The display update here is more tricky for dynamic elements without Alpine.js x-on or similar.
        // For now, the x-text on the <p> tag inside the label (in the Blade loop) handles this visually.
    });
</script>
@endpush
