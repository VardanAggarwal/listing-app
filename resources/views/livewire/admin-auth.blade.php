<div x-data="{phone:@entangle('show_phone'),code:@entangle('code'),show_profile:@entangle('show_profile')}">
  <x-jet-authentication-card>
      <x-slot name="logo">
          <x-jet-authentication-card-logo />
      </x-slot>
      <x-jet-validation-errors/>
      <div x-show="phone"  x-init="{phone:@entangle('show_phone')}">
        <div>
            <x-jet-label for="phone_number" value="{{ __('ui.contact_number') }}" />
            <div class="flex items-center">
              <span class="text-lg mr-2">+91</span>
              <x-jet-input id="phone_number" class="block mt-1 w-full" wire:model="phone_number" type="text" name="phone_number" maxlength="10" required autofocus />
            </div>
        </div>
        <div class="mt-4">
            <x-jet-input id="expert" class="" type="checkbox" name="expert" wire:model="is_expert" autofocus/>{{ __('ui.expert.form.onboarding') }}
        </div>
        <div wire:ignore class="flex justify-center pb-2 mt-4">
            <x-jet-button id="sign-in-button" wire:click="sign_in">
                {{ __('Log in') }}
            </x-jet-button>
        </div>
      </div>
      <div style="display: none;" x-show="show_profile"  x-init="{show_profile:@entangle('show_profile')}">
        <h1>{{__('ui.welcome')}}</h1>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('ui.name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="profile.name" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="address" value="{{ __('ui.address') }}" />
            <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model="profile.address" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="pincode" value="{{ __('ui.pincode') }}" />
            <x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" wire:model="profile.pincode" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-input id="expert" class="" type="checkbox" name="expert" wire:model="is_expert" autofocus/>{{ __('ui.expert.form.onboarding') }}
        </div>
        
        <div class="flex justify-center pb-2 mt-4">
            <x-jet-button wire:click="profile_submit" x-on:click="mixpanel.track('Profile Submitted',{'Phone Number':'{{'+91'.$phone_number}}'});         mixpanel.register({'Phone Number': '{{'+91'.$phone_number}}'});">
              {{ __('ui.onboarding_submit') }}
            </x-jet-button>
        </div>
      </div>
  </x-jet-authentication-card>
</div>