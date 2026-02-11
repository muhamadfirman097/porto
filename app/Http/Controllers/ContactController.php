<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // BAGIAN ADMIN: Melihat Daftar Pesan
    public function index(Request $request)
    {
        // 1. Mulai Query
        $query = Contact::query();

        // 2. Logika Search (Jika ada input cari)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // 3. Logika Filter (Urutan)
        if ($request->has('sort') && $request->sort == 'oldest') {
            $query->oldest(); // Terlama dulu
        } else {
            $query->latest(); // Terbaru dulu (Default)
        }

        // 4. Pagination (10 data per halaman biar rapi)
        $contacts = $query->paginate(10);

        // Kirim data lama input search/sort agar form tidak reset
        return view('admin.contacts.index', compact('contacts'));
    }

    // BAGIAN ADMIN: Menghapus Pesan
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }

    // BAGIAN PUBLIK: Mengirim Pesan (Formulir)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric', // <--- TAMBAHAN: Wajib angka
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect('/#contact')->with('success', 'Pesan terkirim! Saya akan menghubungi via WhatsApp/Email.');
    }

    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}