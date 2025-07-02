<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DelegationRegistration;
use App\Models\Delegate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Events\NewRegistrationCreated;
use App\MailServices\PHPMailerService;

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
                'full_name' => '', 'email' => '', 'phone' => '', 'nationality' => '',
                'package_type' => 'Full Accommodation',
                'needs_accommodation' => true,
                'council_preference_1' => '', 'country_preference_1_1' => '', 'country_preference_1_2' => '', 'reason_for_first_country_preference_1' => '', 'reason_for_second_country_preference_1' => '',
                'council_preference_2' => '', 'country_preference_2_1' => '', 'country_preference_2_2' => '', 'reason_for_first_country_preference_2' => '', 'reason_for_second_country_preference_2' => ''
            ],
            [
                'full_name' => '', 'email' => '', 'phone' => '', 'nationality' => '',
                'package_type' => 'Full Accommodation',
                'needs_accommodation' => true,
                'council_preference_1' => '', 'country_preference_1_1' => '', 'country_preference_1_2' => '', 'reason_for_first_country_preference_1' => '', 'reason_for_second_country_preference_1' => '',
                'council_preference_2' => '', 'country_preference_2_1' => '', 'country_preference_2_2' => '', 'reason_for_first_country_preference_2' => '', 'reason_for_second_country_preference_2' => ''
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
            'email' => 'required|email|max:255|unique:delegation_registrations,email',
            'phone' => 'required|string|max:20',
            'nationality' => 'required|string|max:100',
            'institution' => 'required|string|max:255',
            'needs_accommodation' => 'nullable|boolean',
            'package_type' => 'required|string|max:255',
            'attendance_type' => ['required', Rule::in(['Online', 'Offline'])],
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'council_preference_1' => 'required|string|max:255',
            'country_preference_1_1' => 'required|string|max:255',
            'country_preference_1_2' => 'required|string|max:255',
            'reason_for_first_country_preference_1' => 'required|string',
            'reason_for_second_country_preference_1' => 'required|string',
            'council_preference_2' => 'required|string|max:255',
            'country_preference_2_1' => 'required|string|max:255',
            'country_preference_2_2' => 'required|string|max:255',
            'reason_for_first_country_preference_2' => 'required|string',
            'reason_for_second_country_preference_2' => 'required|string',
        ]);

        $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
        $socialMediaProofPath = $request->file('social_media_proof')->store('proofs/social_media', 'public');

        $registration = DelegationRegistration::create([
            'registering_as' => 'Individual Delegate',
            'delegate_type' => $validatedData['delegate_type'],
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'nationality' => $validatedData['nationality'],
            'institution_name' => $validatedData['institution'] ,
            'do_you_need_accommodation' => $request->has('needs_accommodation'),
            'attendance_type' => $validatedData['attendance_type'],
            'package_type' => $validatedData['package_type'],
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
            'council_preference_1' => $validatedData['council_preference_1'],
            'country_preference_1_1' => $validatedData['country_preference_1_1'],
            'country_preference_1_2' => $validatedData['country_preference_1_2'],
            'reason_for_first_country_preference_1' => $validatedData['reason_for_first_country_preference_1'],
            'reason_for_second_country_preference_1' => $validatedData['reason_for_second_country_preference_1'],
            'council_preference_2' => $validatedData['council_preference_2'],
            'country_preference_2_1' => $validatedData['country_preference_2_1'],
            'country_preference_2_2' => $validatedData['country_preference_2_2'],
            'reason_for_first_country_preference_2' => $validatedData['reason_for_first_country_preference_2'],
            'reason_for_second_country_preference_2' => $validatedData['reason_for_second_country_preference_2'],
        ]);

        NewRegistrationCreated::dispatch();
        $mailer = new PHPMailerService();
        $mailer->sendMail(
            $registration->email,
            'Konfirmasi Pendaftaran JagoMUN',
            '<p>Halo ' . $registration->full_name . ',</p><p>Terima kasih telah mendaftar sebagai Individual Delegate di JagoMUN. Kami akan segera memproses pendaftaran Anda.</p>'
        );
        return redirect()->route('registration.success')->with('success', 'Registrasi Individual Anda berhasil!');
    }

    public function submitObserverForm(Request $request)
    {
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Observer', 'International Observer'])],
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:delegation_registrations,email',
            'phone' => 'required|string|max:20',
            'nationality' => 'required|string|max:100',
            'institution' => 'required|string|max:255',
            'needs_accommodation' => 'nullable|boolean',
            'attendance_type' => ['required', Rule::in(['Online', 'Offline'])],
            'package_type' => 'required|string|max:255',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
        $socialMediaProofPath = $request->hasFile('social_media_proof') ? $request->file('social_media_proof')->store('proofs/social_media', 'public') : null;

        $registration = DelegationRegistration::create([
            'registering_as' => 'Observer',
            'delegate_type' => $validatedData['delegate_type'],
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'nationality' => $validatedData['nationality'],
            'institution_name' => $validatedData['institution'],
            'do_you_need_accommodation' => $request->has('needs_accommodation'),
            'attendance_type' => $validatedData['attendance_type'],
            'package_type' => $validatedData['package_type'],
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
        ]);

        NewRegistrationCreated::dispatch();

        $mailer = new PHPMailerService();
        $mailer->sendMail(
            $registration->email,
            'Konfirmasi Pendaftaran JagoMUN',
            '<p>Halo ' . $registration->full_name . ',</p><p>Terima kasih telah mendaftar sebagai Observer di JagoMUN. Kami akan segera memproses pendaftaran Anda.</p>'
        );
        return redirect()->route('registration.success')->with('success', 'Registrasi Observer Anda berhasil!');
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
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'delegates' => 'required|array|min:2',
            'delegates.*.full_name' => 'required|string|max:255',
            'delegates.*.email' => 'required|email',
            'delegates.*.phone' => 'required|string|max:20',
            'delegates.*.nationality' => 'required|string|max:100',
            'delegates.*.package_type' => ['required', Rule::in(['Full Accommodation', 'Non-Accommodation', 'Online'])],
            'delegates.*.needs_accommodation' => 'nullable|boolean',
            'delegates.*.social_media_upload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'delegates.*.council_preference_1' => 'required|string',
            'delegates.*.country_preference_1_1' => 'required|string',
            'delegates.*.country_preference_1_2' => 'required|string',
            'delegates.*.reason_for_first_country_preference_1' => 'required|string',
            'delegates.*.reason_for_second_country_preference_1' => 'required|string',
            'delegates.*.council_preference_2' => 'required|string',
            'delegates.*.country_preference_2_1' => 'required|string',
            'delegates.*.country_preference_2_2' => 'required|string',
            'delegates.*.reason_for_first_country_preference_2' => 'required|string',
            'delegates.*.reason_for_second_country_preference_2' => 'required|string',
        ]);

        $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');

        $delegatesArray = $request->input('delegates', []);
        $anyDelegateNeedsAccommodation = collect($delegatesArray)->contains('needs_accommodation', '1');

        // Menentukan attendance_type berdasarkan pilihan paket
        $isOnlineDelegation = collect($delegatesArray)->every(fn($delegate) => $delegate['package_type'] === 'Online');
        $attendanceType = $isOnlineDelegation ? 'Online' : 'Offline';

        $delegationRegistration = DelegationRegistration::create([
            'registering_as' => 'Delegation',
            'delegate_type' => $validatedData['delegate_type'],
            'institution_name' => $validatedData['institution_name'],
            'delegate_count' => count($validatedData['delegates']),
            'full_name' => $validatedData['delegates'][0]['full_name'],
            'email' => $validatedData['delegates'][0]['email'],
            'phone' => $validatedData['delegates'][0]['phone'],
            'do_you_need_accommodation' => $anyDelegateNeedsAccommodation,
            'attendance_type' => $attendanceType, // Menggunakan variabel yang sudah kita tentukan
            'payment_proof_path' => $paymentProofPath,
        ]);

        foreach ($validatedData['delegates'] as $index => $delegateData) {
            $socialMediaProofPath = null;
            if ($request->hasFile("delegates.{$index}.social_media_upload")) {
                $socialMediaProofPath = $request->file("delegates.{$index}.social_media_upload")->store("proofs/social_media/delegates", 'public');
            }

            // Menentukan status akomodasi untuk setiap delegasi
            $needsAccommodation = ($delegateData['package_type'] === 'Full Accommodation');

            $delegationRegistration->delegates()->create([
                'delegate_number' => $index + 1,
                'full_name' => $delegateData['full_name'],
                'email' => $delegateData['email'],
                'phone' => $delegateData['phone'],
                'nationality' => $delegateData['nationality'],
                'package_type' => $delegateData['package_type'],

                // ===============================================
                // PERUBAHAN DI SINI: Menyimpan data ke kolom baru
                // ===============================================
                'attendance_type' => $delegateData['package_type'] === 'Online' ? 'Online' : 'Offline',
                'do_you_need_accommodation' => $needsAccommodation,

                'social_media_upload' => $socialMediaProofPath,
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
            ]);
        }

        NewRegistrationCreated::dispatch();
        return redirect()->route('registration.success')->with('success', 'Delegation registration successful!');
    }

    public function success()
    {
        return view('registration.succes');
    }
}
