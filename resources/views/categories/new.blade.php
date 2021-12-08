<x-guest-layout>
    <div class="max-w-3xl mt-24 mx-auto">
              <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/categories">
            @csrf
            <h1 class="font-bold text-2xl mb-4">
                {{__('ui.new_f')}} {{__('ui.models.categories')}}
            </h1>
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
                <x-jet-button class="mt-4 mx-auto">
                    {{ __('Submit') }}
                </x-jet-button>
            </div>
        </form>
    </div>          
</x-guest-layout>