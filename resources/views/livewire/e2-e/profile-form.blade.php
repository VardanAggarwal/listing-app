<div>
  <x-e2-e.top-nav/>
  <div class="grid p-4 mt-4">
    <h1 class="text-2xl font-semibold text-brown">{{__('e2e.profile.title')}}</h1>
    <div  class="mt-4 grid place-items-center">
      <label class="grid place-items-center">
        <div class="w-24 h-24 border border-brown rounded-full overflow-hidden">
          @if($image)
            <img src="{{$image->temporaryUrl()}}" class="object-cover">
          @else
            @if($profile->user->profile_photo_url)
              <img src="{{$profile->user->profile_photo_url}}" class="object-cover">
            @else
              <i class="text-8xl fas fa-user-circle text-primary"></i>
            @endif
          @endif
        </div>
        <input class="hidden" wire:model="image" type="file"/>
        <span class="text-xs text-brown">{{__('e2e.profile.pic')}}</span>
      </label>
    </div>
    <x-jet-validation-errors/>
    <div class="mt-4">
      <x-jet-label for="name" value="{{$role=='farmer'?__('e2e.profile.name_label.individual'):__('e2e.profile.name_label.company')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="profile.name" type="text" placeholder="{{$role=='farmer'?__('e2e.profile.name_placeholder.individual'):__('e2e.profile.name_placeholder.company')}}"/>
      </div>
    </div>
    <div class="mt-4">
      <x-jet-label for="address" value="{{__('e2e.profile.address.label')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <textarea class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="profile.address" type="text" placeholder="{{$role=='farmer'?__('e2e.profile.address.placeholder.individual'):__('e2e.profile.address.placeholder.company')}}"></textarea>
      </div>
    </div>
    <div class="mt-4">
      <x-jet-label for="pincode" value="{{__('e2e.profile.pincode')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="profile.pincode" type="text" placeholder="XXXXXX"/>
      </div>
    </div>
    @if($role!="farmer")
        <div class="mt-4">
          <x-jet-label for="business_id" value="{{__('e2e.profile.business_id')}}" class="text-brown font-semibold text-xl" />
          <div class="flex items-center">
            <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="profile.additional_info.business_id" type="text" placeholder="XXXXXXXXXXXXXX"/>
          </div>
        </div>
    @else
        <div class="mt-4">
          <x-jet-label for="landholding" value="{{__('e2e.profile.landholding')}}" class="text-brown font-semibold text-xl" />
          <div class="flex items-center gap-2">
            <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="profile.additional_info.landholding" type="text" placeholder="12"/><span>{{__('e2e.profile.landholding_unit')}}</span>
          </div>
        </div>
    @endif
    <div class="mt-4">
      <x-jet-label for="role" value="{{__('e2e.profile.role')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <select class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="profile.personas" >
            @foreach($roles as $option)
                <option value="{{$option}}" {{$role==$option?'selected':''}}>{{__('e2e.roles.'.$option.'.label')}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="mt-4">
      <x-jet-label for="language" value="{{__('e2e.profile.language')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <select class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="lang" >
            <option value="en" {{$lang=='en'?'selected':''}}>English</option>
            <option value="hi" {{$lang=='hi'?'selected':''}}>हिन्दी</option>
        </select>
      </div>
    </div>
    <div class="h-20"></div>
    </div>
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:click="submit" wire:loading.attr="disabled">
        {{__('e2e.profile.button')}}
        </button>
</div>