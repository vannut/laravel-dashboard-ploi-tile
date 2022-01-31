<?php

namespace Vannut\PloiTile\Components;

use Livewire\Component;
use Vannut\PloiTile\Actions\DeploymentStore;

class PloiSingleDeploymentTileComponent extends Component
{
    public $position;


    public function mount(
        string $position,
        string $ploiId
    ) {
        $this->position = $position;
        $this->ploiId = $ploiId;
    }


    public function render()
    {
        $sites = collect(DeploymentStore::make()->getData());
        $site = ($sites->has($this->ploiId))
            ? $sites->get($this->ploiId)
            : [
                'error' => true,
                'message' => '404 in local store'
            ];
        return view('laravel-dashboard-ploi-tile-views::single_deployment_tile', [
            'ploiId' => $this->ploiId,
            'site' => $site,
            'refreshIntervalInSeconds' => config('dashboard.tiles.ploi.deployment_refresh_interval_in_seconds') ?? 10,
        ]);
    }
}
