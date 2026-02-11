<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Cegah error 500 jika database belum siap di Vercel
        View::composer('*', function ($view) {
            $unreadCount = 0;
            try {
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
