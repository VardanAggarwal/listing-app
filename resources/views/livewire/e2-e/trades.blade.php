<div wire:loading.class="opacity-75" class="w-screen sm:max-w-3xl bg-green-50 relative">
    <div class="grid grid-cols-2 justify-between items-center">
        <h1 class="text-xl p-4">{{$selected_resiliency->name}}</h1>
        <div class="grid justify-right pr-4">
            <span class="text-right">Last 30 days<i class="fas fa-caret-down"></i></span>
        </div>
    </div>
    <div class="grid gap-4 px-2 py-5">
        @foreach($selected_resiliency->items as $item)
        <div class="bg-white">
            <div class="grid grid-cols-2 items-center">
                <h1 class="text-lg p-4">{{$item->name}}</h1>
                <div class="float-right grid grid-cols-2 justify-right pr-4">
                    <div class=""><span class="float-right bg-green-500 p-2 text-xs text-center">Follow</span></div>
                    <span class="text-right">Buy/Sell<i class="fas fa-caret-down"></i></span>
                </div>
            </div>
            @foreach($item->trades->where('created_at','>',now()->subDays(30)) as $trade)
            <div class="w-full p-4 flex gap-2 border rounded items-center bg-white shadow">
                <img src="{{$trade->image_url}}" class="rounded-full w-12 h-12" />
                <div class="grid grow">
                    <span>{{$trade->profile->name}} - {{$trade->profile->address}}</span>
                    <span>Price:{{$trade->price}}/kg</span>
                    <span>Quantity:{{$trade->quantity}} kg</span>
                </div>
                <div class="{{$trade->type=='buy'?'bg-red-500':'bg-green-500'}} text-white font-bold rounded-lg py-2 px-4">{{$trade->type=='buy'?'Sell':'Buy'}}</div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    <div class="h-20"></div>
    <div class="fixed w-screen sm:max-w-3xl bottom-20 border-t-8 border-green-50 flex flex-nowrap gap-0 justify-left overflow-auto bg-white">
      @foreach ($resiliencies as $resiliency)
        <div class="grid basis-14 justify-items-center shrink-0 p-2 {{$selected_resiliency->id==$resiliency->id?'bg-green-50':''}}" wire:click="select({{$resiliency->id}})">
                @if($resiliency->image_url)
                    <img src="{{$resiliency->image_url}}" loading="lazy" class="h-10 w-10 rounded-full"/>
                @endif
            <span class="max-h-6 overflow-hidden leading-3 w-12 text-xs">{{$resiliency->name}}</span>
        </div>
      @endforeach
    </div>
</div>
