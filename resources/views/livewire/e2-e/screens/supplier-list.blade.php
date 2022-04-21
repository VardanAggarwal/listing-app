<div class="">
    <x-e2-e.top-nav/>
    <div class="mt-4 px-4">
        <h1 class="text-2xl font-semibold text-black">{{__('e2e.suppliers.title.'.$trade->type,["name"=>$trade->item->name])}}</h1>
        <div class="mt-4 grid grid-cols-2 gap-4">
            @foreach($suppliers as $supplier)
                <a href="\e2e\trade\{{$supplier->id}}"><x-e2-e.card type="supplier" :item="$supplier"/></a>
            @endforeach
        </div>
    </div>
    @if($suppliers->hasMorePages())
        <x-e2-e.scroll/>
    @endif
    <div x-data="{allowed:@entangle('allowed'),show:false}">
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled" x-on:click="if(allowed){$wire.button_clicked();}else{show=true;}">
        {{__('e2e.suppliers.button_action.'.$button,["type"=>__('e2e.suppliers.button_type.'.$trade->type)])}}
    </button>
    <div class="z-10 fixed inset-0 grid place-items-center" x-show="show">
        <div class="bg-black opacity-50 fixed inset-0" x-on:click="show=false"></div>
        <div class="z-50 m-5 p-10 bg-white border border-brown rounded-xl grid justify-items-center gap-5 relative">
            <span class="absolute right-5 top-5" @click="show=false"><i class="fas fa-times text-xl text-red"></i></span>
            <span class="text-brown">{{__('e2e.actions.profile_completion.dialog')}}</span>
            <a href="/e2e/profile/edit"><button class="bg-brown text-white px-4 py-2 rounded-xl">{{__('e2e.actions.profile_completion.button')}}</button></a>
        </div>
    </div>
    </div>
</div>
