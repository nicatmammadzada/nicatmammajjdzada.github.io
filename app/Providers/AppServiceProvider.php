<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Config;
use App\Models\Dil;
use App\Models\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


//        $diller = Dil::all();
//        $config = Config::first();
//
//
//        View::composer(['front.layouts.include.header', 'back.layouts.include.main-sidebar', 'front.layouts.include.footer'], function ($view) {
//            $time = now()->addMinutes(180);
//            $services = Cache::remember('services', $time, function () {
//                $services = Services::all();
//                return $services;
//            });
//            $view->with([
//                'services' => $services,
//            ]);
//        });
//
//        View::share([
//            'config' => $config,
//            'langs' => $diller,
//        ]);
    }
}
