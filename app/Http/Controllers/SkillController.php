<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ada ini

class SkillController extends Controller
{
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
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('skills', 'public');
        }

        Skill::create($validated);

        return redirect()->back()->with('success', 'Skill berhasil ditambahkan!');
    }

    // --- TAMBAHAN BARU: EDIT ---
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    // --- TAMBAHAN BARU: UPDATE ---
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|max:1024',
        ]);

        // Simpan data text dulu
        $skill->name = $request->name;
        $skill->percentage = $request->percentage;

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($skill->image) {
                Storage::disk('public')->delete($skill->image);
            }
            // Simpan gambar baru
            $skill->image = $request->file('image')->store('skills', 'public');
        }

        $skill->save();

        return redirect()->route('skills.index')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        
        if ($skill->image) {
            Storage::disk('public')->delete($skill->image);
        }

        $skill->delete();
        return redirect()->back()->with('success', 'Skill dihapus.');
    }
}