<div class="static my-5" x-data="{open:false,other:false}">
    <div class="p-5 sm:pl-10 rounded-full shadow-md border border-gray-200 bg-gray-100 text-gray-500 rounded" x-on:click="open=!open,other=false" wire:click="resetErrors">{{__("ui.statement.placeholder")}}</div>
    <div class="bg-gray-900 opacity-80 fixed inset-0" x-show="open" x-on:click="open=!open">    </div>
    <div class="fixed overflow-auto border rounded p-4 bg-white inset-10 sm:inset-1/4" style="display: none;" x-init={open:false,other:false} x-show="open">
        <x-jet-validation-errors class="mb-4" />
        <span x-on:click="open=false" class="absolute right-2 top-2 text-red-500"><i class="fas fa-times"></i></span>
        <form wire:submit.prevent="save_statement">
            @csrf
            <div class="mt-4">
                <x-tinymce wire:model="statement" placeholder="{{__('ui.statement.placeholder')}}" />
            </div>
            <div class="mt-4">
                <input type="file" name="media" wire:model="media" multiple>
                @error('media.*') <span class="error">{{ $message }}</span> @enderror
                @if ($media)
                    <div class="flex mt-4">
                        @foreach ($media as $key=>$photo)
                            <img src="{{ $photo->temporaryUrl() }}" width="100px" class="mx-2" wire:click="removePhoto({{$key}})">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="mt-4 flex justify-center">
                <x-jet-button type="button" class="bg-green-400" x-on:click="other=true" x-show="!other">{{__("Continue")}}</x-jet-button>
            </div>
            <div style="display: none;" x-show="other">
                @livewire('relationship-search',['type'=>'Resiliency'])
                <div class="mt-4 flex justify-center">
                    <x-jet-button type="submit" class="bg-green-400">{{__("Submit")}}</x-jet-button>
                </div>
            </div>
        </form>
        @if($saved)
            <div x-init="setTimeout(() => {open = false; $wire.saved=false;}, 2000)"x-on:click="open=false" class="text-green-700">{{__('ui.statement.saved')}}</div>
        @endif
    </div>
    @once
        @push('scripts')
            <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
             <script>
             </script>
        @endpush
    @endonce
</div>
