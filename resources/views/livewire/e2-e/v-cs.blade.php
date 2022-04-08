<div class="mt-4" x-data="{selected: @entangle('selected').defer}">
    <h1 class="text-2xl my-4">{{__('e2e.vc_selection.title')}}</h1>
    <x-jet-input type="text" placeholder="{{__('e2e.vc_selection.search')}}" wire:model="query" wire:keydown.enter="resetPage" class="w-full"></x-jet-input>
    <div class="mt-4 grid grid-cols-3 sm:grid-cols-6 gap-4">
          @foreach ($results as $resiliency)
            <div class="w-24 border grid justify-items-center rounded-lg"  x-on:click="toggle(selected,{{$resiliency->id}})" :class="selected.indexOf({{$resiliency->id}})>=0?'bg-green-400':''">
                @if($resiliency['image_url'])
                    <img src="{{$resiliency['image_url']}}" loading="lazy" class="rounded-t-lg object-cover h-24 w-24"/>
                @endif
                <span class="m-2">{{$resiliency['name']}}</span>
            </div>
          @endforeach
    </div>

    <div class="my-4">
      {{__('e2e.vc_selection.selected')}} <span x-text="selected.length"></span>
      <x-jet-validation-errors/>
    </div>
    <div class="py-2 bg-white border-t flex justify-center fixed sm:static inset-x-0 bottom-0 sm:inset-auto sm:bottom-auto">
        <x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="submit">Continue</x-jet-button>
    </div>
    <div class="h-12"></div>
    <script type="text/javascript">
        function toggle(array,value){
            var index = array.indexOf(value);
            if (index == -1) {
                array.push(value);
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