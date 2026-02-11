<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <--- Import View
use App\Models\Contact; // <--- Import Model Contact

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Kirim variabel $unreadCount ke SEMUA view
        // Menggunakan closure agar query hanya jalan saat view dirender
        View::composer('*', function ($view) {
            $unreadCount = Contact::where('is_read', false)->count();
            $view->with('unreadCount', $unreadCount);
        });
    }
}