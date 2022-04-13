<div class="w-screen sm:max-w-3xl bg-green-50 relative">
    <div class="grid grid-cols-2 justify-between items-center">
        <h1 class="text-xl p-4">What's new</h1>
        <div class="grid justify-right pr-4">
            <span class="text-right">Last 30 days<i class="fas fa-caret-down"></i></span>
        </div>
    </div>
    <div class="grid gap-4 px-2 py-5">
            <div class="w-full p-4 flex gap-2 border rounded items-center bg-white shadow">
                <img src="https://via.placeholder.com/100.png" class="rounded-full w-12 h-12" />
                <div class="grid grow">
                    <span>Ashwagandha Roots</span>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Min: </span>
                            <span class="text-sm">200/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Avg: </span>
                            <span class="text-sm">250/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Max: </span>
                            <span class="text-sm">350/kg</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Supply: </span>
                            <span class="text-sm">25000 kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Demand: </span>
                            <span class="text-sm">35000 kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-4 flex gap-2 border rounded items-center bg-white shadow">
                <img src="https://via.placeholder.com/100.png" class="rounded-full w-12 h-12" />
                <div class="grid grow">
                    <span>Ashwagandha Roots</span>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Min: </span>
                            <span class="text-sm">200/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Avg: </span>
                            <span class="text-sm">250/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Max: </span>
                            <span class="text-sm">350/kg</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Supply: </span>
                            <span class="text-sm">25000 kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Demand: </span>
                            <span class="text-sm">35000 kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-4 flex gap-2 border rounded items-center bg-white shadow">
                <img src="https://via.placeholder.com/100.png" class="rounded-full w-12 h-12" />
                <div class="grid grow">
                    <span>Ashwagandha Roots</span>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Min: </span>
                            <span class="text-sm">200/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Avg: </span>
                            <span class="text-sm">250/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Max: </span>
                            <span class="text-sm">350/kg</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Supply: </span>
                            <span class="text-sm">25000 kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Demand: </span>
                            <span class="text-sm">35000 kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-4 flex gap-2 border rounded items-center bg-white shadow">
                <img src="https://via.placeholder.com/100.png" class="rounded-full w-12 h-12" />
                <div class="grid grow">
                    <span>Ashwagandha Roots</span>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Min: </span>
                            <span class="text-sm">200/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Avg: </span>
                            <span class="text-sm">250/kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Max: </span>
                            <span class="text-sm">350/kg</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="">
                            <span class="text-xs">Supply: </span>
                            <span class="text-sm">25000 kg</span>
                        </div>
                        <div class="">
                            <span class="text-xs">Demand: </span>
                            <span class="text-sm">35000 kg</span>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="h-20"></div>
    <div class="fixed w-screen sm:max-w-3xl bottom-20 border-t-8 border-green-50 flex flex-nowrap gap-0 justify-left overflow-auto bg-white">
      @foreach ($resiliencies as $resiliency)
        <div class="grid basis-14 justify-items-center shrink-0 p-2 {{$loop->index==0?'bg-green-50':''}}">
                @if($resiliency->image_url)
                    <img src="{{$resiliency->image_url}}" loading="lazy" class="h-10 w-10 rounded-full"/>
                @endif
            <span class="max-h-6 overflow-hidden leading-3 w-12 text-xs">{{$resiliency->name}}</span>
        </div>
      @endforeach
    </div>
</div>
