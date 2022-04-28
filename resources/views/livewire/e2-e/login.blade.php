<div class="grid">
  <div>@livewire('e2-e.language')</div>
  @if($screen=="number")
    <div class="grid justify-items-center p-4 my-10">
        <x-jet-application-logo  class="w-24 h-24"/>
        <h1 class="text-2xl font-semibold text-black">{{__('e2e.login.title')}}</h1>
        <span class="text-lg text-center text-brown italic">{{__('e2e.role_selection.selected_roles')}} <a href="/e2e/role/?selected={{$role}}" class="text-blue underline">{{__('e2e.roles.'.$role.'.label')}}</a></span>
    </div>
    <div class="px-4">
      <x-jet-label for="phone_number" value="{{__('e2e.login.phone_number_label')}}" class="text-black font-semibold text-xl" />
      <div class="flex items-center">
        <span class="text-brown rounded-xl p-1 text-lg mr-2">+91</span>
        <x-jet-input id="phone_number" class="block rounded-xl border-brown w-full bg-white" wire:model.defer="phone_number" type="text" name="phone_number" maxlength="10" required autofocus />
      </div>
      <div class="text-red mt-4">
        <x-jet-validation-errors/>
      </div>
      <div class="flex justify-center pb-2 mt-4">
          <button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" id="sign-in-button" wire:loading.attr="disabled" wire:click="send_otp">
              {{__('e2e.login.button')}}
          </button>
      </div>
    </div>
  @elseif($screen=="OTP")
    <div class="grid justify-items-center p-4 my-10">
        <x-jet-application-logo  class="w-24 h-24"/>
        <h1 class="text-2xl font-semibold text-black">{{__('e2e.login.otp_title')}}</h1>
        <span class="text-lg text-center text-brown italic">{{__('e2e.login.selected_phone')}} <span class="text-blue underline" wire:click="$set('screen','number')">{{$phone_number}}</span></span>
    </div>
    <div class="px-4">
      <x-jet-label for="otp" value="{{__('e2e.login.otp_label')}}" class="text-black font-semibold text-xl" />
      <div class="flex items-center">
        <x-jet-input id="otp" class="block rounded-xl border-brown w-full bg-white" wire:model.defer="otp" type="text" name="otp" maxlength="4" required autofocus />
      </div>
      <div class="grid w-full justify-items-center pb-2 mt-4">
        <div x-data="{countdown:false}" x-init="countdown=60,window.setInterval(()=>{if(countdown>0){countdown=countdown-1;}},1000);">
          <template x-if="countdown > 0">
            <div>
              <span>{{__('e2e.login.resend_in')}}</span><span>00:</span><span x-text="countdown"></span>
            </div>
          </template>
          <template x-if="countdown==0"><div x-init="countdown=false"></div></template>
            <span class="underline text-blue cursor-pointer" x-show="!countdown" wire:click="send_otp" x-on:click="countdown=60,window.setInterval(()=>{if(countdown>0){countdown=countdown-1;}},1000)">{{__('e2e.login.resend_otp')}}</span>
        </div>
      </div>
      @error('otp') <div class="error text-red">{{ $message }}</div> @enderror
      <div wire:ignore class="flex justify-center pb-2 mt-4">
          <button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl "  wire:loading.attr="disabled" wire:click="sign_in">
              {{__('e2e.login.otp_button')}}
          </button>
      </div>
    </div>
  @endif
  <x-e2-e.loader/>
</div>
