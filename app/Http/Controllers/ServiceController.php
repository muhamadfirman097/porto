<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\services\ImgBBService; // Import Service

class ServiceController extends Controller
{
    protected $imgBB;

    // Inject Service
    public function __construct(ImgBBService $imgBB)
    {
        $this->imgBB = $imgBB;
    }

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
            'tech_stack' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // LOGIKA UPLOAD IMGBB
        if ($request->hasFile('image')) {
            $imageUrl = $this->imgBB->upload($request->file('image'));
            
            if (!$imageUrl) {
                return back()->with('error', 'Gagal upload gambar ke ImgBB.');
            }
            
            $validated['image'] = $imageUrl;
        }

        Service::create($validated);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Cukup hapus record database
        $service->delete();
        
        return redirect()->back()->with('success', 'Layanan dihapus.');
    }
}
