<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact; // Pastikan model Contact di-import
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Menampilkan daftar semua pesan kontak.
     */
    public function index()
    {
        // Mengambil semua pesan dari database, diurutkan dari yang terbaru, dan dibagi per halaman
        $messages = Contact::latest()->paginate(15);

        // Mengirim data pesan ke view 'admin.contacts.index'
        return view('admin.contacts.index', [
            'messages' => $messages,
        ]);
    }

    /**
     * Menghapus pesan kontak.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Message has been deleted successfully.');
    }
}

