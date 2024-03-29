<div class="px-4 mt-5" x-data="{dates:false,allowed:@entangle('allowed'),show:false}">
    <div class="flex w-full justify-between">
        <h1 class="font-semibold text-2xl text-black">{{__('e2e.card-group.heading.'.$role.'.'.$action)}}</h1>
        <div class="relative cursor-pointer" @click="dates=!dates">
            <span class="px-2 py-1 flex gap-1 items-center text-xs border border-brown rounded text-brown">{{__('e2e.card-group.last',["days"=>__('e2e.card-group.days.'.$days)])}}<i class="fas text-lg fa-caret-down text-primary"></i></span>
            <div class="bg-white border-brown border shadow rounded p-4 text-black absolute grid z-50 w-full text-xs gap-2" x-cloak x-show="dates">
                <span wire:click="$set('days',7)">{{__('e2e.card-group.days.7')}}</span>
                <span wire:click="$set('days',30)">{{__('e2e.card-group.days.30')}}</span>
                <span wire:click="$set('days',90)">{{__('e2e.card-group.days.90')}}</span>
                <span wire:click="$set('days',180)">{{__('e2e.card-group.days.180')}}</span>
                <span wire:click="$set('days',365)">{{__('e2e.card-group.days.365')}}</span>
            </div>
        </div>
    </div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        @foreach($items as $item)
            <div x-data="{click:false}" @click="click=!click" class="relative">
                <x-e2-e.card :type="$type" :action="$action" :item="$item"/>
                <div x-show="click" x-cloak class="absolute inset-0 rounded-xl inset-0">
                    <div x-on:click="click=false" class="bg-black w-full h-full opacity-75 rounded-xl"></div>
                    <div class="absolute inset-0 flex flex-col p-5 gap-5 justify-center place-items-center">
                        @unless($role=='input_provider')
                        <button class="px-4 py-2 rounded-xl bg-blue text-white" wire:click="supplierClicked('{{$type}}','{{$item->id}}')">{{__('e2e.card-group.click.suppliers.'.$action)}}</button>
                        @endunless
                        <button class="px-4 py-2 rounded-xl {{$action=='buy'?'bg-primary text-black':'bg-red text-white'}}" wire:click="actionClicked('{{$type}}','{{$item->id}}')">{{__('e2e.card-group.click.'.$role.'.'.$action,["name"=>$item->name])}}</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($items->hasMorePages())
        <x-e2-e.scroll/>
    @endif
    <div class="grid justify-items-center mt-4">
        <button x-on:click="if(allowed){window.location.href='/e2e/bid-select/multiple/{{$item_type}}/{{$action}}';}else{show=true;}" class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl" wire:loading.attr="disabled">
            {{__('e2e.card-group.button.'.$role.'.'.$action)}}
        </button>
        <livewire:e2-e.profile-check/>
    </div>
    <div class="h-20"></div>
    <x-e2-e.loader/>
</div>