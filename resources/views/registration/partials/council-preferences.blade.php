{{--
This partial is used to render council preference fields.
It accepts $delegateIndex (optional, for array naming in delegation form)
and $data (for old() values).
--}}
@php
    $prefix = isset($delegateIndex) && $delegateIndex !== '' ? 'delegates[' . $delegateIndex . '][' : '';
    $suffix = isset($delegateIndex) && $delegateIndex !== '' ? ']' : '';
    $oldValue = function($fieldName) use ($data, $prefix, $suffix) {
        $fullFieldName = $prefix . $fieldName . $suffix;
        if (isset($data[$fieldName])) {
            return $data[$fieldName];
        }
        return old($fullFieldName);
    };
@endphp

{{-- Council Preference 1 --}}
<div class="border border-gray-300 p-6 rounded-lg mb-6 bg-gray-50">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 1</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <x-input-label :for="$prefix . 'council_preference_1' . $suffix" :value="__('Council Preference')" />
            <select :id="$prefix . 'council_preference_1' . $suffix" :name="$prefix . 'council_preference_1' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Council</option>
                <option value="UNSC" {{ $oldValue('council_preference_1') == 'UNSC' ? 'selected' : '' }}>UNSC</option>
                <option value="UNHRC" {{ $oldValue('council_preference_1') == 'UNHRC' ? 'selected' : '' }}>UNHRC</option>
                <option value="WHO" {{ $oldValue('council_preference_1') == 'WHO' ? 'selected' : '' }}>WHO</option>
                <option value="ECOSOC" {{ $oldValue('council_preference_1') == 'ECOSOC' ? 'selected' : '' }}>ECOSOC</option>
                {{-- Tambahkan lebih banyak opsi council --}}
            </select>
            <x-input-error :messages="$errors->get($prefix . 'council_preference_1' . $suffix)" class="mt-2" />
        </div>
        <div>
            <x-input-label :for="$prefix . 'country_preference_1_1' . $suffix" :value="__('Country Preference 1')" />
            <select :id="$prefix . 'country_preference_1_1' . $suffix" :name="$prefix . 'country_preference_1_1' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Country</option>
                <option value="USA" {{ $oldValue('country_preference_1_1') == 'USA' ? 'selected' : '' }}>USA</option>
                <option value="China" {{ $oldValue('country_preference_1_1') == 'China' ? 'selected' : '' }}>China</option>
                <option value="Indonesia" {{ $oldValue('country_preference_1_1') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                {{-- Tambahkan lebih banyak opsi negara --}}
            </select>
            <x-input-error :messages="$errors->get($prefix . 'country_preference_1_1' . $suffix)" class="mt-2" />
        </div>
        <div>
            <x-input-label :for="$prefix . 'country_preference_1_2' . $suffix" :value="__('Country Preference 2')" />
            <select :id="$prefix . 'country_preference_1_2' . $suffix" :name="$prefix . 'country_preference_1_2' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Country</option>
                <option value="Germany" {{ $oldValue('country_preference_1_2') == 'Germany' ? 'selected' : '' }}>Germany</option>
                <option value="Japan" {{ $oldValue('country_preference_1_2') == 'Japan' ? 'selected' : '' }}>Japan</option>
                <option value="Brazil" {{ $oldValue('country_preference_1_2') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'country_preference_1_2' . $suffix)" class="mt-2" />
        </div>
        <div class="md:col-span-3">
            <x-input-label :for="$prefix . 'reason_for_first_country_preference_1' . $suffix" :value="__('Reason for First Country Preference')" />
            <textarea :id="$prefix . 'reason_for_first_country_preference_1' . $suffix" :name="$prefix . 'reason_for_first_country_preference_1' . $suffix" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $oldValue('reason_for_first_country_preference_1') }}</textarea>
            <x-input-error :messages="$errors->get($prefix . 'reason_for_first_country_preference_1' . $suffix)" class="mt-2" />
        </div>
        <div class="md:col-span-3">
            <x-input-label :for="$prefix . 'reason_for_second_country_preference_1' . $suffix" :value="__('Reason for Second Country Preference')" />
            <textarea :id="$prefix . 'reason_for_second_country_preference_1' . $suffix" :name="$prefix . 'reason_for_second_country_preference_1' . $suffix" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $oldValue('reason_for_second_country_preference_1') }}</textarea>
            <x-input-error :messages="$errors->get($prefix . 'reason_for_second_country_preference_1' . $suffix)" class="mt-2" />
        </div>
    </div>
</div>

{{-- Council Preference 2 --}}
<div class="border border-gray-300 p-6 rounded-lg mb-6 bg-gray-50">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 2</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <x-input-label :for="$prefix . 'council_preference_2' . $suffix" :value="__('Council Preference')" />
            <select :id="$prefix . 'council_preference_2' . $suffix" :name="$prefix . 'council_preference_2' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Council</option>
                <option value="UNSC" {{ $oldValue('council_preference_2') == 'UNSC' ? 'selected' : '' }}>UNSC</option>
                <option value="UNHRC" {{ $oldValue('council_preference_2') == 'UNHRC' ? 'selected' : '' }}>UNHRC</option>
                <option value="WHO" {{ $oldValue('council_preference_2') == 'WHO' ? 'selected' : '' }}>WHO</option>
                <option value="ECOSOC" {{ $oldValue('council_preference_2') == 'ECOSOC' ? 'selected' : '' }}>ECOSOC</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'council_preference_2' . $suffix)" class="mt-2" />
        </div>
        <div>
            <x-input-label :for="$prefix . 'country_preference_2_1' . $suffix" :value="__('Country Preference 1')" />
            <select :id="$prefix . 'country_preference_2_1' . $suffix" :name="$prefix . 'country_preference_2_1' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Country</option>
                <option value="USA" {{ $oldValue('country_preference_2_1') == 'USA' ? 'selected' : '' }}>USA</option>
                <option value="China" {{ $oldValue('country_preference_2_1') == 'China' ? 'selected' : '' }}>China</option>
                <option value="Indonesia" {{ $oldValue('country_preference_2_1') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'country_preference_2_1' . $suffix)" class="mt-2" />
        </div>
        <div>
            <x-input-label :for="$prefix . 'country_preference_2_2' . $suffix" :value="__('Country Preference 2')" />
            <select :id="$prefix . 'country_preference_2_2' . $suffix" :name="$prefix . 'country_preference_2_2' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Country</option>
                <option value="Germany" {{ $oldValue('country_preference_2_2') == 'Germany' ? 'selected' : '' }}>Germany</option>
                <option value="Japan" {{ $oldValue('country_preference_2_2') == 'Japan' ? 'selected' : '' }}>Japan</option>
                <option value="Brazil" {{ $oldValue('country_preference_2_2') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'country_preference_2_2' . $suffix)" class="mt-2" />
        </div>
        <div class="md:col-span-3">
            <x-input-label :for="$prefix . 'reason_for_first_country_preference_2' . $suffix" :value="__('Reason for First Country Preference')" />
            <textarea :id="$prefix . 'reason_for_first_country_preference_2' . $suffix" :name="$prefix . 'reason_for_first_country_preference_2' . $suffix" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $oldValue('reason_for_first_country_preference_2') }}</textarea>
            <x-input-error :messages="$errors->get($prefix . 'reason_for_first_country_preference_2' . $suffix)" class="mt-2" />
        </div>
        <div class="md:col-span-3">
            <x-input-label :for="$prefix . 'reason_for_second_country_preference_2' . $suffix" :value="__('Reason for Second Country Preference')" />
            <textarea :id="$prefix . 'reason_for_second_country_preference_2' . $suffix" :name="$prefix . 'reason_for_second_country_preference_2' . $suffix" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $oldValue('reason_for_second_country_preference_2') }}</textarea>
            <x-input-error :messages="$errors->get($prefix . 'reason_for_second_country_preference_2' . $suffix)" class="mt-2" />
        </div>
    </div>
</div>

{{-- Council Preference 3 --}}
<div class="border border-gray-300 p-6 rounded-lg mb-6 bg-gray-50">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preference 3</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <x-input-label :for="$prefix . 'council_preference_3' . $suffix" :value="__('Council Preference')" />
            <select :id="$prefix . 'council_preference_3' . $suffix" :name="$prefix . 'council_preference_3' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Council</option>
                <option value="UNSC" {{ $oldValue('council_preference_3') == 'UNSC' ? 'selected' : '' }}>UNSC</option>
                <option value="UNHRC" {{ $oldValue('council_preference_3') == 'UNHRC' ? 'selected' : '' }}>UNHRC</option>
                <option value="WHO" {{ $oldValue('council_preference_3') == 'WHO' ? 'selected' : '' }}>WHO</option>
                <option value="ECOSOC" {{ $oldValue('council_preference_3') == 'ECOSOC' ? 'selected' : '' }}>ECOSOC</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'council_preference_3' . $suffix)" class="mt-2" />
        </div>
        <div>
            <x-input-label :for="$prefix . 'country_preference_3_1' . $suffix" :value="__('Country Preference 1')" />
            <select :id="$prefix . 'country_preference_3_1' . $suffix" :name="$prefix . 'country_preference_3_1' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Country</option>
                <option value="USA" {{ $oldValue('country_preference_3_1') == 'USA' ? 'selected' : '' }}>USA</option>
                <option value="China" {{ $oldValue('country_preference_3_1') == 'China' ? 'selected' : '' }}>China</option>
                <option value="Indonesia" {{ $oldValue('country_preference_3_1') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'country_preference_3_1' . $suffix)" class="mt-2" />
        </div>
        <div>
            <x-input-label :for="$prefix . 'country_preference_3_2' . $suffix" :value="__('Country Preference 2')" />
            <select :id="$prefix . 'country_preference_3_2' . $suffix" :name="$prefix . 'country_preference_3_2' . $suffix" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="">Select Country</option>
                <option value="Germany" {{ $oldValue('country_preference_3_2') == 'Germany' ? 'selected' : '' }}>Germany</option>
                <option value="Japan" {{ $oldValue('country_preference_3_2') == 'Japan' ? 'selected' : '' }}>Japan</option>
                <option value="Brazil" {{ $oldValue('country_preference_3_2') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
            </select>
            <x-input-error :messages="$errors->get($prefix . 'country_preference_3_2' . $suffix)" class="mt-2" />
        </div>
        <div class="md:col-span-3">
            <x-input-label :for="$prefix . 'reason_for_first_country_preference_3' . $suffix" :value="__('Reason for First Country Preference')" />
            <textarea :id="$prefix . 'reason_for_first_country_preference_3' . $suffix" :name="$prefix . 'reason_for_first_country_preference_3' . $suffix" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $oldValue('reason_for_first_country_preference_3') }}</textarea>
            <x-input-error :messages="$errors->get($prefix . 'reason_for_first_country_preference_3' . $suffix)" class="mt-2" />
        </div>
        <div class="md:col-span-3">
            <x-input-label :for="$prefix . 'reason_for_second_country_preference_3' . $suffix" :value="__('Reason for Second Country Preference')" />
            <textarea :id="$prefix . 'reason_for_second_country_preference_3' . $suffix" :name="$prefix . 'reason_for_second_country_preference_3' . $suffix" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $oldValue('reason_for_second_country_preference_3') }}</textarea>
            <x-input-error :messages="$errors->get($prefix . 'reason_for_second_country_preference_3' . $suffix)" class="mt-2" />
        </div>
    </div>
</div>
