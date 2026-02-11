<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK (Bisa diakses siapa saja) ---

// 1. Halaman Depan
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Detail Project
Route::get('/project/{id}', [HomeController::class, 'show'])->name('project.show');

// 3. Halaman "Lihat Semua" (Pagination)
Route::get('/all-projects', [HomeController::class, 'allProjects'])->name('public.projects');
Route::get('/all-services', [HomeController::class, 'allServices'])->name('public.services');

// 4. Kirim Pesan Kontak
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// --- HALAMAN ADMIN (Harus Login) ---
Route::get('/dashboard', function () {
    $totalProjects = \App\Models\Project::count();
    $totalSkills = \App\Models\Skill::count();
    $totalServices = \App\Models\Service::count();
    $unreadMessages = \App\Models\Contact::where('is_read', false)->count();
    
    // AMBIL 5 PROJECT TERBARU
    $recentProjects = \App\Models\Project::latest()->take(5)->get();

    return view('dashboard', compact('totalProjects', 'totalSkills', 'totalServices', 'unreadMessages', 'recentProjects'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil Bawaan Laravel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengaturan Halaman Depan (Judul, Hero, dll)
    Route::get('/settings', [HomeSettingController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [HomeSettingController::class, 'update'])->name('settings.update');

    // Manajemen Projects (CRUD Lengkap)
    Route::resource('projects', ProjectController::class);

    // Manajemen Skills (CRUD - Kecuali Show)
    // Menggunakan 'except show' agar fungsi index, store, edit, update, destroy aktif
    Route::resource('skills', SkillController::class)->except(['show']);

    // Manajemen Services (CRUD - Saat ini hanya Index, Store, Destroy)
    // Jika nanti mau fitur edit service, ganti 'only' jadi 'except show' seperti skills
    Route::resource('services', ServiceController::class)->only(['index', 'store', 'destroy']);

    // Manajemen Inbox / Pesan Masuk
    Route::get('/inbox', [ContactController::class, 'index'])->name('inbox.index');
    Route::delete('/inbox/{id}', [ContactController::class, 'destroy'])->name('inbox.destroy');
    Route::post('/inbox/{id}/read', [ContactController::class, 'markAsRead'])->name('inbox.read');
});

require __DIR__.'/auth.php';