<div class="py-8 max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />
    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-4">
          {{__('ui.new_f')}} {{__('listing')}}
        </h1>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="listing.name" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="price" value="{{ __('Price') }}" />
            <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" wire:model="listing.price" />
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
            <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm tinymce" type="text" name="description" wire:model="listing.description"> </textarea>
        </div>
        <div class="mt-4">
            <x-jet-label for="location" value="{{ __('Address') }}" />
            <x-jet-input id="location" class="block mt-1 w-full" type="text" name="location" wire:model="listing.location" />
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" />
            @if($image)
                <img src="{{$image->temporaryUrl()}}">
            @endif
        </div>
        <div class="mt-4">
            <x-jet-label for="resiliencies" value="{{__('ui.models.resiliencies')}}"/>
            <div class="flex flex-wrap my-2 gap-2">
                @foreach($resiliencies as $result)
                    <div class="p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                        {{$result->name}}
                    </div>
                @endforeach
            </div>
            <x-jet-input type="text" placeholder="{{__('Type to search')}}" name="resiliencies" wire:model="search_resiliency" class="w-full"/>
            @if($results)
            <div class="flex flex-wrap mt-5 gap-2">
                @foreach($results as $result)
                    <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                        {{$result->name}}
                    </div>
                @endforeach
                @if($this->search_resiliency && !$this->results->contains('name',$this->search_resiliency))
                    <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border" wire:click="newResiliency">
                        {{$this->search_resiliency}}+
                    </div>
                @endif
            </div>
            @endif
        </div>
        <div class="grid w-full mt-4 justify-items-center" wire:loading.class="opacity-20" wire:target="save">
            <x-jet-button class="max-w-md justify-center" type="submit">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
    </form>
</div>
@once
    @push('scripts')
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
         <script>
           tinymce.init({
             selector: 'textarea.tinymce', // Replace this CSS selector to match the placeholder element for TinyMCE
             plugins: 'code table lists',
             toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
             setup: function (editor) {
                         editor.on('init change', function () {
                             editor.save();
                         });
                         editor.on('change', function (e) {
                         @this.set('listing.description', editor.getContent());
                         });
                      }
           });
         </script>
    @endpush
@endonce