@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8"
     x-data="{
        delegates: {{ json_encode(old('delegates', $delegates)) }},
        paymentSectionVisible: false,
        packagePrices: {
            'Full Accommodation': 1500000,
            'Non-Accommodation': 850000,
            'Online': 350000
        },
        addDelegate() {
            this.delegates.push({
                full_name: '', email: '', phone: '', nationality: '',
                package_type: 'Full Accommodation',
                needs_accommodation: true,
                council_preference_1: '', country_preference_1_1: '', country_preference_1_2: '', reason_for_first_country_preference_1: '', reason_for_second_country_preference_1: '',
                council_preference_2: '', country_preference_2_1: '', country_preference_2_2: '', reason_for_first_country_preference_2: '', reason_for_second_country_preference_2: ''
            });
        },
        removeDelegate(index) {
            if (this.delegates.length > 2) {
                this.delegates.splice(index, 1);
            }
        },
        updateAccommodation(index) {
            this.delegates[index].needs_accommodation = (this.delegates[index].package_type === 'Full Accommodation');
        },
        get totalPrice() {
            return this.delegates.reduce((total, delegate) => {
                return total + (this.packagePrices[delegate.package_type] || 0);
            }, 0);
        },
        formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }
     }">

    <div class="bg-white shadow-xl rounded-lg p-8" style="background-color: #D2B48C; border: 2px solid #A0522D;">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-600 text-white mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">I am Registering as Delegation ({{ $delegateType }})</h1>
            <p class="text-gray-700">Please fill out your institution details and delegate information below.</p>
        </div>

        <form method="POST" action="{{ route('registration.delegationSubmit') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="delegate_type" value="{{ $delegateType }}">

            <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Institution Detail</h2>
                <div>
                    <x-input-label for="institution_name" :value="__('Institution Name')" />
                    <x-text-input id="institution_name" class="block mt-1 w-full" type="text" name="institution_name" :value="old('institution_name')" required autofocus />
                    <x-input-error :messages="$errors->get('institution_name')" class="mt-2" />
                </div>
            </div>

            <template x-for="(delegate, index) in delegates" :key="index">
                <div class="border border-gray-300 p-6 rounded-lg mb-6 bg-orange-50 bg-opacity-20">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-700">Delegate <span x-text="index + 1"></span></h2>
                        <button type="button" @click="removeDelegate(index)" x-show="delegates.length > 2" class="text-sm font-medium text-red-600 hover:text-red-800 transition-colors">
                            Remove
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label :for="'delegate_name_'+index" class="block font-medium text-sm text-gray-700">Full Name</label>
                            <input type="text" :name="'delegates['+index+'][full_name]'" :id="'delegate_name_'+index" x-model="delegate.full_name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label :for="'delegate_email_'+index" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" :name="'delegates['+index+'][email]'" :id="'delegate_email_'+index" x-model="delegate.email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label :for="'delegate_phone_'+index" class="block font-medium text-sm text-gray-700">Phone</label>
                            <input type="text" :name="'delegates['+index+'][phone]'" :id="'delegate_phone_'+index" x-model="delegate.phone" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            {{-- =============================================== --}}
                            {{-- PERUBAHAN DI SINI: Label dinamis --}}
                            {{-- =============================================== --}}
                            <label :for="'delegate_nationality_'+index" class="block font-medium text-sm text-gray-700">
                                @if(Str::contains($delegateType, 'International'))
                                    Nationality
                                @else
                                    Domicile
                                @endif
                            </label>
                            <input type="text" :name="'delegates['+index+'][nationality]'" :id="'delegate_nationality_'+index" x-model="delegate.nationality" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Package Selection</h3>
                        <div class="space-y-2">
                            <label class="flex justify-between items-center cursor-pointer p-3 border rounded-md" :class="{'bg-blue-100 border-blue-400': delegate.package_type === 'Full Accommodation'}">
                                <div class="flex items-center">
                                    <input type="radio" :name="'delegates['+index+'][package_type]'" value="Full Accommodation" x-model="delegate.package_type" @change="updateAccommodation(index)" class="h-4 w-4 text-indigo-600">
                                    <span class="ml-3 text-sm font-medium text-gray-800">Full Accommodation</span>
                                </div>
                                <span class="text-sm font-semibold text-indigo-700" x-text="formatCurrency(packagePrices['Full Accommodation'])"></span>
                            </label>
                            <label class="flex justify-between items-center cursor-pointer p-3 border rounded-md" :class="{'bg-blue-100 border-blue-400': delegate.package_type === 'Non-Accommodation'}">
                                <div class="flex items-center">
                                    <input type="radio" :name="'delegates['+index+'][package_type]'" value="Non-Accommodation" x-model="delegate.package_type" @change="updateAccommodation(index)" class="h-4 w-4 text-indigo-600">
                                    <span class="ml-3 text-sm font-medium text-gray-800">Non-Accommodation</span>
                                </div>
                                <span class="text-sm font-semibold text-indigo-700" x-text="formatCurrency(packagePrices['Non-Accommodation'])"></span>
                            </label>
                            <label class="flex justify-between items-center cursor-pointer p-3 border rounded-md" :class="{'bg-blue-100 border-blue-400': delegate.package_type === 'Online'}">
                                <div class="flex items-center">
                                    <input type="radio" :name="'delegates['+index+'][package_type]'" value="Online" x-model="delegate.package_type" @change="updateAccommodation(index)" class="h-4 w-4 text-indigo-600">
                                    <span class="ml-3 text-sm font-medium text-gray-800">Online</span>
                                </div>
                                <span class="text-sm font-semibold text-indigo-700" x-text="formatCurrency(packagePrices['Online'])"></span>
                            </label>
                        </div>
                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" :name="'delegates['+index+'][needs_accommodation]'" value="1" x-model="delegate.needs_accommodation" class="rounded border-gray-300" readonly>
                                <span class="ml-2 text-sm text-gray-700">This delegate needs accommodation</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-8">
                         <label :for="'social_media_upload_'+index" class="block font-medium text-sm text-gray-700">Social Media Upload</label>
                         <input type="file" :name="'delegates['+index+'][social_media_upload]'" :id="'social_media_upload_'+index" class="block mt-1 w-full">
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Council Preferences</h3>
                        <div class="border-b border-gray-200 pb-6 mb-6">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Council Preference 1</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label :for="'council_preference_1_'+index" class="block font-medium text-sm text-gray-700">Council Preference</label>
                                    <select :name="'delegates['+index+'][council_preference_1]'" :id="'council_preference_1_'+index" x-model="delegate.council_preference_1" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Council</option><option value="UNSC">UNSC</option><option value="UNHRC">UNHRC</option><option value="WHO">WHO</option><option value="ECOSOC">ECOSOC</option>
                                    </select>
                                </div>
                                <div>
                                    <label :for="'country_preference_1_1_'+index" class="block font-medium text-sm text-gray-700">Country Preference 1</label>
                                    <select :name="'delegates['+index+'][country_preference_1_1]'" :id="'country_preference_1_1_'+index" x-model="delegate.country_preference_1_1" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Country</option><option value="USA">USA</option><option value="China">China</option><option value="Indonesia">Indonesia</option>
                                    </select>
                                </div>
                                <div>
                                    <label :for="'country_preference_1_2_'+index" class="block font-medium text-sm text-gray-700">Country Preference 2</label>
                                    <select :name="'delegates['+index+'][country_preference_1_2]'" :id="'country_preference_1_2_'+index" x-model="delegate.country_preference_1_2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Country</option><option value="Germany">Germany</option><option value="Japan">Japan</option><option value="Brazil">Brazil</option>
                                    </select>
                                </div>
                                <div class="md:col-span-3">
                                    <label :for="'reason_for_first_country_preference_1_'+index" class="block font-medium text-sm text-gray-700">Reason for First Country Preference</label>
                                    <textarea :name="'delegates['+index+'][reason_for_first_country_preference_1]'" :id="'reason_for_first_country_preference_1_'+index" x-model="delegate.reason_for_first_country_preference_1" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                                </div>
                                <div class="md:col-span-3">
                                    <label :for="'reason_for_second_country_preference_1_'+index" class="block font-medium text-sm text-gray-700">Reason for Second Country Preference</label>
                                    <textarea :name="'delegates['+index+'][reason_for_second_country_preference_1]'" :id="'reason_for_second_country_preference_1_'+index" x-model="delegate.reason_for_second_country_preference_1" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 pb-6 mb-6">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Council Preference 2</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label :for="'council_preference_2_'+index" class="block font-medium text-sm text-gray-700">Council Preference</label>
                                    <select :name="'delegates['+index+'][council_preference_2]'" :id="'council_preference_2_'+index" x-model="delegate.council_preference_2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Council</option><option value="UNSC">UNSC</option><option value="UNHRC">UNHRC</option><option value="WHO">WHO</option><option value="ECOSOC">ECOSOC</option>
                                    </select>
                                </div>
                                <div>
                                    <label :for="'country_preference_2_1_'+index" class="block font-medium text-sm text-gray-700">Country Preference 1</label>
                                    <select :name="'delegates['+index+'][country_preference_2_1]'" :id="'country_preference_2_1_'+index" x-model="delegate.country_preference_2_1" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Country</option><option value="USA">USA</option><option value="China">China</option><option value="Indonesia">Indonesia</option>
                                    </select>
                                </div>
                                <div>
                                    <label :for="'country_preference_2_2_'+index" class="block font-medium text-sm text-gray-700">Country Preference 2</label>
                                    <select :name="'delegates['+index+'][country_preference_2_2]'" :id="'country_preference_2_2_'+index" x-model="delegate.country_preference_2_2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Country</option><option value="Germany">Germany</option><option value="Japan">Japan</option><option value="Brazil">Brazil</option>
                                    </select>
                                </div>
                                <div class="md:col-span-3">
                                    <label :for="'reason_for_first_country_preference_2_'+index" class="block font-medium text-sm text-gray-700">Reason for First Country Preference</label>
                                    <textarea :name="'delegates['+index+'][reason_for_first_country_preference_2]'" :id="'reason_for_first_country_preference_2_'+index" x-model="delegate.reason_for_first_country_preference_2" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                                </div>
                                <div class="md:col-span-3">
                                    <label :for="'reason_for_second_country_preference_2_'+index" class="block font-medium text-sm text-gray-700">Reason for Second Country Preference</label>
                                    <textarea :name="'delegates['+index+'][reason_for_second_country_preference_2]'" :id="'reason_for_second_country_preference_2_'+index" x-model="delegate.reason_for_second_country_preference_2" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <div class="flex space-x-4 mt-6">
                <button type="button" @click="addDelegate()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors">+ Add Delegate</button>
            </div>

            <div class="flex items-center justify-end mt-8" x-show="!paymentSectionVisible">
                 <button type="button" @click.prevent="paymentSectionVisible = true" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Lanjutkan ke Pembayaran
                </button>
            </div>

            <div x-show="paymentSectionVisible" x-transition class="mt-8">
                <div class="border border-gray-300 p-6 rounded-lg mb-8 bg-orange-50 bg-opacity-20">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment</h2>
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded-md mb-8" role="alert">
                        <p class="font-bold">Total yang harus dibayar (<span x-text="delegates.length"></span> Delegasi):</p>
                        <p class="text-3xl font-extrabold" x-text="formatCurrency(totalPrice)"></p>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-2">
                            Please refer to Indonesia MUN Official Instagram (@indonesiamun) for the prices. Transfer the registration payment to:
                            <br><strong>Rekening Bank:</strong> Mahisa Akib 747373067600 (CIMB Niaga)
                            <br><strong>PayPal:</strong> nanasiyah0@gmail.com (PayPal)
                        </p>
                    </div>
                    <div class="border border-gray-300 p-6 rounded-lg my-12 bg-orange-50 bg-opacity-20">
                        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment Proof</h2>
                        <div>
                           <x-input-label for="payment_proof">Payment Proof Upload</x-input-label>
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
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4" x-show="paymentSectionVisible">
                 <x-primary-button type="submit" class="ml-4">Submit Delegation Registration</x-primary-button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
@endsection
