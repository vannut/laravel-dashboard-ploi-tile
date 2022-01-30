<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <div @class([
            'absolute bottom-0 left-0 h-full w-full p-4',
            'grid grid-cols-1 grid-rows-2 items-center gap-2',
            'bg-indigo-200 animate-pulse' => isset($site['status']) && $site['status'] === 'building',
            'bg-blue-100 animate-pulse' => isset($site['status']) && $site['status'] === 'deploying',
            'bg-green-100' => isset($site['status']) && $site['status'] === 'active',
            'bg-red-200' => isset($site['status']) && $site['status'] === 'deploy-failed',
            'bg-gray-200' => isset($site['status']) && $site['status'] === 'suspended',
        ])
        >
        @if(isset($site['domain']))
            <h1 class="text-lg">
                {{ $site['domain'] }}
            </h1>
            <div class="flex justify-end">
                <div @class([
                    'uppercase text-xs px-2 py-1 leading-normal  rounded-full flex items-center',
                    'bg-blue-500 text-white' => $site['status'] === 'deploying',
                    'bg-green-300 text-green-900' => $site['status'] === 'active',
                    'bg-red-600 text-red-100' => $site['status'] === 'deploy-failed',
                    'bg-gray-900 text-gray-200' => $site['status'] === 'suspended',
                    'bg-indigo-300 text-indigo-900' => $site['status'] === 'building',
                ])>
                    {{ $site['status'] }}
                </div>
            </div>
        @else
            <h1>{{  $id }}</h1>
            <div class="flex justify-end">
                @if(isset($site['message']))
                    {{ $site['message'] }}
                @else
                    Not initialized
                @endif
            </div>
        @endif


    </div>
</x-dashboard-tile>