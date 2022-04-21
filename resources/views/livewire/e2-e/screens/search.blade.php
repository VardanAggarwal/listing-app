<div class="" x-data="{selected: @entangle('selected').defer, select:@entangle('select'),newItem:@entangle('newItem').defer}">
    <x-e2-e.top-nav/>
    <div class="mt-5 px-4">
        <h1 class="text-2xl font-semibold text-black">{{__('e2e.search.title.'.$action)}}</h1>
        <div class="mt-4"><x-jet-input id="query" class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="query" type="text" name="query" autofocus placeholder="{{__('e2e.search.placeholder')}}"/></div>
        <div class="mt-5"  wire:key="search_results">
            @error('item')
                <div x-init="window.scrollTo(0, 0)" class="error text-red">{{ $message }}</div> 
            @enderror
            <div class="mt-4 grid grid-cols-2 gap-4">
                @foreach($results as $item)
                    <div class="rounded-xl border" wire:key="{{$loop->index}}" x-on:click="toggle(selected,{{$item->id}},select)" :class="selected.indexOf({{$item->id}})>=0?'order-first border-brown':'border-white'"
                        ><x-e2-e.card :item="$item" type="select"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-e2-e.scroll/>
    <div>
        <span class="text-center grid justify-items-center text-brown mt-4 underline" @click="newItem=true">{{__('e2e.search.not_found')}}</span>
        <div x-cloak x-show="newItem" x-init="$watch('newItem',(value,oldValue)=>{if(value==false&&oldValue==true){window.scrollTo(0,0)}})">
            <div class="z-10 fixed inset-0 grid place-items-center" x-show="newItem">
                <div class="bg-black opacity-50 fixed inset-0" x-on:click="newItem=false"></div>
                <div class="z-50 bg-white border border-brown rounded-xl justify-items-center gap-5 relative">
                    <span class="absolute right-5 top-5" @click="newItem=false"><i class="fas fa-times text-xl text-red"></i></span>
                    @livewire('e2-e.new-item',['type'=>$type,'name'=>$query])
                </div>
            </div>
        </div>
    </div>
    <div class="h-20"></div>
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled" wire:click="submit">
            {{__('e2e.search.button')}}
        </button>
    <script type="text/javascript">
        function toggle(array,value,type){
            var index = array.indexOf(value);
            if (index == -1) {
                if(type=="multiple"){
                    array.push(value);
                }else{
                    array[0]=value;
                }
            } 
            else {
                do {
                    array.splice(index, 1);
                    index = array.indexOf(value);
                    } while (index != -1);
            }
        }
    </script>
</div>
