<?php

namespace Softin\StudioApp;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Softin\StudioApp\Macros\BlueprintMacro;

class StudioAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Register Blueprint Macro
        BlueprintMacro::register();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
