<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisiasi Query
        $query = Project::query();

        // 2. Logika Pencarian (Search by Title atau Description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 3. Logika Filter by Tech Stack
        if ($request->filled('tech')) {
            $tech = $request->tech;
            $query->where('tech_stack', 'like', "%{$tech}%");
        }

        // Ambil data yang sudah difilter, gunakan withQueryString agar saat pindah halaman, filternya tidak hilang
        $projects = $query->latest()->paginate(10)->withQueryString(); 

        // 4. Mengambil daftar unik Tech Stack untuk Dropdown Admin
        $allProjects = Project::select('tech_stack')->get();
        $allTechs = [];
        
        foreach ($allProjects as $p) {
            if (!empty($p->tech_stack)) {
                $techs = explode(',', $p->tech_stack);
                foreach ($techs as $t) {
                    $cleanTech = trim($t);
                    if ($cleanTech != '') {
                        // Merapikan teks (huruf besar di awal kata)
                        $allTechs[] = ucwords(strtolower($cleanTech)); 
                    }
                }
            }
        }
        
        // Hapus duplikat dan urutkan sesuai abjad
        $uniqueTechs = array_values(array_unique($allTechs));
        sort($uniqueTechs);

        // Kirim data projects dan uniqueTechs ke view
        return view('admin.projects.index', compact('projects', 'uniqueTechs'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'source_url' => 'nullable|url', // PERBAIKAN: Menggunakan source_url
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'source_url' => 'nullable|url', // PERBAIKAN: Menggunakan source_url
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();
        
        return redirect()->route('projects.index')->with('success', 'Project dihapus.');
    }
}