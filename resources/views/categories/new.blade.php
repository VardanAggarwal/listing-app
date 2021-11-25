<x-guest-layout>
    <div class="max-w-3xl mt-24 mx-auto">
              <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/categories">
            @csrf
            <h1 class="font-bold text-2xl mb-4">
              {{__('Add Category')}}
            </h1>
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text-area" name="description"></textarea>
            </div>
            <div class="mt-4">
                <x-jet-label for="links" value="{{ __('Link') }}" />
                <x-jet-input id="links" class="block mt-1 w-full" type="text" name="links" :value="old('links')"  />
            </div>


                <x-jet-button class="mt-4 mx-auto">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </div>          
</x-guest-layout>