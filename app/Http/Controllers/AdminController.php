<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DelegationRegistration; // Pastikan model ini benar
use App\Models\Delegate;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with a list of all registrations.
     */
    public function dashboard()
    {
        // Kode ini sudah benar untuk menampilkan dashboard utama.
        $registrations = DelegationRegistration::with('delegates')->latest()->get();
        return view('admin.dashboard', compact('registrations'));
    }

    /**
     * MODIFIED: Display the detail of a specific registration.
     *
     * @param  \App\Models\DelegationRegistration  $registration
     * @return \Illuminate\View\View
     */
    public function showRegistrationDetail(DelegationRegistration $registration)
    {
        $registration->load('delegates');

        return view('admin.registration-detail', [
            'registration' => $registration
        ]);
    }

    // --- FUNGSI BARU DITAMBAHKAN DI SINI ---
    /**
     * Toggle the verification status of a registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DelegationRegistration  $registration
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleVerification(Request $request, DelegationRegistration $registration)
    {
        // Validasi input (memastikan data yang dikirim adalah boolean)
        $request->validate([
            'verified' => 'required|boolean',
        ]);

        // Update kolom is_verified di database
        $registration->update([
            'is_verified' => $request->verified,
        ]);

        // Kirim response bahwa operasi berhasil
        return response()->json(['success' => true, 'message' => 'Status verifikasi berhasil diperbarui.']);
    }
}
