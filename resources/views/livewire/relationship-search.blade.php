<div class="mt-4">
    <x-jet-label for="model" value="{{__('What is this related to?')}}"/>
    <div class="flex flex-wrap my-2 gap-2 overflow-auto max-h-40">
        @foreach($models as $result)
            <div class="p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                @unless($type=="Story")
                    {{$result->name}}
                @else
                    {{$result->title}}
                @endunless
            </div>
        @endforeach
    </div>
    <x-jet-input type="text" placeholder="{{__('Type to search')}}" name="model" wire:model="search_model" class="w-full"/>
    @if($results)
    <div class="flex flex-wrap mt-5 gap-2 overflow-auto max-h-40">
        @foreach($results as $result)
            <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                @unless($type=="Story")
                    {{$result->name}}
                @else
                    {{$result->title}}
                @endunless
            </div>
        @endforeach
        @if($this->search_model && !($this->results->contains('name',$this->search_model)||$this->results->contains('title',$this->search_model)))
            <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border" wire:click="newModel">
                {{$this->search_model}}+
            </div>
        @endif
    </div>
    @endif
</div>