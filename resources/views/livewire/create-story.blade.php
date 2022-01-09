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
        <div class="mt-4" wire:ignore>
            <x-jet-label for="review" value="{{ __('Review') }}" />
            <textarea id="review" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm tinymce" type="text" name="review" wire:model="story.review"> </textarea>
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" />
            @if($image)
                <img src="{{$image->temporaryUrl()}}">
            @endif
        </div>
        @livewire('relationship-search',['type'=>'Resiliency'])
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
             plugins: 'code lists link paste autolink media',
             toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | link | media',
             setup: function (editor) {
                         editor.on('init change', function () {
                             editor.save();
                         });
                         editor.on('change', function (e) {
                         @this.set('story.review', editor.getContent());
                         });
                      },
             smart_paste:true,
             default_link_target: '_blank'
           });
         </script>
    @endpush
@endonce