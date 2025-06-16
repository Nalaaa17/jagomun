<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DelegationRegistration;
use App\Models\Delegate; // Pastikan model Delegate diimpor
use Illuminate\Support\Facades\Storage; // Untuk memeriksa keberadaan file

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with a list of all registrations.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Ambil semua registrasi, urutkan dari yang terbaru
        // Dengan eager loading 'delegates' untuk pendaftaran grup
        $registrations = DelegationRegistration::with('delegates')->latest()->get();

        return view('admin.dashboard', compact('registrations'));
    }

    /**
     * Display the detail of a specific registration.
     *
     * @param  \App\Models\DelegationRegistration  $registration
     * @return \Illuminate\View\View
     */
    public function showRegistrationDetail(DelegationRegistration $registration)
    {
        // Livewire akan menangani detailnya
        return view('admin.registration-detail', compact('registration'));
    }
}
