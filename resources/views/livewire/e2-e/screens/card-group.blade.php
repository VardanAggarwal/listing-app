<div class="px-4 mt-5" wire:loading.class="opacity-75" x-data="{dates:false}">
    <div class="flex w-full justify-between">
        <h1 class="font-semibold text-2xl text-black">{{__('e2e.card-group.'.$role.'.'.$action)}}</h1>
        <div class="flex items-center gap-1">
            <span class="text-xs text-blue">{{__('e2e.card-group.date_label')}}</span>
            <div class="relative cursor-pointer" @click="dates=!dates">
                <span class="px-2 py-1 flex gap-1 items-center text-xs border border-brown rounded text-brown">{{__('e2e.card-group.last',["days"=>__('e2e.card-group.days.'.$days)])}}<i class="fas text-lg fa-caret-down text-primary"></i></span>
                <div class="bg-white border-brown border shadow rounded p-4 text-black absolute grid z-50 w-full text-xs gap-2" x-show="dates">
                    <span wire:click="$set('days',7)">{{__('e2e.card-group.days.7')}}</span>
                    <span wire:click="$set('days',30)">{{__('e2e.card-group.days.30')}}</span>
                    <span wire:click="$set('days',90)">{{__('e2e.card-group.days.90')}}</span>
                    <span wire:click="$set('days',180)">{{__('e2e.card-group.days.180')}}</span>
                    <span wire:click="$set('days',365)">{{__('e2e.card-group.days.365')}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        @foreach($items as $item)
            <x-e2-e.card :type="$type" :item="$item"/>
        @endforeach
    </div>
    <x-e2-e.scroll/>
    <div class="grid justify-items-center"><button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" wire:loading.attr="disabled">
            List items
        </button></div>
</div>