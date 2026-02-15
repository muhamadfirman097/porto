<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\services\ImgBBService;

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

        // Ambil data (Paginate sangat penting untuk Vercel agar tidak timeout load semua data)
        $projects = $query->latest()->paginate(10)->withQueryString(); 

        // 3. OPTIMASI: Mengambil daftar Tech Stack Unik (Lebih Ringan)
        // Kita gunakan pluck() agar tidak meload seluruh Model Project ke memori
        $rawTechStacks = Project::pluck('tech_stack')->filter();
        
        $uniqueTechs = $rawTechStacks
            ->flatMap(function ($item) {
                return explode(',', $item); // Pecah berdasarkan koma
            })
            ->map(function ($item) {
                return ucwords(strtolower(trim($item))); // Rapikan spasi & huruf besar
            })
            ->filter() // Hapus yang kosong
            ->unique() // Hapus duplikat
            ->sort() // Urutkan A-Z
            ->values() // Reset index array
            ->all();

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
            'image' => 'required|image|max:2048', // Max 2MB
        ]);

        // LOGIKA UPLOAD IMGBB
        if ($request->hasFile('image')) {
            $imageUrl = $this->imgBB->upload($request->file('image'));
            
            if (!$imageUrl) {
                return back()->with('error', 'Gagal upload gambar ke ImgBB. Cek koneksi atau API Key.');
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
            
            // Update link gambar baru
            $validated['image'] = $imageUrl;
        }

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project dihapus.');
    }
}
