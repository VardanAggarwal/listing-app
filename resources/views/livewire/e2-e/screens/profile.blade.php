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
                <a href="/e2e/trade/{{$item->id}}"><x-e2-e.card type="profile" :item="$item"/></a>
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
  <div x-data="{allowed:@entangle('allowed'),show:false,drawer:false}">
    @if($button=="share")
    <a href="{{$href}}"><button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
      {{__('e2e.profile.button.'.$button,['name'=>$profile->name])}}
    </button>
    </a>
    @elseif($href||$call)
    <button x-on:click="if(allowed){drawer=true}else{show=true;}" class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
        {{__('e2e.profile.button.'.$button,['name'=>$profile->name])}}
    </button>
    @endif
    <div x-show='drawer' @click.outside="drawer=false" x-cloak>
      <livewire:e2-e.contact :href="$href" :call="$call"/>
    </div>
    <livewire:e2-e.profile-check/>
  </div>
  <x-e2-e.loader/>
  <x-slot name="title">{{$profile->name??'Herbal Mandi'}}</x-slot>
  @push('meta')
  <meta property="og:title" content="{{$profile->name??'Herbal Mandi'}}">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:description" content="{{$profile->name.' at Herbal Mandi, '.$profile->address.', '.$profile->pincode}}">
  <meta property="og:image" content="{{isset($profile->user->profile_photo_url)?$profile->user->profile_photo_url:''}}">
  @endpush
</div>
