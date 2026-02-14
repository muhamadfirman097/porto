<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\ImgBBService; // Import Service ImgBB yang sudah dibuat

class ProjectController extends Controller
{
    protected $imgBB;

    /**
     * Inject ImgBBService melalui constructor
     */
    public function __construct(ImgBBService $imgBB)
    {
        $this->imgBB = $imgBB;
    }

    public function index(Request $request)
    {
        $query = Project::query();

        // 1. Logika Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 2. Logika Filter by Tech Stack
        if ($request->filled('tech')) {
            $tech = $request->tech;
            $query->where('tech_stack', 'like', "%{$tech}%");
        }

        $projects = $query->latest()->paginate(10)->withQueryString(); 

        // 3. Mengambil daftar unik Tech Stack untuk Dropdown
        $allProjects = Project::select('tech_stack')->get();
        $allTechs = [];
        
        foreach ($allProjects as $p) {
            if (!empty($p->tech_stack)) {
                $techs = explode(',', $p->tech_stack);
                foreach ($techs as $t) {
                    $cleanTech = trim($t);
                    if ($cleanTech != '') {
                        $allTechs[] = ucwords(strtolower($cleanTech)); 
                    }
                }
            }
        }
        
        $uniqueTechs = array_values(array_unique($allTechs));
        sort($uniqueTechs);

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
            'source_url' => 'nullable|url',
            'image' => 'required|image|max:2048',
        ]);

        // LOGIKA UPLOAD IMGBB
        if ($request->hasFile('image')) {
            $imageUrl = $this->imgBB->upload($request->file('image'));
            
            if (!$imageUrl) {
                return back()->with('error', 'Gagal upload gambar ke ImgBB. Pastikan API Key benar.');
            }
            
            $validated['image'] = $imageUrl;
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
            'source_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);

        // LOGIKA UPDATE GAMBAR KE IMGBB
        if ($request->hasFile('image')) {
            $imageUrl = $this->imgBB->upload($request->file('image'));
            
            if (!$imageUrl) {
                return back()->with('error', 'Gagal update gambar ke ImgBB.');
            }
            
            // Kita tidak perlu hapus gambar lama di ImgBB via API (karena gratis/unlimited)
            // Cukup ganti link-nya di database.
            $validated['image'] = $imageUrl;
        }

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        // Untuk ImgBB, kita biasanya cukup menghapus record di database
        $project->delete();
        
        return redirect()->route('projects.index')->with('success', 'Project dihapus.');
    }
}
