<?php

namespace Jacklove315\Modal;

use Livewire\Livewire;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/jacklove315-modal.php' => config_path('jacklove315-modal.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/jacklove315/modal'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jacklove315');

        Livewire::component('jacklove315-modal', Modal::class);
    }
}
