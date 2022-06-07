<div>
    <x-e2-e.top-nav/>
    <div class="mt-4 px-4">
        <h1 class="text-2xl font-semibold text-black">{{__('e2e.price.add.title')}}</h1>
        <div class="mt-4">
          <x-jet-label for="market" value="{{__('e2e.price.market')}}" class="text-brown font-semibold text-xl" />
          <div class="flex items-center">
            <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model.defer="market" type="text" placeholder="{{__('e2e.price.add.market_placeholder')}}"/>
          </div>
        </div>
    </div>
    @foreach($prices as $key=>$price)
        <div class="flex items-center mt-4">
            @livewire('e2-e.price-item',['index'=>$key],key($loop->index))
            <span class="cursor-pointer" wire:click="addRow"><i class="fas fa-plus"></i></span>
        </div>
    @endforeach
    <div class="mt-4 grid justify-items-center">
        <button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl " wire:click="submit">Submit</button>
    </div>
</div>
