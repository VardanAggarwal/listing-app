<div class="px-4">
    <div class="grid gap-4 grid-cols-4">
        <div class="col-span-1 relative">
            <input class="rounded-xl border-brown w-full bg-white" wire:model="item_name" type="text" placeholder="{{__('e2e.price.add.item_placeholder')}}"/>
            @if(isset($items))
                <div class="absolute rounded-xl grid border-brown bg-white p-4 z-10">
                    @foreach($items as $item)
                        <span class="cursor-pointer" wire:click="setItem({{$item}})">{{$item->name}}</span>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="col-span-1">
            <input class="rounded-xl border-brown w-full bg-white" wire:model="price_min" type="text" placeholder="{{__('e2e.price.add.price_min_placeholder')}}"/>
        </div>
        <div class="col-span-1">
            <input class="rounded-xl border-brown w-full bg-white" wire:model="price_max" type="text" placeholder="{{__('e2e.price.add.price_max_placeholder')}}"/>
        </div>
        <div class="col-span-1">
            <input class="rounded-xl border-brown w-full bg-white" wire:model="price_avg" type="text" placeholder="{{__('e2e.price.add.price_avg_placeholder')}}"/>
        </div>
    </div>
</div>