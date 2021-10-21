<?php

namespace App\Providers;

use App\Category;


use App\Gateways\zarinpal\ZarinpalAdaptor;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });
        
        view()->composer('layouts.header', function ($view) {
            $view->with('categories', Category::where('parent_id', null)->get());
        });
    }
}
