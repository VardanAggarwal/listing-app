<div class="mt-5" x-data="{selected: @entangle('selected').defer, select:@entangle('select')}">
    <div class="px-4">
        <h1 class="text-2xl font-semibold text-black">Select items</h1>
        <div class=""><x-jet-input id="query" class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="query" type="text" name="query" autofocus /></div>
        <div class="mt-5"  wire:key="search_results">
            @error('item') <div class="error text-red">{{ $message }}</div> @enderror
            <div class="mt-4 grid grid-cols-2 gap-4">
                @foreach($results as $item)
                    <div wire:key="{{$loop->index}}" x-on:click="toggle(selected,{{$item->id}},select)" :class="selected.indexOf({{$item->id}})>=0?'rounded-xl border border-brown':''"><x-e2-e.card :item="$item" type="select"/></div>
                @endforeach
            </div>
        </div>
    </div>
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled" wire:click="submit">
            Continue
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
