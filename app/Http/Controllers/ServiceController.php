<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|string',
            'tech_stack' => 'nullable|string', // Validasi Tech Stack
            'image' => 'nullable|image|max:2048', // Validasi Gambar (Max 2MB)
        ]);

        // Upload Gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Hapus gambar dari penyimpanan jika ada
        if ($service->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        return redirect()->back()->with('success', 'Layanan dihapus.');
    }
}