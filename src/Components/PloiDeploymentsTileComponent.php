<?php

namespace Vannut\PloiTile\Components;

use Livewire\Component;
use Vannut\PloiTile\Actions\DeploymentStore;

class PloiDeploymentsTileComponent extends Component
{
    public $position;


    public function mount(string $position, string $style)
    {
        $this->position = $position;
        $this->style = $style;
    }


    public function render()
    {

        return view('laravel-dashboard-ploi-tile-views::deployments_tile', [
            // 'style' => 'block',
            'sites' => DeploymentStore::make()->getData(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.ploi.deployment_refresh_interval_in_seconds') ?? 20,
        ]);
    }
}
