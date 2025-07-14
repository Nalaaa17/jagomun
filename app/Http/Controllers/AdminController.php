<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DelegationRegistration; // Pastikan model ini benar
use App\Models\Delegate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;

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
    public function destroy($id)
{
    // Cari pendaftaran berdasarkan ID, jika tidak ketemu akan error 404
    $registration = DelegationRegistration::findOrFail($id);

    // Hapus file-file terkait dari storage
    if ($registration->payment_proof_path) {
        Storage::disk('public')->delete($registration->payment_proof_path);
    }
    if ($registration->social_media_proof_path) {
        Storage::disk('public')->delete($registration->social_media_proof_path);
    }

    // Jika ini adalah pendaftaran delegasi, hapus juga file medsos setiap anggota
    if ($registration->registering_as == 'Delegation' && $registration->delegates->isNotEmpty()) {
        foreach ($registration->delegates as $delegate) {
            if ($delegate->social_media_upload) {
                Storage::disk('public')->delete($delegate->social_media_upload);
            }
        }
    }

    // Hapus pendaftaran (ini akan otomatis menghapus relasi 'delegates' jika sudah di-setup dengan onDelete('cascade'))
    $registration->delete();

    // Redirect kembali ke dashboard dengan pesan sukses
    return redirect()->route('admin.dashboard')->with('success', 'Pendaftaran berhasil dihapus.');
}
public function exports()
{
    return Excel::download(new RegistrationsExport, 'rekap-pendaftar-jagomun.xlsx');
}

}
