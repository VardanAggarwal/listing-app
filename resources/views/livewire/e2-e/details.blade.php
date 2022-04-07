<div class="grid min-h-screen items-center">
  <div>
    <h1 class="text-xl">Tell us about yourself</h1>
    <div class="mt-4">
        <x-jet-label for="name" value="Your/Company name" />
        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="profile.name" autofocus/>
    </div>
    <div class="mt-4">
        <x-jet-label for="address" value="Address" />
        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model="profile.address" autofocus/>
    </div>
    <div class="mt-4">
        <x-jet-label for="pincode" value="Pincode" />
        <x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" wire:model="profile.pincode" autofocus/>
    </div>
    <div class="mt-4">
        <x-jet-label for="business_id" value="GSTIN/PAN No." />
        <x-jet-input id="business_id" class="block mt-1 w-full" type="text" name="business_id" wire:model="profile.business_id" autofocus/>
    </div>
    <div class="flex justify-center pb-2 mt-4">
        <x-jet-button wire:click="profile_submit">
          Introduce yourself
        </x-jet-button>
    </div>
  </div>
</div>
