<div>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors/>
    <div>
        <div class="grid justify-items-center">
          <h1 class="text-3xl">{{__('e2e.global.app_name')}}</h1>
          <span class="text-lg text-gray-500 mb-4">{{__('e2e.global.app_tagline')}}</span>
          <span class="text-lg text-gray-800 mb-4">{{__('e2e.global.app_description')}}</span>
        </div>
          <x-jet-label for="phone_number" value="{{__('e2e.login.phone_number_label')}}" />
          <div class="flex items-center">
            <span class="text-lg mr-2">+91</span>
            <x-jet-input id="phone_number" class="block mt-1 w-full" wire:model="phone_number" type="text" name="phone_number" maxlength="10" required autofocus />
          </div>
      </div>
      <div wire:ignore class="flex justify-center pb-2 mt-4">
          <x-jet-button id="sign-in-button" wire:loading.attr="disabled" wire:click="sign_in">
              {{__('e2e.login.button')}}
          </x-jet-button>
    </div>
    </x-jet-authentication-card>
</div>
