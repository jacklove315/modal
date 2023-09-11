<?php

namespace Jlove\Modal;

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
            __DIR__ . '/../public' => public_path('vendor/jlove/modal'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jlove');

        Livewire::component('jlove-modal', Modal::class);
    }
}
