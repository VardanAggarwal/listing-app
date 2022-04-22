<div class="flex flex-col">
  <x-e2-e.top-nav/>
  <div class="p-4">
    <div class="mt-4 grid place-items-center">
      <div class="w-36 h-36 border border-brown rounded-full grid place-items-center overflow-hidden">
        @if(isset($profile->user->profile_photo_url))
          <img class="object-cover" src="{{$profile->user->profile_photo_url}}">
        @else
          <i class="text-8xl fas fa-user-circle text-primary"></i>
        @endif
      </div>
    </div>
    <div class="flex flex-col">
      <div class="mt-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-brown">{{$profile->name}}
        </h1>
        @if($edit)
          <span class="float-right text-blue underline"><a href="/e2e/profile/edit"><i class="fas fa-edit"></i> {{__('e2e.profile.edit')}}</a></span>
        @endif
      </div>
      <span class="text-lg text-black">{{$profile->address}}</span>
      <span class="text-lg text-black">{{$profile->pincode}}</span>
      @if(isset($profile->additional_info['business_id']))
        <span class="text-lg text-black">{{__('e2e.profile.business_id')}}: {{$profile->additional_info['business_id']}}</span>
      @endif
    </div>
    <div class="mt-4 flex justify-between items-center">
      <h1 class="font-semibold text-2xl text-black">{{__('e2e.profile.items_heading')}}</h1>
    </div>
    <div class="px-4 mt-5" wire:loading.class="opacity-75">
        <div class="mt-4 grid grid-cols-2 gap-4">
            @foreach($trades as $item)
                <x-e2-e.card type="profile" :item="$item"/>
            @endforeach
        </div>
    </div>
  </div>
  @if($edit)
  <div class="mt-10 border-t">
      @livewire('e2-e.actions')
  </div>
  @endif
  <div class="h-20"></div>     
  <div x-data="{allowed:@entangle('allowed'),show:false}">
    <button x-on:click="if(allowed){window.location.href='{{$href}}';}else{show=true;}" class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
        {{__('e2e.profile.button.'.$button,['name'=>$profile->name])}}
    </button>
    <livewire:e2-e.profile-check/>
  </div>
</div>
