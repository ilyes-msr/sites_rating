<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CategoryComposer;

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
        view()->composer('includes.header', CategoryComposer::class);
    }
}
