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
            __DIR__ . '/../config/jacklove315-modal.php' => config_path('jl-modal.php'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jacklove315');

        Livewire::component('jl-modal', Modal::class);
    }
}
