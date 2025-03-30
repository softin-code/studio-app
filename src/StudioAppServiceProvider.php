<?php

namespace SoftinCode\StudioApp;

use Illuminate\Support\ServiceProvider;
use Softin\StudioApp\Macros\BlueprintMacro;

class StudioAppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Blueprint Macro
        BlueprintMacro::register();
    }

    public function boot()
    {
        // Load routes, migrations, views, etc.
    }
}

