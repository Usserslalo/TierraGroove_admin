<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\NavigationItem;
use App\Models\SocialLink;
use App\Models\SiteSetting;

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
        // Compartir datos con las vistas públicas
        if (Schema::hasTable('navigation_items') && Schema::hasTable('social_links') && Schema::hasTable('site_settings')) {
            View::composer('layouts.public', function ($view) {
                $view->with('navigationItems', NavigationItem::active()->ordered()->get());
                $view->with('socialLinks', SocialLink::active()->ordered()->get());
                $view->with('siteSettings', SiteSetting::all()->keyBy('key'));
            });
        }
    }
}
