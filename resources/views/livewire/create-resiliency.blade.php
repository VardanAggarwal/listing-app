<div class="py-8 max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-4">
          @if($type=='Agrimodel')
          {{__('ui.new_m')}} {{trans_choice('ui.models.agrimodels',1)}}
          @else
          {{__('ui.new_f')}} {{trans_choice('ui.models.'.$type.'s',1)}}
          @endif
        </h1>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="resiliency.name" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-jet-input id="description" class="block mt-1 w-full" type="text" name="description" wire:model="resiliency.description" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="links" value="{{ __('Link') }}" />
            <x-jet-input id="links" class="block mt-1 w-full" type="text" name="links" wire:model="resiliency.links" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" autofocus/>
            @if($image)
                <img src="{{$image->temporaryUrl()}}">
            @endif
        </div>
        <div class="grid w-full mt-4 justify-items-center">
            <x-jet-button class="max-w-md justify-center" type="submit">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
    </form>

</div>