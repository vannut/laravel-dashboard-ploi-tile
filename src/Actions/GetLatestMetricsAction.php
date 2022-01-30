<?php

namespace Vannut\PloiTile;

use Illuminate\Support\Collection;

class GetLatestMetricsAction {

    public function execute() {
        $raw = collect([
                '1234' => [
                    "metrics" => [
                        "cpu" => (float) "80.2",
                        "ram"=> (float) "21.81",
                        "disk"=> (float)"40",
                        "load_average"=> (float) "0.19"
                    ]
                ],
                '5678' => [
                    "metrics" => [
                        "cpu" => (float) "6",
                        "ram"=> (float) "22.09",
                        "disk"=> (float)"40",
                        "load_average"=> (float) "0.26"
                    ]
                ],
            ]);

        return $this->processAlerts($raw);
    }

    private function processAlerts(
        Collection $raw
    ) {

        $tresholds = config('dashboard.tiles.ploi.alert_tresholds', [
            "cpu" => 75,
            "ram" => 75,
            "disk" => 80
        ]);


        return $raw->transform(function ($server)  use ($tresholds) {
            $status = 'nominal';
            $for = [];
            foreach($tresholds as $metric => $treshold) {
                if (in_array($metric,['cpu','ram','disk'])
                    && (float) $server['metrics'][$metric] >= $treshold
                ) {
                    $status = 'alert';
                    $for[] = $metric;
                };
            };
            $server['status'] = $status;
            $server['alert_for'] = $for;
            return $server;
        });
    }
}