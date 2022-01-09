<div class="static my-5 px-6 py-4 rounded-lg shadow-lg border">
    <div class="block mt-1 p-4 w-full border border-gray-200 text-gray-500 rounded" wire:click="showForm">{{__("How can we help you today?")}}</div>
    @if($form)
        <div class="absolute border rounded p-4 bg-white inset-x-4 sm:inset-x-auto">
            <form wire:submit.prevent="save_interest">
                @csrf
                <div class="block mt-4">
                    <label for="input" class="">
                        <x-jet-checkbox id="input" name="interest" wire:model="interest" value="input"/>
                        <span class="ml-2 text-sm text-gray-600">{{ __('ui.help.input') }}</span>
                    </label>
                </div>
                <div class="block mt-4">
                    <label for="market" class="">
                        <x-jet-checkbox id="market" name="interest" wire:model="interest" value="market"/>
                        <span class="ml-2 text-sm text-gray-600">{{ __('ui.help.market') }}</span>
                    </label>
                </div>
                <div class="block mt-4">
                    <label for="training" class="">
                        <x-jet-checkbox id="training" name="interest" wire:model="interest" value="training"/>
                        <span class="ml-2 text-sm text-gray-600">{{ __('ui.help.training') }}</span>
                    </label>
                </div>
                <div  x-data={others:false}>
                    <div class="block mt-4">
                        <label for="others" class="">
                            <x-jet-checkbox id="others" name="interest"  x-on:click="others=!others" wire:model="interest" value="others"/>
                            <span class="ml-2 text-sm text-gray-600">{{ __('ui.help.others') }}</span>
                        </label>
                    </div>
                    <div class="mt-4"x-show="others">
                        <x-jet-label for="others"/>
                        <x-jet-input id="others" class="block mt-1 w-full" name="interest" wire:model="others" type="text" placeholder="{{ __('ui.help.others_placeholder') }}"/>
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="resiliencies" value="{{__('ui.models.resiliencies')}}"/>
                    <div class="flex flex-wrap my-2 gap-2 overflow-auto max-h-40">
                        @foreach($resiliencies as $result)
                            <div class="p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                                {{$result->name}}
                            </div>
                        @endforeach
                    </div>
                    <x-jet-input type="text" placeholder="{{__('Type to search')}}" name="resiliencies" wire:model="search_resiliency" class="w-full"/>
                    @if($results)
                    <div class="flex flex-wrap mt-5 gap-2 overflow-auto max-h-40">
                        @foreach($results as $result)
                            <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                                {{$result->name}}
                            </div>
                        @endforeach
                        @if($this->search_resiliency && !$this->results->contains('name',$this->search_resiliency))
                            <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border" wire:click="newResiliency">
                                {{$this->search_resiliency}}+
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="mt-4 flex justify-center">
                    <x-jet-button type="submit" class="bg-green-400">{{__("Submit")}}</x-jet-button>
                </div>
            </form>
        </div>
    @endif
</div>