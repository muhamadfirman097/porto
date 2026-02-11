<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Service; // Pastikan model Service di-import
use App\Models\HomeSetting;

class HomeController extends Controller
{
    public function index()
    {
        $home = HomeSetting::firstOrCreate(['id' => 1]);
        $skills = Skill::all();
        
        // LIMIT 6 DATA TERBARU
        $services = Service::latest()->take(6)->get(); 
        $projects = Project::latest()->take(6)->get();

        return view('welcome', compact('projects', 'home', 'skills', 'services'));
    }

    // HALAMAN SEMUA PROJECT
    public function allProjects()
    {
        $home = HomeSetting::firstOrCreate(['id' => 1]);
        // Gunakan paginate agar halaman tidak berat jika data ratusan
        $projects = Project::latest()->paginate(9); 
        
        return view('public.projects', compact('projects', 'home'));
    }

    // HALAMAN SEMUA SERVICES
    public function allServices()
    {
        $home = HomeSetting::firstOrCreate(['id' => 1]);
        $services = Service::latest()->get(); 
        
        return view('public.services', compact('services', 'home'));
    }

    // --- TAMBAHKAN METHOD INI (PENYEBAB ERROR) ---
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $home = HomeSetting::firstOrCreate(['id' => 1]);

        return view('project-detail', compact('project', 'home'));
    }
}