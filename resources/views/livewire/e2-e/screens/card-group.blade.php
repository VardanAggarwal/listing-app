<div class="px-4 mt-5" wire:loading.class="opacity-75">
    <div class="flex w-full justify-between"><h1 class="font-semibold text-2xl text-black">{{ucwords($screen)}}</h1><span class="px-2 py-1 flex gap-1 items-center text-xs border border-brown rounded text-brown">Last 30 days <i class="fas text-lg fa-caret-down text-primary"></i></span></div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        @foreach($items as $item)
            <x-e2-e.card :type="$type" :item="$item"/>
        @endforeach
    </div>
    <div class="grid justify-items-center"><button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" wire:loading.attr="disabled">
            List items
        </button></div>
</div>