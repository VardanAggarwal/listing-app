<div class="flex flex-col">
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
          <span class="float-right text-blue underline"><a href="/e2e/profile/edit">{{__('e2e.profile.edit')}}</a></span>
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
      @if($edit)
        <span class="float-right text-blue underline"><a href="/e2e/profile/edit">{{__('e2e.profile.items_add')}}</a></span>
      @endif
    </div>
    <div class="px-4 mt-5" wire:loading.class="opacity-75">
        <div class="mt-4 grid grid-cols-2 gap-4">
            @foreach($trades as $item)
                <x-e2-e.card type="profile" :item="$item"/>
            @endforeach
        </div>
        <div class="grid justify-items-center"><button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" wire:loading.attr="disabled">
                List items
            </button></div>
    </div>
  </div>     
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
        {{__('e2e.profile.share_button')}}
    </button>
</div>
