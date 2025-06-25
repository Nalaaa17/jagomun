<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan halaman kontak.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * PERBAIKAN: Mengganti nama metode dari 'store' menjadi 'submit'
     * agar sesuai dengan rute 'contact.submit'.
     */
    public function submit(Request $request)
    {
        // Validasi input dari formulir
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Simpan data ke database
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('succes', 'Thank you for your message! We will get back to you soon.');
    }
}
