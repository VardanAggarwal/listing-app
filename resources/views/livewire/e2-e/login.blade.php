<div class="grid">
  <div>@livewire('e2-e.language')</div>
  <div class="grid justify-items-center p-4 my-10">
      <x-jet-application-logo  class="w-24 h-24"/>
      <h1 class="text-2xl font-semibold text-black">Let's get started</h1>
      <span class="text-lg text-center text-brown italic">You are joining as <a href="/e2e/role/?selected={{$role}}" class="text-blue underline">{{__('e2e.roles.'.$role.'.label')}}</a></span>
  </div>
  <div class="px-4">
    <x-jet-label for="phone_number" value="{{__('e2e.login.phone_number_label')}}" class="text-black font-semibold text-xl" />
    <div class="flex items-center">
      <span class="text-brown rounded-xl p-1 text-lg mr-2">+91</span>
      <x-jet-input id="phone_number" class="block rounded-xl border-brown w-full bg-white" wire:model="phone_number" type="text" name="phone_number" maxlength="10" required autofocus />
    </div>
    <x-jet-validation-errors/>
    <div wire:ignore class="flex justify-center pb-2 mt-4">
        <button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" id="sign-in-button" wire:loading.attr="disabled" wire:click="sign_in">
            {{__('e2e.login.button')}}
        </button>
    </div>
  </div>
</div>
