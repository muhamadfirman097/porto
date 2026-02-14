<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\DB; // PENTING: Untuk fitur cek koneksi database

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


// --- AREA DEBUGGING (PENTING UNTUK VERCEL) ---
// Route ini untuk mengecek apakah Database TiDB berhasil connect atau tidak.
// Akses via browser: /cek-db
Route::get('/cek-db', function () {
    try {
        // Coba ping database
        if (DB::connection()->getPdo()) {
            $dbName = DB::connection()->getDatabaseName();
            $config = config('database.connections.mysql.options');
            
            // Cek path SSL yang dipakai sistem
            $sslPath = isset($config[PDO::MYSQL_ATTR_SSL_CA]) ? $config[PDO::MYSQL_ATTR_SSL_CA] : 'Tidak diset';

            return response()->json([
                'status' => 'SUKSES',
                'pesan' => 'Koneksi ke Database Berhasil!',
                'database_name' => $dbName,
                'ssl_debug' => [
                    'path_yang_dipakai' => $sslPath,
                    'apakah_file_ada' => file_exists($sslPath) ? 'YA, FILE DITEMUKAN' : 'TIDAK, FILE HILANG',
                ]
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'GAGAL',
            'pesan_error' => $e->getMessage(),
            'debug_info' => [
                'cek_lokasi_default_vercel' => file_exists('/etc/pki/tls/certs/ca-bundle.crt') ? 'ADA' : 'TIDAK ADA',
                'cek_lokasi_ubuntu' => file_exists('/etc/ssl/certs/ca-certificates.crt') ? 'ADA' : 'TIDAK ADA',
            ]
        ], 500);
    }
});
// ----------------------------------------------


// --- HALAMAN ADMIN (Harus Login) ---
Route::get('/dashboard', function () {
    // Pastikan table sudah dimigrasi sebelum memanggil Model
    try {
        $totalProjects = \App\Models\Project::count();
        $totalSkills = \App\Models\Skill::count();
        $totalServices = \App\Models\Service::count();
        $unreadMessages = \App\Models\Contact::where('is_read', false)->count();
        
        // AMBIL 5 PROJECT TERBARU
        $recentProjects = \App\Models\Project::latest()->take(5)->get();

        return view('dashboard', compact('totalProjects', 'totalSkills', 'totalServices', 'unreadMessages', 'recentProjects'));
    } catch (\Exception $e) {
        // Jika database belum dimigrasi, tampilkan pesan ramah
        return "Database terkoneksi tapi Tabel belum ada. Silakan jalankan 'php artisan migrate' di lokal lalu konek ke TiDB, atau cek route /cek-db untuk detail error.";
    }
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
    Route::resource('skills', SkillController::class)->except(['show']);

    // Manajemen Services (CRUD - Saat ini hanya Index, Store, Destroy)
    Route::resource('services', ServiceController::class)->only(['index', 'store', 'destroy']);

    // Manajemen Inbox / Pesan Masuk
    Route::get('/inbox', [ContactController::class, 'index'])->name('inbox.index');
    Route::delete('/inbox/{id}', [ContactController::class, 'destroy'])->name('inbox.destroy');
    Route::post('/inbox/{id}/read', [ContactController::class, 'markAsRead'])->name('inbox.read');
});

require __DIR__.'/auth.php';
