<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL; // PENTING: Tambahkan ini untuk memperbaiki style
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. MEMPERBAIKI TAMPILAN (STYLE) BERANTAKAN
        // Memaksa Laravel menggunakan HTTPS untuk semua link Asset (CSS/JS) dan URL
        if (config('app.env') === 'production' || env('VERCEL')) {
            URL::forceScheme('https');
        }

        // 2. LOGIKA UNREAD MESSAGES (Shared View)
        // Cegah error 500 jika database belum siap di Vercel
        View::composer('*', function ($view) {
            $unreadCount = 0;
            try {
                // Pastikan koneksi database ada dan tabel 'contacts' sudah dimigrasi
                if (Schema::hasTable('contacts')) {
                    $unreadCount = Contact::where('is_read', false)->count();
                }
            } catch (\Exception $e) {
                $unreadCount = 0;
            }
            $view->with('unreadCount', $unreadCount);
        });
    }
}
