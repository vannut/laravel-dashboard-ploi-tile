<?php

namespace Vannut\PloiTile;

use Illuminate\Support\ServiceProvider;
use Vannut\PloiTile\Components\PloiResourcesTileComponent;
use Vannut\PloiTile\Components\PloiDeploymentsTileComponent;
use Livewire\Livewire;

class PloiTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromApiCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/laravel-dashboard-ploi-tile'),
        ], 'laravel-dashboard-ploi-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-dashboard-ploi-tile-views');

        Livewire::component('ploi-resources-tile', PloiResourcesTileComponent::class);
        Livewire::component('ploi-deployments-tile', PloiDeploymentsTileComponent::class);
    }
}
