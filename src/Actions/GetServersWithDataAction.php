<?php

namespace Vannut\PloiTile\Actions;

use Illuminate\Support\Collection;

class GetServersWithDataAction {

    public function execute() {
        // what are the servers we need to return?
        $serverIds = config('dashboard.tiles.ploi.servers', []);

        return $serverIds;
    }
}
