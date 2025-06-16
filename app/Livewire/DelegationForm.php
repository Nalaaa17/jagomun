<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DelegationRegistration;
use App\Models\Delegate;
use Livewire\WithFileUploads; // If you need file uploads
use Illuminate\Validation\Rule; // Untuk validasi kondisional

class DelegationForm extends Component
{
    use WithFileUploads; // Enable file uploads

    // Overall delegation fields
    public $delegateType;
    public $institution_name;
    public $do_you_need_accommodation = false;
    public $payment_proof; // Temporary file
    public $social_media_proof; // Temporary file
    public $referral_code;

    // Dynamic delegates
    public $delegates = []; // Array of arrays for delegate data

    // Initialisation
    public function mount($delegateType)
    {
        $this->delegateType = $delegateType;
        // Start with minimum delegates, or load from old input if validation failed
        if (old('delegates')) {
            $this->delegates = old('delegates');
        } elseif (empty($this->delegates)) {
            for ($i = 0; $i < 4; $i++) { // For min. 4 delegates
                $this->addEmptyDelegate();
            }
        }
    }

    public function addEmptyDelegate()
    {
        $this->delegates[] = [
            'full_name' => '',
            'email' => '',
            'phone' => '',
            'nationality' => '',
            'mun_experience' => '',
            'social_media_upload' => null, // For delegate's social media proof
            'council_preference_1' => '',
            'country_preference_1_1' => '',
            'country_preference_1_2' => '',
            'reason_for_first_country_preference_1' => '',
            'reason_for_second_country_preference_1' => '',
            'council_preference_2' => '',
            'country_preference_2_1' => '',
            'country_preference_2_2' => '',
            'reason_for_first_country_preference_2' => '',
            'reason_for_second_country_preference_2' => '',
            'council_preference_3' => '',
            'country_preference_3_1' => '',
            'country_preference_3_2' => '',
            'reason_for_first_country_preference_3' => '',
            'reason_for_second_country_preference_3' => '',
        ];
    }

    public function removeDelegate($index)
    {
        if (count($this->delegates) > 4) { // Only allow removing if more than minimum (4)
            unset($this->delegates[$index]);
            $this->delegates = array_values($this->delegates); // Re-index array
        }
    }

    // You can add real-time validation here if needed
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName, [
    //         'institution_name' => 'required|string|max:255',
    //         // ... more rules for specific fields ...
    //     ]);
    // }

    public function submitForm()
    {
        // Validation for main registration
        $rules = [
            'institution_name' => 'required|string|max:255',
            'do_you_need_accommodation' => 'required|boolean',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'referral_code' => 'nullable|string|max:50',
            // Delegate validation rules
            'delegates' => 'array|min:4', // Ensure at least 4 delegates
            'delegates.*.full_name' => 'required|string|max:255',
            'delegates.*.email' => 'required|email|max:255', // Add unique rule if needed
            'delegates.*.phone' => 'required|string|max:20',
            'delegates.*.nationality' => 'required|string|max:100',
            'delegates.*.mun_experience' => 'nullable|string|max:255',
            'delegates.*.social_media_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'delegates.*.council_preference_1' => 'nullable|string|max:255',
            'delegates.*.country_preference_1_1' => 'nullable|string|max:255',
            'delegates.*.country_preference_1_2' => 'nullable|string|max:255',
            'delegates.*.reason_for_first_country_preference_1' => 'nullable|string',
            'delegates.*.reason_for_second_country_preference_1' => 'nullable|string',
            'delegates.*.council_preference_2' => 'nullable|string|max:255',
            'delegates.*.country_preference_2_1' => 'nullable|string|max:255',
            'delegates.*.country_preference_2_2' => 'nullable|string|max:255',
            'delegates.*.reason_for_first_country_preference_2' => 'nullable|string',
            'delegates.*.reason_for_second_country_preference_2' => 'nullable|string',
            'delegates.*.council_preference_3' => 'nullable|string|max:255',
            'delegates.*.country_preference_3_1' => 'nullable|string|max:255',
            'delegates.*.country_preference_3_2' => 'nullable|string|max:255',
            'delegates.*.reason_for_first_country_preference_3' => 'nullable|string',
            'delegates.*.reason_for_second_country_preference_3' => 'nullable|string',
        ];

        $messages = [
            'delegates.min' => 'At least 4 delegates are required for a delegation.',
            'delegates.*.full_name.required' => 'The full name for delegate :position is required.',
            'delegates.*.email.required' => 'The email for delegate :position is required.',
            'delegates.*.email.email' => 'The email for delegate :position must be a valid email address.',
            'delegates.*.phone.required' => 'The phone number for delegate :position is required.',
            'delegates.*.nationality.required' => 'The nationality for delegate :position is required.',
            'delegates.*.social_media_upload.mimes' => 'The social media proof for delegate :position must be a file of type: jpg, jpeg, png, pdf.',
            'delegates.*.social_media_upload.max' => 'The social media proof for delegate :position may not be greater than 2MB.',
        ];

        // Replace :position placeholder in messages
        foreach ($this->delegates as $index => $delegate) {
            foreach ($messages as $key => $message) {
                if (str_contains($key, 'delegates.*')) {
                    $newKey = str_replace('delegates.*', 'delegates.'.$index, $key);
                    $messages[$newKey] = str_replace(':position', ($index + 1), $message);
                }
            }
        }

        $this->validate($rules, $messages);

        // Process file uploads for main registration
        $paymentProofPath = $this->payment_proof->store('proofs/payment', 'public');
        $socialMediaProofPath = $this->social_media_proof->store('proofs/social_media', 'public');

        // Create main registration record
        $delegationRegistration = DelegationRegistration::create([
            'registering_as' => 'Delegation',
            'delegate_type' => $this->delegateType,
            'institution_name' => $this->institution_name,
            'do_you_need_accommodation' => $this->do_you_need_accommodation,
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
            'referral_code' => $this->referral_code,
        ]);

        // Create delegate records
        foreach ($this->delegates as $index => $delegateData) {
            $delegateSocialMediaProofPath = null;
            // Check if file object exists and is valid before storing
            if (isset($delegateData['social_media_upload']) && is_object($delegateData['social_media_upload']) && method_exists($delegateData['social_media_upload'], 'store')) {
                $delegateSocialMediaProofPath = $delegateData['social_media_upload']->store("proofs/social_media/delegates", 'public');
            }

            $delegationRegistration->delegates()->create([
                'delegate_number' => $index + 1,
                'full_name' => $delegateData['full_name'],
                'email' => $delegateData['email'],
                'phone' => $delegateData['phone'],
                'nationality' => $delegateData['nationality'],
                'mun_experience' => $delegateData['mun_experience'] ?? null,
                'social_media_upload' => $delegateSocialMediaProofPath,
                'council_preference_1' => $delegateData['council_preference_1'] ?? null,
                'country_preference_1_1' => $delegateData['country_preference_1_1'] ?? null,
                'country_preference_1_2' => $delegateData['country_preference_1_2'] ?? null,
                'reason_for_first_country_preference_1' => $delegateData['reason_for_first_country_preference_1'] ?? null,
                'reason_for_second_country_preference_1' => $delegateData['reason_for_second_country_preference_1'] ?? null,
                'council_preference_2' => $delegateData['council_preference_2'] ?? null,
                'country_preference_2_1' => $delegateData['country_preference_2_1'] ?? null,
                'country_preference_2_2' => $delegateData['country_preference_2_2'] ?? null,
                'reason_for_first_country_preference_2' => $delegateData['reason_for_first_country_preference_2'] ?? null,
                'reason_for_second_country_preference_2' => $delegateData['reason_for_second_country_preference_2'] ?? null,
                'council_preference_3' => $delegateData['council_preference_3'] ?? null,
                'country_preference_3_1' => $delegateData['country_preference_3_1'] ?? null,
                'country_preference_3_2' => $delegateData['country_preference_3_2'] ?? null,
                'reason_for_first_country_preference_3' => $delegateData['reason_for_first_country_preference_3'] ?? null,
                'reason_for_second_country_preference_3' => $delegateData['reason_for_second_country_preference_3'] ?? null,
            ]);
        }

        session()->flash('success', 'Registrasi Delegasi Anda berhasil!');
        return redirect()->route('registration.succes');
    }

    public function render()
    {
        return view('livewire.delegation-form');
    }
}
