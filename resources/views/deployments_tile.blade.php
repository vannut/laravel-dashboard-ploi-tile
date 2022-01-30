<x-dashboard-tile :position="$position">
    <div class="flex flex-wrap text-xs">
        @foreach($sites as $key => $site)
            @if(isset($site['error']))
                <div class="rounded-full mb-2 mr-2 py-1 px-2 inline-flex items-center line-through bg-gray-200">{{ $key }}</div>
            @else
                <div @class([
                    'rounded-full mb-2 mr-2 p-1 inline-flex items-center',
                    'bg-indigo-200 animate-pulse' => $site['status'] === 'building',
                    'bg-blue-100 animate-pulse' => $site['status'] === 'deploying',
                    'bg-green-100' => $site['status'] === 'active',
                    'bg-red-200' => $site['status'] === 'deploy-failed',
                    'bg-gray-200' => $site['status'] === 'suspended',

                ])>
                    <span class="pl-2">
                        {{  $site['domain'] }}
                    </span>

                    <span @class([
                            'uppercase text-xs ml-2 px-2 py-1  rounded-full',
                            'bg-blue-500 text-white' => $site['status'] === 'deploying',
                            'bg-green-300 text-green-900' => $site['status'] === 'active',
                            'bg-red-600 text-red-100' => $site['status'] === 'deploy-failed',
                            'bg-gray-900 text-gray-200' => $site['status'] === 'suspended',
                            'bg-indigo-300 text-indigo-900' => $site['status'] === 'building',
                        ])>
                        {{ $site['status'] }}
                    </span>
                </div>
            @endif
        @endforeach
    </div>
</x-dashboard-tile>