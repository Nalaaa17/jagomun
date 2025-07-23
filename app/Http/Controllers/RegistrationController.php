<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DelegationRegistration;
use App\Models\Delegate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Events\NewRegistrationCreated;
use App\MailServices\PHPMailerService;
use Maatwebsite\Excel\Facades\Excel; // <-- JANGAN LUPA IMPORT FACADE EXCEL
use App\Exports\RegistrationsExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ReferralCode;
use Carbon\Carbon; // <-- JANGAN LUPA IMPORT CLASS EXPORT ANDA

class RegistrationController extends Controller
{
    public function chooseType()
    {
        return view('registration.choose-type');
    }

    public function processType(Request $request)
    {
        $request->validate([
            'registration_type' => ['required', Rule::in(['Individual Delegate', 'Delegation', 'Observer'])],
        ]);

        if ($request->registration_type === 'Individual Delegate') {
            return redirect()->route('registration.chooseDelegateType', ['type' => 'Individual Delegate']);
        } elseif ($request->registration_type === 'Delegation') {
            return redirect()->route('registration.chooseDelegateType', ['type' => 'Delegation']);
        } elseif ($request->registration_type === 'Observer') {
            return redirect()->route('registration.chooseDelegateType', ['type' => 'Observer']);
        }

        return redirect()->back()->with('error', 'Tipe pendaftaran tidak valid.');
    }

    public function chooseDelegateType($type)
    {
        if (!in_array($type, ['Individual Delegate', 'Delegation', 'Observer'])) {
            abort(404, 'Invalid registration type.');
        }
        return view('registration.choose-delegate-type', compact('type'));
    }

    public function processDelegateType(Request $request)
    {
        $request->validate([
            'parent_type' => ['required', Rule::in(['Individual Delegate', 'Delegation', 'Observer'])],
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate', 'National Observer', 'International Observer'])],
        ]);

        if ($request->parent_type === 'Individual Delegate') {
            return redirect()->route('registration.individualForm', [
                'delegate_type' => $request->delegate_type
            ]);
        } elseif ($request->parent_type === 'Delegation') {
            return redirect()->route('registration.delegationForm', [
                'delegate_type' => $request->delegate_type
            ]);
        } elseif ($request->parent_type === 'Observer') {
            return redirect()->route('registration.observerForm', [
                'delegate_type' => $request->delegate_type
            ]);
        }

        return redirect()->back()->with('error', 'Tipe delegasi tidak valid.');
    }

    public function showIndividualForm(Request $request)
    {
        $delegateType = $request->query('delegate_type');
        if (!in_array($delegateType, ['National Delegate', 'International Delegate'])) {
            abort(404, 'Invalid delegate type for individual registration.');
        }
        return view('registration.individual-form', compact('delegateType'));
    }

    // =======================================================
    // FUNGSI YANG HILANG DITAMBAHKAN DI SINI
    // =======================================================
    public function showDelegationForm(Request $request)
    {
        $delegateType = $request->query('delegate_type', 'National Delegate');

        // Menyiapkan data awal untuk 2 delegasi.
        $delegates = old('delegates', [
            [
                'full_name' => '',
                'email' => '',
                'phone' => '',
                'nationality' => '',
                'package_type' => 'Full Accommodation',
                'needs_accommodation' => true,
                'council_preference_1' => '',
                'country_preference_1_1' => '',
                'country_preference_1_2' => '',
                'reason_for_first_country_preference_1' => '',
                'reason_for_second_country_preference_1' => '',
                'council_preference_2' => '',
                'country_preference_2_1' => '',
                'country_preference_2_2' => '',
                'reason_for_first_country_preference_2' => '',
                'reason_for_second_country_preference_2' => ''
            ],
            [
                'full_name' => '',
                'email' => '',
                'phone' => '',
                'nationality' => '',
                'package_type' => 'Full Accommodation',
                'needs_accommodation' => true,
                'council_preference_1' => '',
                'country_preference_1_1' => '',
                'country_preference_1_2' => '',
                'reason_for_first_country_preference_1' => '',
                'reason_for_second_country_preference_1' => '',
                'council_preference_2' => '',
                'country_preference_2_1' => '',
                'country_preference_2_2' => '',
                'reason_for_first_country_preference_2' => '',
                'reason_for_second_country_preference_2' => ''
            ],
        ]);

        return view('registration.delegation-form', compact('delegateType', 'delegates'));
    }

    public function observerForm(Request $request)
    {
        $delegateType = $request->query('delegate_type');
        if (!in_array($delegateType, ['National Observer', 'International Observer'])) {
            abort(404, 'Invalid delegate type for observer registration.');
        }
        return view('registration.observer-form', compact('delegateType'));
    }

    public function submitIndividualForm(Request $request)
    {
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate'])],
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:1',
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'email' => 'required|email|max:255|unique:delegation_registrations,email',
            'phone' => 'required|string|max:25',
            'nationality' => 'required|string|max:100',
            'institution_name' => 'required|string|max:255',
            'full_address' => 'required|string',
            'attendance_type' => ['required', Rule::in(['Online', 'Offline'])],
            'previous_mun_experience' => 'nullable|string',
            'mun_awards' => 'nullable|string',
            'student_id' => 'required|file|mimes:pdf|max:2048',
            'parental_consent' => 'nullable|file|mimes:pdf|max:2048',
            'partnership_code' => 'nullable|string|max:100', // Diubah jadi nullable
            'council_preference_1' => 'required|string|max:255',
            'country_preference_1_1' => 'required|string|max:255',
            'country_preference_1_2' => 'required|string|max:255',
            'reason_for_council_preference_1' => 'required|string',
            'council_preference_2' => 'required|string|max:255',
            'country_preference_2_1' => 'required|string|max:255',
            'country_preference_2_2' => 'required|string|max:255',
            'reason_for_council_preference_2' => 'required|string',
            'package_type' => 'required|string|max:255',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'info_confirmation' => 'required|accepted',
            'data_usage_agreement' => 'required|accepted',
        ]);

        $packageType = $validatedData['package_type'];
        $packagePrices = [
            'Full Accommodation' => 1145000,
            'Non-Accommodation' => 505000,
            'Online' => 95000
        ];
        $price = $packagePrices[$packageType] ?? 0;

        // Logika diskon dari database
        $referralCodeInput = $request->input('partnership_code');
        if ($referralCodeInput) {
            $foundCode = ReferralCode::where('code', $referralCodeInput)
                ->where('is_active', true)
                ->where(fn($query) => $query->whereNull('expires_at')->orWhere('expires_at', '>', now()))
                ->first();
            if ($foundCode) {
                $price -= $foundCode->discount_amount;
            }
        }

        $price = max(0, $price); // Pastikan harga tidak minus

        $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
        $socialMediaProofPath = $request->file('social_media_proof')->store('proofs/social_media', 'public');
        $studentIdPath = $request->file('student_id')->store('documents/student_ids', 'public');
        $parentalConsentPath = $request->hasFile('parental_consent') ? $request->file('parental_consent')->store('documents/parental_consents', 'public') : null;

        $registration = DelegationRegistration::create([
            'registering_as' => 'Individual Delegate',
            'total_price' => $price,
            'partnership_code' => $validatedData['partnership_code'],
            'delegate_type' => $validatedData['delegate_type'],
            'full_name' => $validatedData['full_name'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'nationality' => $validatedData['nationality'],
            'institution_name' => $validatedData['institution_name'],
            'full_address' => $validatedData['full_address'],
            'attendance_type' => $validatedData['attendance_type'],
            'package_type' => $packageType,
            'previous_mun_experience' => $validatedData['previous_mun_experience'],
            'mun_awards' => $validatedData['mun_awards'],
            'council_preference_1' => $validatedData['council_preference_1'],
            'country_preference_1_1' => $validatedData['country_preference_1_1'],
            'country_preference_1_2' => $validatedData['country_preference_1_2'],
            'reason_for_council_preference_1' => $validatedData['reason_for_council_preference_1'],
            'council_preference_2' => $validatedData['council_preference_2'],
            'country_preference_2_1' => $validatedData['country_preference_2_1'],
            'country_preference_2_2' => $validatedData['country_preference_2_2'],
            'reason_for_council_preference_2' => $validatedData['reason_for_council_preference_2'],
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
            'student_id_path' => $studentIdPath,
            'parental_consent_path' => $parentalConsentPath,
            'info_confirmation' => $request->boolean('info_confirmation'),
            'data_usage_agreement' => $request->boolean('data_usage_agreement'),
        ]);

        NewRegistrationCreated::dispatch();
        return redirect()->route('registration.success')->with('success', 'Individual registration successful!');
    }

    public function submitObserverForm(Request $request)
    {
        // ======================================================================
        // === AWAL PERBAIKAN: Menambahkan semua field yang hilang ke validasi ===
        // ======================================================================
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Observer', 'International Observer'])],
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:1',
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'email' => 'required|email|unique:delegation_registrations,email',
            'phone' => 'required|string|max:25',
            'nationality' => 'required|string|max:100',
            'institution_name' => 'required|string|max:255', // Menggunakan institution_name
            'full_address' => 'required|string',
            'attendance_type' => ['required', Rule::in(['Online', 'Offline'])],
            'package_type' => ['required', Rule::in(['Non-Accommodation', 'Online'])],
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'info_confirmation' => 'required|accepted',
            'data_usage_agreement' => 'required|accepted',
            'total_price' => 'required|numeric', // Validasi total_price
            'council_preference_1' => 'required|string|max:255',
        ]);
        // ======================================================================
        // === AKHIR PERBAIKAN ===
        // ======================================================================

        DB::beginTransaction();
        try {
            $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
            $socialMediaProofPath = $request->hasFile('social_media_proof') ? $request->file('social_media_proof')->store('proofs/social_media', 'public') : null;

            // ======================================================================
            // === AWAL PERBAIKAN: Menambahkan semua field yang hilang ke database ===
            // ======================================================================
            DelegationRegistration::create([
                'registering_as' => 'Observer',
                'delegate_type' => $validatedData['delegate_type'],
                'full_name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'nationality' => $validatedData['nationality'],
                'institution_name' => $validatedData['institution_name'],
                'attendance_type' => $validatedData['attendance_type'],
                'package_type' => $validatedData['package_type'],
                'total_price' => $validatedData['total_price'], // Mengambil dari data tervalidasi
                'payment_proof_path' => $paymentProofPath,
                'social_media_proof_path' => $socialMediaProofPath,
                'date_of_birth' => $validatedData['date_of_birth'],
                'age' => $validatedData['age'],
                'gender' => $validatedData['gender'],
                'full_address' => $validatedData['full_address'],
                'info_confirmation' => $request->boolean('info_confirmation'),
                'data_usage_agreement' => $request->boolean('data_usage_agreement'),
                'is_verified' => false,
                'council_preference_1' => $validatedData['council_preference_1'],
            ]);
            // ======================================================================
            // === AKHIR PERBAIKAN ===
            // ======================================================================

            DB::commit();

            NewRegistrationCreated::dispatch();

            // Logika pengiriman email (jika ada)
            // ...

            return redirect()->route('registration.success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Observer Registration Failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pendaftaran. Silakan coba lagi.')->withInput();
        }
    }

    // =======================================================
    // FUNGSI submitDelegationForm YANG DUPLIKAT DIHAPUS
    // HANYA MENYISAKAN VERSI YANG BENAR INI
    // =======================================================
    public function submitDelegationForm(Request $request)
    {
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate'])],
            'institution_name' => 'required|string|max:255',
            'package_type' => ['required', Rule::in(['Full Accommodation', 'Non-Accommodation', 'Online'])],
            'delegate_count' => 'required|integer|min:2|max:5',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'delegates' => 'required|array',
            'delegates.*.full_name' => 'required|string|max:255',
            'delegates.*.date_of_birth' => 'required|date',
            'delegates.*.age' => 'required|integer|min:1',
            'delegates.*.gender' => ['required', Rule::in(['Male', 'Female'])],
            'delegates.*.nationality' => 'required|string|max:100',
            'delegates.*.full_address' => 'required|string',
            'delegates.*.phone' => 'required|string|max:25',
            'delegates.*.email' => 'required|email|max:255',
            'delegates.*.student_id' => 'required|file|mimes:pdf|max:2048',
            'delegates.*.parental_consent' => 'nullable|file|mimes:pdf|max:2048',
            'delegates.*.previous_mun_experience' => 'nullable|string',
            'delegates.*.mun_awards' => 'nullable|string',
            'delegates.*.council_preference_1' => 'required|string|max:255',
            'delegates.*.reason_for_council_preference_1' => 'required|string',
            'delegates.*.country_preference_1_1' => 'required|string|max:255',
            'delegates.*.country_preference_1_2' => 'required|string|max:255',
            'delegates.*.council_preference_2' => 'required|string|max:255',
            'delegates.*.reason_for_council_preference_2' => 'required|string',
            'delegates.*.country_preference_2_1' => 'required|string|max:255',
            'delegates.*.country_preference_2_2' => 'required|string|max:255',
            'delegates.*.info_confirmation' => 'required|accepted',
            'delegates.*.data_usage_agreement' => 'required|accepted',
            'delegates.*.social_media_proof_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'referral_code' => 'nullable|string|max:255',
        ]);

        $pricing = [
            'Full Accommodation' => [2 => 2240000, 3 => 3360000, 4 => 4480000, 5 => 5600000],
            'Non-Accommodation' => [2 => 990000, 3 => 1485000, 4 => 1980000, 5 => 2475000],
            'Online' => [2 => 180000, 3 => 261000, 4 => 340000, 5 => 410000]
        ];
        $delegateCount = (int)$validatedData['delegate_count'];
        $packageType = $validatedData['package_type'];
        $price = $pricing[$packageType][$delegateCount] ?? 0;
        $attendanceType = ($packageType === 'Online') ? 'Online' : 'Offline';

        // ======================================================================
        // === AWAL PERBAIKAN: Mendefinisikan variabel $referralCode ===
        // ======================================================================
        $referralCode = null; // Definisikan variabel sebagai null di awal
        $referralCodeInput = $request->input('referral_code');

        if ($referralCodeInput) {
            $foundCode = ReferralCode::where('code', strtoupper($referralCodeInput))
                ->where('is_active', true)
                ->where(function ($query) {
                    $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
                })
                ->first();
            if ($foundCode) {
                $price -= $foundCode->discount_amount;
                $referralCode = $foundCode->code; // Isi variabel jika kode valid
            }
        }
        // ======================================================================
        // === AKHIR PERBAIKAN ===
        // ======================================================================

        $price = max(0, $price);

        DB::beginTransaction();
        try {
            $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
            $mainContact = $validatedData['delegates'][0];

            $delegationRegistration = DelegationRegistration::create([
                'registering_as' => 'Delegation',
                'delegate_type' => $validatedData['delegate_type'],
                'institution_name' => $validatedData['institution_name'],
                'delegate_count' => $delegateCount,
                'package_type' => $packageType,
                'total_price' => $price,
                'attendance_type' => $attendanceType,
                'full_name' => $mainContact['full_name'],
                'email' => $mainContact['email'],
                'phone' => $mainContact['phone'],
                'payment_proof_path' => $paymentProofPath,
                'is_verified' => false,
                // Simpan kode yang digunakan ke registrasi utama jika ada
                'partnership_code' => $referralCode,
            ]);

            foreach ($validatedData['delegates'] as $index => $delegateData) {
                $studentIdPath = $request->file("delegates.{$index}.student_id")->store("documents/delegates/student_ids", 'public');
                $parentalConsentPath = $request->hasFile("delegates.{$index}.parental_consent") ? $request->file("delegates.{$index}.parental_consent")->store("documents/delegates/parental_consents", 'public') : null;
                $socialMediaProofPath = $request->hasFile("delegates.{$index}.social_media_proof_path") ? $request->file("delegates.{$index}.social_media_proof_path")->store("proofs/delegates/social_media", 'public') : null;

                $delegationRegistration->delegates()->create([
                    'delegate_number' => $index + 1,
                    'full_name' => $delegateData['full_name'],
                    'email' => $delegateData['email'],
                    'phone' => $delegateData['phone'],
                    'date_of_birth' => $delegateData['date_of_birth'],
                    'age' => $delegateData['age'],
                    'gender' => $delegateData['gender'],
                    'nationality' => $delegateData['nationality'],
                    'full_address' => $delegateData['full_address'],
                    'package_type' => $packageType,
                    'attendance_type' => $attendanceType,
                    'previous_mun_experience' => $delegateData['previous_mun_experience'],
                    'mun_awards' => $delegateData['mun_awards'],
                    'council_preference_1' => $delegateData['council_preference_1'],
                    'country_preference_1_1' => $delegateData['country_preference_1_1'],
                    'country_preference_1_2' => $delegateData['country_preference_1_2'],
                    'reason_for_council_preference_1' => $delegateData['reason_for_council_preference_1'],
                    'council_preference_2' => $delegateData['council_preference_2'],
                    'country_preference_2_1' => $delegateData['country_preference_2_1'],
                    'country_preference_2_2' => $delegateData['country_preference_2_2'],
                    'reason_for_council_preference_2' => $delegateData['reason_for_council_preference_2'],
                    'student_id_path' => $studentIdPath,
                    'parental_consent_path' => $parentalConsentPath,
                    'social_media_proof_path' => $socialMediaProofPath,
                    'info_confirmation' => $request->boolean("delegates.{$index}.info_confirmation"),
                    'data_usage_agreement' => $request->boolean("delegates.{$index}.data_usage_agreement"),
                    // Simpan juga di setiap delegate jika perlu (opsional)
                    'partnership_code' => $referralCode,
                ]);
            }

            DB::commit();

            NewRegistrationCreated::dispatch();
            $mailer = new PHPMailerService();
            $mailer->sendMail(
                $delegationRegistration->email,
                'Konfirmasi Pendaftaran Delegasi JagoMUN',
                '<p>Halo Tim dari ' . $delegationRegistration->institution_name . ',</p><p>Terima kasih telah mendaftarkan delegasi Anda di JagoMUN. Kami akan segera memproses pendaftaran Anda.</p>'
            );

            return redirect()->route('registration.success')->with('success', 'Delegation registration successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delegation Registration Failed: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pendaftaran. Silakan coba lagi.')->withInput();
        }
    }

    public function success()
    {
        return view('registration.succes');
    }
    public function export()
    {
        // Panggil class Export Anda di sini
        return Excel::download(new RegistrationsExport, 'data-pendaftaran.xlsx');
    }
    public function checkReferral(Request $request)
    {
        // Validasi input
        $request->validate(['code' => 'required|string']);

        $code = strtoupper($request->input('code'));

        // Cari kode di database
        $referral = ReferralCode::where('code', $code)->first();

        // Kondisi 1: Kode tidak ditemukan
        if (!$referral) {
            return response()->json([
                'valid' => false,
                'message' => 'Referral code not found.'
            ]);
        }

        // Kondisi 2: Kode tidak aktif
        if (!$referral->is_active) {
            return response()->json([
                'valid' => false,
                'message' => 'This referral code is no longer active.'
            ]);
        }

        // Kondisi 3: Kode sudah kedaluwarsa
        if ($referral->expires_at && Carbon::now()->gt($referral->expires_at)) {
            return response()->json([
                'valid' => false,
                'message' => 'This referral code has expired.'
            ]);
        }

        // Jika semua kondisi valid, kirim respons sukses
        return response()->json([
            'valid' => true,
            'discount_amount' => $referral->discount_amount,
            'message' => 'Discount applied successfully!'
        ]);
    }
}
