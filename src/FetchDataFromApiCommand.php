<?php

namespace Vannut\PloiTile;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Vannut\PloiTile\Actions\DeploymentStore;

class FetchDataFromApiCommand extends Command
{
    protected $signature = 'dashboard:fetch-deployment-data-from-ploi';

    protected $description = 'Fetch deployments from ploi';

    public function handle()
    {
        $this->info('Fetching ploi data...');
        $apiUrl = 'https://ploi.io/api/servers/{serverId}/sites/{siteId}';
        $token = config('dashboard.tiles.ploi.api_token');
        $toFetch = collect(config('dashboard.tiles.ploi.sites', []));
        $data = [];

        $toFetch->each(function ($site) use ($apiUrl, $token, &$data) {
            [ $serverId, $siteId ] = explode(':',$site);
            $endpoint = str_replace(['{serverId}', '{siteId}'], [$serverId, $siteId], $apiUrl);

            $response = Http::acceptJson()
            ->withToken($token)
            ->get($endpoint);
            if($response->ok()) {
                $json = $response->json();
                $data[$site] = [
                    'domain' => $json['data']['domain'],
                    'status' => $json['data']['status'],
                    'last_deploy_at' => $json['data']['last_deploy_at'],
                    'has_repository' => $json['data']['has_repository'],
                ];
            } else {
                $json = $response->json();
                $json['error'] = true;
                $data[$site] = $json; //['error' => true, 'resp' => $response->json()];

            };

        });


        // Save data to database through the Store
        DeploymentStore::make()->setData($data);

          $this->info('All done!');
    }
}
