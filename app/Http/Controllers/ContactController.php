<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Jika Anda ingin mengirim email

class ContactController extends Controller
{
    /**
     * Display the Contact Us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Opsional: Kirim email
        // Anda perlu mengkonfigurasi pengaturan mail di .env (MAIL_MAILER, MAIL_HOST, dll.)
        // dan membuat Mailable class (php artisan make:mail ContactUsMail)
        /*
        Mail::to('admin@jagomun.com')->send(new \App\Mail\ContactUsMail($validatedData));
        */

        // Atau Anda bisa menyimpannya ke database jika Anda memiliki tabel 'contacts'
        // \App\Models\Contact::create($validatedData);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
