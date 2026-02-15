<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Services\ImgBBService; // Import Service

class SkillController extends Controller
{
    protected $imgBB;

    // Inject Service ImgBB
    public function __construct(ImgBBService $imgBB)
    {
        $this->imgBB = $imgBB;
    }

    public function index()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|max:2048', // Max 2MB (sesuai limit ImgBB free biasanya cukup besar, tapi 2MB aman)
        ]);

        // LOGIKA UPLOAD IMGBB
        if ($request->hasFile('image')) {
            $imageUrl = $this->imgBB->upload($request->file('image'));
            
            if (!$imageUrl) {
                return back()->with('error', 'Gagal upload gambar ke ImgBB.');
            }
            
            $validated['image'] = $imageUrl;
        }

        Skill::create($validated);

        return redirect()->back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        $skill->name = $request->name;
        $skill->percentage = $request->percentage;

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            $imageUrl = $this->imgBB->upload($request->file('image'));
            
            if (!$imageUrl) {
                return back()->with('error', 'Gagal update gambar ke ImgBB.');
            }
            
            // Update URL gambar
            $skill->image = $imageUrl;
            // Catatan: Gambar lama di ImgBB tidak perlu dihapus manual via API
        }

        $skill->save();

        return redirect()->route('skills.index')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        
        // Hapus record saja, tidak perlu hapus file di storage lokal lagi
        $skill->delete();
        
        return redirect()->back()->with('success', 'Skill dihapus.');
    }
}