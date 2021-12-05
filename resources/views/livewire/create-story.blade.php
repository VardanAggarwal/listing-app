<div class="py-8 max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-4">
          {{__('ui.new_m')}} {{__('ui.models.stories')}}
        </h1>
        <div class="mt-4">
            <x-jet-label for="rating" value="{{__('Rating')}}"/>
            <div class="text-yellow-400">
                @for($i=1;$i<=5;$i++)
                    <span wire:click="$set('story.rating',{{$i}})"><i class="{{$i<=$story->rating?'fas':'far'}} fa-star"></i></span>
                @endfor
            </div>
        </div>
        <div class="mt-4">
            <x-jet-label for="title" value="{{ __('Title') }}" />
            <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" wire:model="story.title" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="review" value="{{ __('Review') }}" />
            <textarea id="review" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="review" wire:model="story.review"> </textarea>
        </div>
        <div class="mt-4">
            <x-jet-label for="links" value="{{ __('Link') }}" />
            <x-jet-input id="links" class="block mt-1 w-full" type="text" name="links" wire:model="story.links" />
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
                    <div class=" p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                        {{$result->name}}
                    </div>
                @endforeach
            </div>
        </div>
            @endif
        <div class="grid w-full mt-4 justify-items-center">
            <x-jet-button class="max-w-md justify-center" type="submit">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
    </form>
</div>