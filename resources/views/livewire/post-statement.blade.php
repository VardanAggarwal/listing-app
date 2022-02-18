<div class="static {{$view=='card'?'':'my-4'}}" x-data="{open:false,other:false}">
    @if($view=='card')
    <span x-on:click="open=!open,other=false" wire:click="resetForm"> {{$parent->statements->count()}} <i class="far fa-comment"></i></span>
    @else
    <div class="p-5 sm:pl-10 rounded-full shadow-md border border-gray-200 bg-gray-100 text-gray-500 rounded" x-on:click="open=!open,other=false" wire:click="resetForm">
        @if($view=='reply')
            {{__("ui.statement.reply")}}
        @else
            {{__("ui.statement.placeholder")}}
        @endif
    </div>
    @endif
    <div class="bg-gray-900 opacity-80 fixed inset-0" x-show="open" style="display: none;" x-on:click="open=!open">    </div>
    <div class="fixed max-w-full overflow-auto z-50 border rounded p-4 bg-white inset-10 inset-20" style="display: none;" x-init={open:false,other:false} x-show="open">
        <x-jet-validation-errors class="mb-4" />
        <span x-on:click="open=false" class="absolute right-2 top-2 text-red-500"><i class="fas fa-times"></i></span>
        @if($form)
        <form wire:submit.prevent="save_statement">
            @csrf
            <div class="mt-4">
                <x-tinymce wire:model="statement" placeholder="{{$view=='reply'?__('ui.statement.reply'):__('ui.statement.placeholder')}}" />
            </div>
            <div class="mt-4">
                <input type="file" name="media" wire:model="media" multiple>
                @error('media') <div class="error text-red-500">{{ $message }}</div> @enderror
                @if ($media)
                    <div class="flex mt-4">
                        @foreach ($media as $key=>$file)
                            @if(str_contains($file->getMimeType(),"image"))
                            <img src="{{ $file->temporaryUrl() }}" width="100px" class="mx-2" wire:click="removeFile({{$key}})">
                            @endif
                            @if(str_contains($file->getMimeType(),"video"))
                            <video src="{{ $file->temporaryUrl() }}" width="100px" class="mx-2" wire:click="removeFile({{$key}})">
                            @endif
                            @if(str_contains($file->getMimeType(),"audio"))
                            <a class="underline mx-2" wire:click="removeFile({{$key}})">{{$file->getClientOriginalName()}}</a>
                            @endif
                            @if(str_contains($file->getMimeType(),"pdf"))
                            <a class="underline mx-2" wire:click="removeFile({{$key}})">{{$file->getClientOriginalName()}}</a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="mt-4 flex justify-center">
                <x-jet-button type="button" class="bg-green-400" x-on:click="other=true" x-show="!other">{{__("Continue")}}</x-jet-button>
            </div>
            @if($form)
            <div style="display: none;" x-show="other">
                @livewire('relationship-search',['type'=>'Resiliency'])
                <x-jet-validation-errors class="mb-4" />
                <div class="mt-4 flex justify-center">
                    <x-jet-button type="submit" class="bg-green-400">{{__("Submit")}}</x-jet-button>
                </div>
            </div>
            @endif
        </form>
        @endif
        @if($saved)
            <div class="w-full h-full grid place-items-center">
            <div x-init="setTimeout(() => {open = false; $wire.saved=false;$wire.form=true;}, 1000)" x-on:click="open=false" class="text-green-700">{{__('ui.statement.saved')}}</div>
            </div>
        @endif
    </div>
</div>
