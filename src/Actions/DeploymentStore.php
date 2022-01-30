<?php

namespace Vannut\PloiTile\Actions;

use Spatie\Dashboard\Models\Tile;

class DeploymentStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("ploi");
    }

    public function setData(array $data): self
    {
        $this->tile->putData('sites', $data);

        return $this;
    }

    public function getData(): array
    {
        return$this->tile->getData('sites') ?? [];
    }
}
