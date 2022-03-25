<div  class="static" x-data="{form:false,type:@entangle('type'),href:@entangle('href')}">
    @unless($version==0)
    <div class="flex justify-center gap-2 text-green-500">
        @if($call)
        <a x-on:click="mixpanel.track('Call Clicked',{'profile_id':{{$profile->id}},'number':'{{$call}}'}); type='call'; form=true; href='tel:{{$call}}'" class="flex items-center gap-1"><i class="text-2xl fas fa-phone-alt"></i>{{__('Call')}}</a>
        @endif
        @if($whatsapp)
        <a  x-on:click="mixpanel.track('Whatsapp Clicked',{'profile_id':{{$profile->id}},'number':'{{$whatsapp}}'}); type='whatsapp'; form=true; href='https://wa.me/{{Str::remove('+',$whatsapp)}}?text={{__('ui.contact_message',['url'=>'https://app.seedsaversclub.com/profiles/'.$profile->id])}}'" class="ml-4 flex items-center gap-1"><i class="text-3xl fab fa-whatsapp"></i>{{__('Whatsapp')}}</a>
        @endif
    </div>
    @endunless
    <div x-show="form">
        <div class="fixed bg-gray-900 opacity-80 inset-0 z-10" x-on:click="form=false"></div>
        <div class="fixed bg-white inset-x-10 inset-y-20 z-50 sm:inset-x-96 p-4 sm:p-10 opacity-100" @mouseleave="form=false">
            <h1 class="my-4 text-xl">{{__('ui.expert.contact.title')}}</h1>
            <span class="">{{__('ui.expert.contact.resiliency')}}</span>
            <div class="mb-4 flex overflow-auto flex-nowrap">
              @foreach ($profile->expert_resiliencies as $resiliency)
              <a class="mr-2 border rounded-md py-1 px-2 whitespace-nowrap tracking-widest {{in_array($resiliency->id,$selected['resiliency'])?'bg-green-300':''}}" wire:click="toggleSelected('resiliency','{{$resiliency->id}}')">{{$resiliency->name}}</a>
              @endforeach
            </div>
            <span>{{__('ui.expert.contact.service')}}</span>
            <div class="mt-2 flex flex-wrap gap-2">
              @foreach($services as $service)
                <span class="{{in_array($service,$selected['service'])?'bg-green-300':''}} border p-2" wire:click="toggleSelected('service','{{$service}}')"><i class="fas fa-{{in_array($service,array_keys($service_types))?$service_types[$service]:$service_types['others']}}"></i> <span class="text-xs">{{__(in_array($service,array_keys($service_types))?'ui.expert.services.'.$service:$service)}}</span></span>
              @endforeach
            </div>
            @unless($login)
            <div class="mt-4">
                <x-jet-label for="phone_number" value="{{ __('ui.contact_number') }}" />
                <div class="flex items-center">
                  <span class="text-lg mr-2">+91</span>
                  <x-jet-input id="phone_number" class="block mt-1 w-full" wire:model="phone_number" type="text" name="phone_number" maxlength="10" required autofocus />
                </div>
                <div class="mt-4">
                    <x-jet-label for="pincode" value="{{ __('ui.pincode') }}" />
                    <x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" wire:model="pincode" autofocus/>
                </div>
            </div>
            @endunless
            <div class="flex justify-center pb-2 mt-4">
                <x-jet-button wire:click="submit" x-on:click="form=false; mixpanel.track('Expert Contacted',{'profile_id':{{$profile->id}},'type':'{{$type}}'});">
                    {{ __('ui.expert.contact.button') }}
                </x-jet-button>
            </div>
        </div>
    </div>
</div>