<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;

class FolioServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Folio::path(resource_path('views/pages/platform'))
            ->uri('/')
            ->middleware([
                '*' => [],
            ]);

        Folio::path(resource_path('views/pages/wooblr'))
            ->uri(config('app.url_wooblr'))
            ->middleware([
                '*' => [],
            ]);
    }
}
