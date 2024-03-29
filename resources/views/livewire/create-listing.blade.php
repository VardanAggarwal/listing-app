<div class="max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />
    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-0">
          {{__('ui.new_f')}} {{__('listing')}}
        </h1>
        <span class="text-sm text-gray-500">{{__('ui.labels.listing_subtitle')}}</span>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('ui.labels.listing_name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" placeholder="{{ __('ui.placeholders.listing_name') }}" name="name" wire:model="listing.name" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="price" value="{{ __('Price') }}" />
            <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" placeholder="{{ __('ui.placeholders.listing_price') }}" wire:model="listing.price" />
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <x-jet-label for="type" value="{{ __('ui.models.listings') }}" />
                <select name="type" wire:model="listing.type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="sell" selected>{{__('sell')}}</option>
                    <option value="buy">{{__('buy')}}</option>
                </select>
            </div>
            <div>
                <x-jet-label for="item_type" value="{{ __('Type') }}" />
                <select name="item_type" wire:model="listing.item_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($item_types as $type)
                    <option value="{{$type}}" >{{__($type)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-4" wire:ignore>
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-tinymce wire:model="listing.description" placeholder="{{ __('ui.placeholders.listing_description') }}" />
        </div>
        <div class="mt-4">
            <x-jet-label for="location" value="{{ __('Address') }}" />
            <x-jet-input id="location" class="block mt-1 w-full" type="text" name="location" wire:model="listing.location" />
        </div>
        <div class="mt-4">
            <x-jet-label for="phone_number" value="{{ __('ui.contact_number') }}" />
            <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" wire:model="listing.phone_number" />
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" />
            @if($image)
                <img class="h-24" src="{{$image->temporaryUrl()}}">
                @elseif($listing->image_url)
                    <img class="h-24" src="{{$listing->image_url}}">
            @endif
        </div>
        @livewire('relationship-search',['type'=>'Resiliency','selected'=>$selected])
        <x-jet-validation-errors class="mb-4" />
        <div class="grid w-full mt-4 justify-items-center" wire:loading.class="opacity-20" wire:target="save">
            <x-jet-button class="max-w-md justify-center" type="submit">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
    </form>
</div>