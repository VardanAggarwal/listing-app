<div class="static my-5 px-6 py-4 rounded-lg shadow-lg border" x-data={open:false}>
    <div class="block mt-1 p-4 w-full border border-gray-200 text-gray-500 rounded" wire:click="$set('form',true)" x-on:click="open=!open">{{__("How can we help you today?")}}</div>
    <div class="bg-gray-900 opacity-80 fixed inset-0" x-show="open" x-on:click="open=!open">    </div>
    <div class="absolute border rounded p-4 bg-white top-10 inset-x-10 sm:inset-1/4" style="display: none;" x-init={open:false} x-show="open">
        <span class="text-xl">{{__("What help do you need?")}}</span>
        @if($form)
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
                @livewire('relationship-search',['type'=>'Resiliency'])
                <div class="mt-4 flex justify-center">
                    <x-jet-button type="submit" class="bg-green-400">{{__("Submit")}}</x-jet-button>
                </div>
            </form>
        @endif
        @if($interest_recorded)
            <div x-init="setTimeout(() => {open = false; $wire.interest_recorded=false;}, 2000)"x-on:click="open=false" class="text-green-700">{{__('ui.help.recorded_interest')}}</div>
        @endif
    </div>
</div>