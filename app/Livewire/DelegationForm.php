<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DelegationRegistration;
use App\Models\Delegate;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Events\NewRegistrationCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;

class DelegationForm extends Component
{
    use WithFileUploads;

    // Properti tidak berubah
    public $delegateType;
    public $institution_name;
    public $do_you_need_accommodation = false;
    public $payment_proof;
    public $referral_code;
    public $delegates = [];

    // Fungsi mount, addEmptyDelegate, dan removeDelegate tidak perlu diubah.
    // Kode di bawah ini sudah benar untuk memulai dengan 4 delegasi dan
    // mencegah penghapusan di bawah 4.
    public function mount($delegateType)
    {
        $this->delegateType = $delegateType;
        if (empty($this->delegates)) {
            for ($i = 0; $i < 4; $i++) {
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
            'social_media_upload' => null,
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
        if (count($this->delegates) > 4) {
            unset($this->delegates[$index]);
            $this->delegates = array_values($this->delegates);
        }
    }

    // --- MODIFIKASI UTAMA DI FUNGSI SUBMIT ---
    public function submitForm()
    {
        // 1. MODIFIKASI: Aturan validasi disesuaikan dengan form yang sebenarnya
        $rules = [
            'institution_name' => 'required|string|max:255',
            'do_you_need_accommodation' => 'boolean',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            // 'social_media_proof' dihapus karena inputnya tidak ada di form utama
            'referral_code' => 'nullable|string|max:50',

            // Aturan untuk delegasi tetap sama
            'delegates' => 'required|array|min:4',
            'delegates.*.full_name' => 'required|string|max:255',
            'delegates.*.email' => 'required|email|max:255',
            'delegates.*.phone' => 'required|string|max:20',
            'delegates.*.nationality' => 'required|string|max:100',
            'delegates.*.mun_experience' => 'nullable|string|max:255',
            'delegates.*.social_media_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            // ... aturan lain untuk council preferences tetap sama ...
        ];

        // Pesan validasi tetap sama
        $messages = [
            'delegates.min' => 'At least 4 delegates are required for a delegation.',
            'delegates.*.full_name.required' => 'The full name for delegate :position is required.',
            'delegates.*.email.required' => 'The email for delegate :position is required.',
            //...
        ];

        // Validasi data
        $this->validate($rules, $messages);

        // 2. MODIFIKASI: Logika penyimpanan disesuaikan
        // Proses file upload
        $paymentProofPath = $this->payment_proof->store('proofs/payment', 'public');

        // Buat registrasi utama
        $delegationRegistration = DelegationRegistration::create([
            'registering_as' => 'Delegation',
            'delegate_type' => $this->delegateType,
            'institution_name' => $this->institution_name,
            'delegate_count' => count($this->delegates), // Menyimpan jumlah delegasi
            'full_name' => $this->delegates[0]['full_name'], // Kontak utama
            'email' => $this->delegates[0]['email'], // Kontak utama
            'phone' => $this->delegates[0]['phone'], // Kontak utama
            'do_you_need_accommodation' => $this->do_you_need_accommodation,
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => null, // Dibuat null karena tidak ada di form utama
            'referral_code' => $this->referral_code,
        ]);

        // Simpan data setiap delegasi
        foreach ($this->delegates as $index => $delegateData) {
            $delegateSocialMediaProofPath = null;
            if (isset($delegateData['social_media_upload']) && is_object($delegateData['social_media_upload'])) {
                $delegateSocialMediaProofPath = $delegateData['social_media_upload']->store("proofs/social_media/delegates", 'public');
            }

            $delegationRegistration->delegates()->create([
    // Data yang sudah benar
    'delegate_number' => $index + 1,
    'full_name' => $delegateData['full_name'],
    'email' => $delegateData['email'],
    'phone' => $delegateData['phone'],
    'nationality' => $delegateData['nationality'],
    'mun_experience' => $delegateData['mun_experience'] ?? null,
    'social_media_upload' => $delegateSocialMediaProofPath,

    // --- TAMBAHKAN SEMUA DATA PREFERENSI DI SINI ---
    'council_preference_1' => $delegateData['council_preference_1'],
    'country_preference_1_1' => $delegateData['country_preference_1_1'],
    'country_preference_1_2' => $delegateData['country_preference_1_2'],
    'reason_for_first_country_preference_1' => $delegateData['reason_for_first_country_preference_1'],
    'reason_for_second_country_preference_1' => $delegateData['reason_for_second_country_preference_1'],

    'council_preference_2' => $delegateData['council_preference_2'],
    'country_preference_2_1' => $delegateData['country_preference_2_1'],
    'country_preference_2_2' => $delegateData['country_preference_2_2'],
    'reason_for_first_country_preference_2' => $delegateData['reason_for_first_country_preference_2'],
    'reason_for_second_country_preference_2' => $delegateData['reason_for_second_country_preference_2'],

    'council_preference_3' => $delegateData['council_preference_3'],
    'country_preference_3_1' => $delegateData['country_preference_3_1'],
    'country_preference_3_2' => $delegateData['country_preference_3_2'],
    'reason_for_first_country_preference_3' => $delegateData['reason_for_first_country_preference_3'],
    'reason_for_second_country_preference_3' => $delegateData['reason_for_second_country_preference_3'],
]);
        }



        NewRegistrationCreated::dispatch();

        return redirect()->route('registration.success')->with('success', 'Registrasi Delegasi Anda berhasil!');

    }


    public function render()
    {
        return view('livewire.delegation-form');
    }

    public function success()
    {
        return view('registration.succes');
    }
}
