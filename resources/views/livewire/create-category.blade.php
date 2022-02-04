<div class="max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />
    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-0">
          {{__('ui.new_f')}} {{__('category')}}
        </h1>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="category.name" autofocus/>
        </div>
        @livewire('relationship-search',['type'=>'Resiliency','selected'=>$selected])
        <x-jet-validation-errors class="mb-4" />
        <div class="grid w-full mt-4 justify-items-center" wire:loading.class="opacity-20" wire:target="save">
            <x-jet-button class="max-w-md justify-center" type="submit">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
    </form>
</div>