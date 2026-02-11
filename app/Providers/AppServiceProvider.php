<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // Tambahkan ini
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
        /**
         * Perbaikan untuk Vercel & TiDB:
         * Membungkus View Composer dengan pengecekan Schema agar tidak error 500
         * jika tabel belum ada atau koneksi database sedang booting.
         */
        View::composer('*', function ($view) {
            $unreadCount = 0;

            try {
                // Pastikan tabel 'contacts' ada sebelum melakukan query
                if (Schema::hasTable('contacts')) {
                    $unreadCount = Contact::where('is_read', false)->count();
                }
            } catch (\Exception $e) {
                // Jika database error, biarkan count bernilai 0 dan jangan hentikan aplikasi (Error 500)
                $unreadCount = 0;
            }

            $view->with('unreadCount', $unreadCount);
        });
    }
}
