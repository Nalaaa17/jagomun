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
    // Metode chooseType, processType, chooseDelegateType, processDelegateType tidak berubah
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
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate'])],
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

    // Metode untuk menampilkan form tidak berubah
    public function showIndividualForm(Request $request)
    {
        $delegateType = $request->query('delegate_type');
        if (!in_array($delegateType, ['National Delegate', 'International Delegate'])) {
            abort(404, 'Invalid delegate type for individual registration.');
        }
        return view('registration.individual-form', compact('delegateType'));
    }

    public function observerForm($delegate_type)
    {
        if (!in_array($delegate_type, ['National Delegate', 'International Delegate'])) {
            abort(404, 'Invalid delegate type for observer registration.');
        }
        return view('registration.observer-form', [
            'delegateType' => $delegate_type,
        ]);
    }

    /**
     * Handle Individual Delegate form submission.
     */
    public function submitIndividualForm(Request $request)
    {
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate'])],
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:delegation_registrations,email',
            'phone' => 'required|string|max:20',
            'nationality' => 'required|string|max:100',
            'institution' => 'nullable|string|max:255',
            'motivation_statement' => 'required|string|min:50',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'referral_code' => 'nullable|string|max:50',
            'council_preference_1' => 'nullable|string|max:255',
            'country_preference_1_1' => 'nullable|string|max:255',
            'country_preference_1_2' => 'nullable|string|max:255',
            'reason_for_first_country_preference_1' => 'nullable|string',
            'reason_for_second_country_preference_1' => 'nullable|string',
            'council_preference_2' => 'nullable|string|max:255',
            'country_preference_2_1' => 'nullable|string|max:255',
            'country_preference_2_2' => 'nullable|string|max:255',
            'reason_for_first_country_preference_2' => 'nullable|string',
            'reason_for_second_country_preference_2' => 'nullable|string',
            'council_preference_3' => 'nullable|string|max:255',
            'country_preference_3_1' => 'nullable|string|max:255',
            'country_preference_3_2' => 'nullable|string|max:255',
            'reason_for_first_country_preference_3' => 'nullable|string',
            'reason_for_second_country_preference_3' => 'nullable|string',
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
            'institution_name' => $validatedData['institution'] ?? null,
            'motivation_statement' => $validatedData['motivation_statement'],
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
            'referral_code' => $validatedData['referral_code'] ?? null,
            'council_preference_1' => $validatedData['council_preference_1'] ?? null,
            'country_preference_1_1' => $validatedData['country_preference_1_1'] ?? null,
            'country_preference_1_2' => $validatedData['country_preference_1_2'] ?? null,
            'reason_for_first_country_preference_1' => $validatedData['reason_for_first_country_preference_1'] ?? null,
            'reason_for_second_country_preference_1' => $validatedData['reason_for_second_country_preference_1'] ?? null,
            'council_preference_2' => $validatedData['council_preference_2'] ?? null,
            'country_preference_2_1' => $validatedData['country_preference_2_1'] ?? null,
            'country_preference_2_2' => $validatedData['country_preference_2_2'] ?? null,
            'reason_for_first_country_preference_2' => $validatedData['reason_for_first_country_preference_2'] ?? null,
            'reason_for_second_country_preference_2' => $validatedData['reason_for_second_country_preference_2'] ?? null,
            'council_preference_3' => $validatedData['council_preference_3'] ?? null,
            'country_preference_3_1' => $validatedData['country_preference_3_1'] ?? null,
            'country_preference_3_2' => $validatedData['country_preference_3_2'] ?? null,
            'reason_for_first_country_preference_3' => $validatedData['reason_for_first_country_preference_3'] ?? null,
            'reason_for_second_country_preference_3' => $validatedData['reason_for_second_country_preference_3'] ?? null,
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

    public function showDelegationForm(Request $request)
    {
        $delegateType = $request->query('delegate_type');
        if (!in_array($delegateType, ['National Delegate', 'International Delegate'])) {
            abort(404, 'Invalid delegate type for delegation registration.');
        }
        return view('registration.delegation-form-wrapper', compact('delegateType'));
    }

    /**
     * MODIFIED: Handle Observer form submission.
     */
    public function submitObserverForm(Request $request)
    {
        // 1. MODIFIED: Aturan validasi untuk kolom council preferences DILENGKAPI
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate'])],
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:delegation_registrations,email',
            'phone' => 'required|string|max:20',
            'nationality' => 'required|string|max:100',
            'institution' => 'nullable|string|max:255',
            'motivation_statement' => 'nullable|string|min:10',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'referral_code' => 'nullable|string|max:50',

            // --- Aturan Validasi untuk Kolom Baru (Dilengkapi) ---
            'council_preference_1' => 'nullable|string|max:255',
            'country_preference_1_1' => 'nullable|string|max:255',
            'country_preference_1_2' => 'nullable|string|max:255',
            'reason_for_first_country_preference_1' => 'nullable|string',
            'reason_for_second_country_preference_1' => 'nullable|string',
            'council_preference_2' => 'nullable|string|max:255',
            'country_preference_2_1' => 'nullable|string|max:255',
            'country_preference_2_2' => 'nullable|string|max:255',
            'reason_for_first_country_preference_2' => 'nullable|string',
            'reason_for_second_country_preference_2' => 'nullable|string',
            'council_preference_3' => 'nullable|string|max:255',
            'country_preference_3_1' => 'nullable|string|max:255',
            'country_preference_3_2' => 'nullable|string|max:255',
            'reason_for_first_country_preference_3' => 'nullable|string',
            'reason_for_second_country_preference_3' => 'nullable|string',
        ]);

        $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
        $socialMediaProofPath = $request->hasFile('social_media_proof') ? $request->file('social_media_proof')->store('proofs/social_media', 'public') : null;

        // 2. MODIFIED: Field-field baru DILENGKAPI saat membuat data
        $registration = DelegationRegistration::create([
            'registering_as' => 'Observer',
            'delegate_type' => $validatedData['delegate_type'],
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'nationality' => $validatedData['nationality'],
            'institution_name' => $validatedData['institution'] ?? null,
            'motivation_statement' => $validatedData['motivation_statement'] ?? null,
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
            'referral_code' => $validatedData['referral_code'] ?? null,

            // --- Menyimpan Data Council Preferences (Dilengkapi) ---
            'council_preference_1' => $validatedData['council_preference_1'] ?? null,
            'country_preference_1_1' => $validatedData['country_preference_1_1'] ?? null,
            'country_preference_1_2' => $validatedData['country_preference_1_2'] ?? null,
            'reason_for_first_country_preference_1' => $validatedData['reason_for_first_country_preference_1'] ?? null,
            'reason_for_second_country_preference_1' => $validatedData['reason_for_second_country_preference_1'] ?? null,
            'council_preference_2' => $validatedData['council_preference_2'] ?? null,
            'country_preference_2_1' => $validatedData['country_preference_2_1'] ?? null,
            'country_preference_2_2' => $validatedData['country_preference_2_2'] ?? null,
            'reason_for_first_country_preference_2' => $validatedData['reason_for_first_country_preference_2'] ?? null,
            'reason_for_second_country_preference_2' => $validatedData['reason_for_second_country_preference_2'] ?? null,
            'council_preference_3' => $validatedData['council_preference_3'] ?? null,
            'country_preference_3_1' => $validatedData['country_preference_3_1'] ?? null,
            'country_preference_3_2' => $validatedData['country_preference_3_2'] ?? null,
            'reason_for_first_country_preference_3' => $validatedData['reason_for_first_country_preference_3'] ?? null,
            'reason_for_second_country_preference_3' => $validatedData['reason_for_second_country_preference_3'] ?? null,
        ]);

        NewRegistrationCreated::dispatch();

        $mailer = new PHPMailerService();
        $mailer->sendMail(
            $registration->email,
            'Konfirmasi Pendaftaran JagoMUN',
            '<p>Halo ' . $registration->full_name . ',</p><p>Terima kasih telah mendaftar sebagai Individual Delegate di JagoMUN. Kami akan segera memproses pendaftaran Anda.</p>'
        );
        return redirect()->route('registration.success')->with('success', 'Registrasi Observer Anda berhasil!');
    }

    public function success()
    {
        return view('registration.succes');
    }
}

