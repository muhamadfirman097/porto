<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        // 1. MEMPERBAIKI TAMPILAN (STYLE) DI VERCEL
        // Memaksa HTTPS jika di lingkungan production atau Vercel
        if (config('app.env') === 'production' || env('VERCEL')) {
            URL::forceScheme('https');
        }

        // 2. LOGIKA UNREAD MESSAGES (Shared View)
        // Gunakan check app()->runningInConsole() agar query tidak jalan saat kita sedang melakukan migrasi/artisan
        View::composer('*', function ($view) {
            // Jika sedang menjalankan command (seperti migrate), jangan jalankan query ini
            if (app()->runningInConsole()) {
                $view->with('unreadCount', 0);
                return;
            }

            $unreadCount = 0;
            try {
                // Gunakan cache singkat atau pengecekan yang sangat aman
                if (Schema::hasTable('contacts')) {
                    $unreadCount = Contact::where('is_read', false)->count();
                }
            } catch (\Exception $e) {
                // Diamkan jika gagal (fallback ke 0)
                $unreadCount = 0;
            }
            $view->with('unreadCount', $unreadCount);
        });
    }
}