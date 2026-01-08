<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Region;

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
        // View Composer: Inject regions ke layouts.app
        // Setiap kali layouts.app di-render, variable $regions otomatis tersedia
        View::composer('layouts.app', function ($view) {
            // Cache selama 1 jam (3600 detik) untuk performa
            // Data region jarang berubah, jadi tidak perlu query database terus-menerus
            $regions = Cache::remember('regions_list', 3600, function () {
                return Region::orderBy('name')->get();
            });
            
            // Inject variable $regions ke view
            $view->with('regions', $regions);
        });
    }
}
