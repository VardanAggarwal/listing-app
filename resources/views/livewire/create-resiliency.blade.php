<div class="max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-0">
          {{__('ui.new_f')}} {{__('ui.models.resiliencies')}}
        </h1>
        <span class="text-sm text-gray-500">{{__('ui.labels.resiliency_subtitle')}}</span>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('ui.labels.resiliency_name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="{{ __('ui.placeholders.resiliency_name') }}" wire:model="resiliency.name" autofocus/>
        </div>
        @if(Auth::user()->role_id==1)
            <div class="mt-4">
                <x-jet-label for="other_name" value="Other names" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="other_name" wire:model="other_names"/>
            </div>
        @endif
        <div class="mt-4">
            <x-jet-label for="type" value="{{__('Type')}}"/>
            <select wire:model="resiliency.type">
                <option value="crop">{{__('crop')}}</option>
                <option value="agribusiness">{{__('agribusiness')}}</option>
                <option value="model">{{__('model')}}</option>
                <option value="practice">{{__('practice')}}</option>
            </select>
        </div>
        <div class="mt-4" wire:ignore>
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-tinymce wire:model="resiliency.description" placeholder="{{ __('ui.placeholders.resiliency_description') }}" />
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" autofocus/>
            @if($image)
                <img class="h-24" src="{{$image->temporaryUrl()}}">
            @elseif($resiliency->image_url)
                <img class="h-24" src="{{$resiliency->image_url}}">
            @endif
        </div>
        @livewire('relationship-search',['type'=>'Category','selected'=>$selected])
        <x-jet-validation-errors class="mb-4" />
        <div class="grid w-full mt-4 justify-items-center" wire:loading.class="opacity-20" wire:target="save">
            <x-jet-button class="max-w-md justify-center" type="submit">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
    </form>
</div>