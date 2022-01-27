<div class="max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-0">
          {{__('ui.new_m')}} {{__('ui.models.stories')}}
        </h1>
        <span class="text-sm text-gray-500">{{__('ui.labels.story_subtitle')}}</span>
        <div class="mt-4">
            <x-jet-label for="title" value="{{ __('ui.labels.story_title') }}" />
            <x-jet-input id="title" class="block mt-1 w-full" placeholder="{{ __('ui.placeholders.story_title') }}" type="text" name="title" wire:model="story.title" autofocus/>
        </div>
        <div class="mt-4" wire:ignore>
            <x-jet-label for="review" value="{{ __('ui.labels.story_review') }}" />
            <x-tinymce wire:model="story.review" placeholder="{{ __('ui.placeholders.story_review') }}" />
        </div>
        <div class="mt-4">
            <x-jet-label for="rating" value="{{ __('ui.labels.story_rating') }}"/>
            <div class="text-yellow-400">
                @for($i=1;$i<=5;$i++)
                    <span wire:click="$set('story.rating',{{$i}})"><i class="{{$i<=$story->rating?'fas':'far'}} fa-star"></i></span>
                @endfor
            </div>
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" />
            @if($image)
                <img class="h-24" src="{{$image->temporaryUrl()}}">
            @elseif($story->image_url)
                <img class="h-24" src="{{$story->image_url}}">
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