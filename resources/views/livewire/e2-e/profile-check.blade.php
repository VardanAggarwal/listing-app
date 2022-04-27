<div class="z-40 fixed inset-0 grid place-items-center" x-cloak x-show="show">
  <div class="bg-black opacity-50 fixed inset-0" x-on:click="show=false"></div>
  <div class="z-50 m-5 p-10 bg-white border border-brown rounded-xl grid justify-items-center gap-5 relative">
      <span class="absolute right-5 top-5" @click="show=false"><i class="fas fa-times text-xl text-red"></i></span>
      <span class="text-brown">{{__('e2e.actions.profile_completion.dialog')}}</span>
      <a wire:click="saveUrl()"><button class="bg-brown text-white px-4 py-2 rounded-xl">{{__('e2e.actions.profile_completion.button')}}</button></a>
  </div>
</div>