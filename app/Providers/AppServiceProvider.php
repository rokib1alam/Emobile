<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Seo;
use App\Models\Smtp;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Only attempt a DB lookup if the smtp table actually exists
        if (Schema::hasTable((new Smtp)->getTable())) {
            try {
                $smtp = Smtp::where('mailer', 'smtp')->first();
            } catch (\Throwable $e) {
                // If something goes wrong (e.g. DB not yet configured), skip override
                $smtp = null;
            }

            if ($smtp) {
                // override the mailer
                config(['mail.default' => $smtp->mailer]);

                // override the smtp mailer settings
                config([
                    'mail.mailers.smtp.transport'  => 'smtp',
                    'mail.mailers.smtp.host'       => $smtp->host,
                    'mail.mailers.smtp.port'       => $smtp->port,
                    'mail.mailers.smtp.encryption' => $smtp->encryption,
                    'mail.mailers.smtp.username'   => $smtp->user_name,
                    'mail.mailers.smtp.password'   => $smtp->password,
                ]);

                // override global “from” address
                config([
                    'mail.from.address' => $smtp->user_name,
                    'mail.from.name'    => config('app.name'),
                ]);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Setting ডেটা শেয়ার
        $settings = Setting::first();
        view()->share('setting', $settings);

        // SEO ডেটা শেয়ার
        $seo = Seo::first();
        view()->share('seo', $seo);

        // Categories ডেটা শেয়ার (with relations)
        $categories = Category::with('subcategories.childCategories')->withCount('products')->get();
        view()->share('categories', $categories);
    }

    



}
