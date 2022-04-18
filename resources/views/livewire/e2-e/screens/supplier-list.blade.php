<div class="mt-4">
    <div class="px-4">
        <h1 class="text-2xl font-semibold text-black">{{$trade->type=="sell"?"Buyers":"Suppliers"}} for {{$trade->item->name}}</h1>
        <div class="mt-4 grid grid-cols-2 gap-4">
            @foreach($suppliers as $supplier)
                <x-e2-e.card type="supplier" :item="$supplier"/>
            @endforeach
        </div>
    </div>
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
            Add new {{$trade->type=="sell"?"Supply":"Demand"}}
        </button>
</div>
