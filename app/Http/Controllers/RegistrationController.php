<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DelegationRegistration;
use App\Models\Delegate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    /**
     * Show the initial registration type selection page (SS 1).
     *
     * @return \Illuminate\View\View
     */
    public function chooseType()
    {
        return view('registration.choose-type');
    }

    /**
     * Handle the selection of registration type and redirect (SS 1).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            // PERBAIKAN DI SINI: Arahkan Observer ke chooseDelegateType juga
            return redirect()->route('registration.chooseDelegateType', ['type' => 'Observer']);
        }

        return redirect()->back()->with('error', 'Tipe pendaftaran tidak valid.');
    }

    /**
     * Show the delegate type selection (National/International) (SS 2).
     *
     * @param  string $type ('Individual Delegate' or 'Delegation' or 'Observer')
     * @return \Illuminate\View\View
     */
    public function chooseDelegateType($type)
    {
        // Sesuaikan validasi tipe untuk mencakup Observer
        if (!in_array($type, ['Individual Delegate', 'Delegation', 'Observer'])) {
            abort(404, 'Invalid registration type.');
        }
        return view('registration.choose-delegate-type', compact('type'));
    }

    /**
     * Handle the selection of delegate type and redirect (SS 2).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processDelegateType(Request $request)
    {
        $request->validate([
            'parent_type' => ['required', Rule::in(['Individual Delegate', 'Delegation', 'Observer'])], // Tambahkan Observer
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
            // PERBAIKAN DI SINI: Arahkan Observer ke form observer dengan delegate_type
            return redirect()->route('registration.observerForm', [
                'delegate_type' => $request->delegate_type
            ]);
        }

        return redirect()->back()->with('error', 'Tipe delegasi tidak valid.');
    }

    /**
     * Show the Individual Delegate registration form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showIndividualForm(Request $request)
    {
        $delegateType = $request->query('delegate_type');
        if (!in_array($delegateType, ['National Delegate', 'International Delegate'])) {
            abort(404, 'Invalid delegate type for individual registration.');
        }
        return view('registration.individual-form', compact('delegateType'));
    }

    /**
     * Handle Individual Delegate form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
        ]);

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
        }
        $socialMediaProofPath = null;
        if ($request->hasFile('social_media_proof')) {
            $socialMediaProofPath = $request->file('social_media_proof')->store('proofs/social_media', 'public');
        }

        DelegationRegistration::create([
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
        ]);

        return redirect()->route('registration.success')->with('success', 'Registrasi Individual Anda berhasil!');
    }

    /**
     * Show the Delegation registration form (SS 3 and beyond).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showDelegationForm(Request $request)
    {
        $delegateType = $request->query('delegate_type');
        if (!in_array($delegateType, ['National Delegate', 'International Delegate'])) {
            abort(404, 'Invalid delegate type for delegation registration.');
        }
        // Ini hanya akan menampilkan halaman yang memuat komponen Livewire
        return view('registration.delegation-form-wrapper', compact('delegateType'));
    }

    /**
     * Show the Observer registration form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
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
     * Handle Observer form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitObserverForm(Request $request)
    {
        $validatedData = $request->validate([
            'delegate_type' => ['required', Rule::in(['National Delegate', 'International Delegate'])], // Tambahkan validasi ini
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:delegation_registrations,email',
            'phone' => 'required|string|max:20',
            'nationality' => 'required|string|max:100',
            'institution' => 'nullable|string|max:255',
            'motivation_statement' => 'nullable|string|min:10',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'social_media_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'referral_code' => 'nullable|string|max:50',
        ]);

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('proofs/payment', 'public');
        }
        $socialMediaProofPath = null;
        if ($request->hasFile('social_media_proof')) {
            $socialMediaProofPath = $request->file('social_media_proof')->store('proofs/social_media', 'public');
        }

        DelegationRegistration::create([
            'registering_as' => 'Observer',
            'delegate_type' => $validatedData['delegate_type'], // Simpan tipe delegasi yang dipilih
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'nationality' => $validatedData['nationality'],
            'institution_name' => $validatedData['institution'] ?? null,
            'motivation_statement' => $validatedData['motivation_statement'] ?? null,
            'do_you_need_accommodation' => null,
            'payment_proof_path' => $paymentProofPath,
            'social_media_proof_path' => $socialMediaProofPath,
            'referral_code' => $validatedData['referral_code'] ?? null,
        ]);

        return redirect()->route('registration.success')->with('success', 'Registrasi Observer Anda berhasil!');
    }

    /**
     * Display the registration success page.
     *
     * @return \Illuminate\View\View
     */
    public function success()
    {
        return view('registration.succes');
    }
}
