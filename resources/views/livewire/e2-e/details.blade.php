<div class="p-4 mt-4">
    <h1 class="text-xl">{{__('e2e.profile.title')}}</h1>
    <x-jet-validation-errors/>
    <div class="mt-4">
        <x-jet-label for="name" value="{{__('e2e.profile.name')}}*" />
        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="profile.name" required/>
    </div>
    <div class="mt-4">
        <x-jet-label for="address" value="{{__('e2e.profile.address')}}*" />
        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model="profile.address" required/>
    </div>
    <div class="mt-4">
        <x-jet-label for="pincode" value="{{__('e2e.profile.pincode')}}*" />
        <x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" wire:model="profile.pincode" required/>
    </div>
    @if(count(array_intersect($roles,['producer']))>0)
        <div class="mt-4">
            <x-jet-label for="producer_type" value="{{__('e2e.profile.producer_type.label')}}" />
            <select name="producer_type" id="producer_type" wire:model="producer_type">
                @foreach($producer_types as $type)
                    <option value="{{$type}}">{{__('e2e.profile.producer_type.'.$type)}}</option>
                @endforeach
            </select>
        </div>
        @if($producer_type=="farmer_group")
            <div class="mt-4">
                <x-jet-label for="organisation_type" value="{{__('e2e.profile.organisation_type.label')}}" />
                <select name="organisation_type" id="organisation_type"  wire:model="org.type">
                    @foreach($organisation_types as $type)
                        <option value="{{$type}}">{{__('e2e.profile.organisation_type.'.$type)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <x-jet-label for="members" value="{{__('e2e.profile.org.members')}}" />
                <div class="flex items-center">
                <x-jet-input id="members" class="block mt-1 w-full" type="text" name="members" wire:model="org.members" autofocus/>
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="landholding" value="{{__('e2e.profile.org.landholding')}}" />
                <div class="flex items-center">
                <x-jet-input id="landholding" class="block mt-1 w-full" type="text" name="landholding" wire:model="org.landholding" autofocus/><span class="ml-2">Acres</span>
                </div>
            </div>
        @else
            <div class="mt-4">
                <x-jet-label for="landholding" value="{{__('e2e.profile.landholding')}}" />
                <div class="flex items-center">
                <x-jet-input id="landholding" class="block mt-1 w-full" type="text" name="landholding" wire:model="landholding" autofocus/><span class="ml-2">Acres</span>
                </div>
            </div>
        @endif
    @endif
    @if(count(array_intersect($roles,['trader','processor','buyer']))>0)
    <div class="mt-4">
        <x-jet-label for="business_id" value="GSTIN/PAN No." />
        <x-jet-input id="business_id" class="block mt-1 w-full" type="text" name="business_id" wire:model="business_id" autofocus/>
    </div>
    @endif
    <x-jet-validation-errors/>
    <div class="flex justify-center pb-2 mt-4">
        <x-jet-button wire:click="submit">
          Introduce yourself
        </x-jet-button>
    </div>
</div>