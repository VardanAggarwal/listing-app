<div wire:loading.class="opacity-75" class="w-screen sm:max-w-3xl bg-green-50 relative">
    <div class="grid grid-cols-2 justify-between items-center">
        <h1 class="text-xl p-4">{{$selected_resiliency->name}}</h1>
        <div class="grid justify-right pr-4">
            <span class="text-right">Last 30 days<i class="fas fa-caret-down"></i></span>
        </div>
    </div>
    <div class="grid gap-4 px-2 py-5">
        @foreach($selected_resiliency->items as $item)
        @if(in_array($item->type,['produce','processed_material']))
        <div class="w-full p-4 flex gap-2 border rounded items-center bg-white shadow">
            <img src="{{$item->image_url}}" class="rounded-full w-12 h-12" />
            <div class="grid grow">
                <span>{{$item->name}} - {{$item->type}}</span>
                <div class="flex justify-between">
                    <div class="">
                        <span class="text-xs">Min: </span>
                        <span class="text-sm">{{$item->trades->where('created_at','>',now()->subDays(30))->min('price')}}/kg</span>
                    </div>
                    <div class="">
                        <span class="text-xs">Avg: </span>
                        <span class="text-sm">{{$item->trades->where('created_at','>',now()->subDays(30))->avg('price')}}/kg</span>
                    </div>
                    <div class="">
                        <span class="text-xs">Max: </span>
                        <span class="text-sm">{{$item->trades->where('created_at','>',now()->subDays(30))->max('price')}}/kg</span>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="">
                        <span class="text-xs">Supply: </span>
                        <span class="text-sm">{{$item->trades->where('created_at','>',now()->subDays(30))->filter(function($value,$key){return $value->type=='sell';})->sum('quantity')}} kg</span>
                    </div>
                    <div class="">
                        <span class="text-xs">Demand: </span>
                        <span class="text-sm">{{$item->trades->where('created_at','>',now()->subDays(30))->filter(function($value,$key){return $value->type=='buy';})->sum('quantity')}} kg</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <div class="h-20"></div>
    <div class=" w-screen sm:max-w-3xl bottom-20 border-t-8 border-green-50 flex flex-nowrap gap-0 justify-left overflow-auto bg-white">
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
