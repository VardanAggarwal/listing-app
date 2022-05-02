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
    <div class="h-20"></div>     
    <div x-data="{allowed:@entangle('allowed'),show:false}">
        <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled" x-on:click="if(allowed){$wire.button_clicked();}else{show=true;}">
            {{__('e2e.suppliers.button_action.'.$button,["type"=>__('e2e.suppliers.button_type.'.$trade->type)])}}
        </button>
        <livewire:e2-e.profile-check/>
    </div>
    <x-e2-e.loader/>
    <x-slot name="title">{{__('e2e.suppliers.title.'.$trade->type,['name'=>$trade->item->name])}}</x-slot>
    @push('meta')
    <meta property="og:title" content="{{__('e2e.suppliers.title.'.$trade->type,['name'=>$trade->item->name])}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="fb:app_id" content="852906262106769">
    <meta property="og:description" content="{{__('e2e.suppliers.title.'.$trade->type,['name'=>$trade->item->name])}}">
    <meta property="og:image" content="{{$trade->item->image_url}}">
    @endpush
</div>
