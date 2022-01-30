<x-dashboard-tile :position="$position">
    @foreach($servers as $server)
        <div @class([
                'border-4  rounded-lg mb-4',
                // 'border-red-500' => $server['status'] === 'alert',
                // 'border-gray-200' => $server['status'] === 'nominal',

            ])
        >
            <h2 class="text-xl font-medium p-2">
                {{  $server }}
            </h2>
            {{-- <div class="grid grid-cols-4 gap-2 text-xs items-start">
                @if(!$server['metrics'])
                    <div class="col-span-4 p-2 pt-0">
                        No metrics available (yet)
                    </div>
                @else
                    @foreach($server['metrics'] as $metric => $value)
                        <div class="relative text-center bg-white rounded-lg relative bg-gray-100">
                            <div @class([
                                'absolute z-10 bottom-0 left-0 h-full rounded',
                                'bg-red-500' => in_array($metric, $server['alert_for']),
                                'bg-green-400' => !in_array($metric, $server['alert_for']),
                            ])
                                style="width: {{ round((float) $value) }}%">&nbsp;</div>
                            <div class="relative z-20 pt-1">
                                @if($metric === 'load_average')
                                    {{ $value }}
                                @else
                                    {{ $value }}%
                                @endif

                                @if($metric === 'cpu')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4" fill="#1e283b" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><rect x="100" y="100" width="56" height="56" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></rect><rect x="48" y="48" width="160" height="160" rx="8" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></rect><line x1="208" y1="104" x2="232" y2="104" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="208" y1="152" x2="232" y2="152" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="24" y1="104" x2="48" y2="104" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="24" y1="152" x2="48" y2="152" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="152" y1="208" x2="152" y2="232" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="104" y1="208" x2="104" y2="232" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="152" y1="24" x2="152" y2="48" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="104" y1="24" x2="104" y2="48" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
                                @elseif($metric === 'ram')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4" fill="#1e283b" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><line x1="128" y1="176" x2="128" y2="80" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M88,144a40,40,0,1,1-40,40v-6.7" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M168,144a40,40,0,1,0,40,40v-6.7" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M72,180H64A48,48,0,0,1,48,86.7V72a40,40,0,0,1,80,0V184" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M184,180h8a48,48,0,0,0,16-93.3V72a40,40,0,0,0-80,0" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M88,84v8a28,28,0,0,1-28,28" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M168,84v8a28,28,0,0,0,28,28" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                                @elseif($metric === 'disk')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4"  fill="#1e283b" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M216,91.3V208a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8H164.7a7.9,7.9,0,0,1,5.6,2.3l43.4,43.4A7.9,7.9,0,0,1,216,91.3Z" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M80,216V152a8,8,0,0,1,8-8h80a8,8,0,0,1,8,8v64" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><line x1="152" y1="72" x2="96" y2="72" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
                                @elseif($metric === 'load_average')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4" fill="#1e283b" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><rect x="56" y="56" width="40" height="144" rx="8" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></rect><rect x="160" y="56" width="40" height="144" rx="8" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></rect><path d="M200,80h24a8,8,0,0,1,8,8v80a8,8,0,0,1-8,8H200" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M56,176H32a8,8,0,0,1-8-8V88a8,8,0,0,1,8-8H56" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><line x1="96" y1="128" x2="160" y2="128" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="232" y1="128" x2="248" y2="128" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="8" y1="128" x2="24" y2="128" fill="none" stroke="#1e283b" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif



            </div> --}}

        </div>
    @endforeach
</x-dashboard-tile>
