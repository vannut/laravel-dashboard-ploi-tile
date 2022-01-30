<?php

namespace Vannut\PloiTile\Components;

use Livewire\Component;
use Vannut\PloiTile\Actions\GetServersWithDataAction as GetServersWithData;


class PloiResourcesTileComponent extends Component
{
    public $position;


    public function mount(string $position)
    {
        $this->position = $position;
    }


    public function render()
    {
        // // $last_metrics = (new GetLatestMetricsAction)->execute();
        // $last_metrics = collect([]);
        // $servers = collect(
        //     config('dashboard.tiles.ploi.servers', [])
        // )->transform(function ($server) use ($last_metrics) {
        //     $data = [];
        //     $data['label'] = $server['label'];
        //     $data['ploi_server_id'] = $server['ploi_server_id'];

        //     if ($last_metrics->has($server['ploi_server_id'])) {
        //         // we hebben data
        //         $data = array_merge($data, $last_metrics->get($server['ploi_server_id']));
        //     } else {
        //         $data['status'] = 'nominal';
        //         $data['metrics'] = null;
        //     };
        //     return $data;
        // });

        $servers = (new GetServersWithData)->execute();

        return view('laravel-dashboard-ploi-tile-views::resources_tile', [
            // 'myData' => MyStore::make()->getData(),
            'servers' => $servers,
            'refreshIntervalInSeconds' => config('dashboard.tiles.ploi.resources_refresh_interval_in_seconds') ?? 60,

        ]);
    }
}
