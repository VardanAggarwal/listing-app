<div class="py-8 max-w-7xl mx-4 sm:mx-auto">
              <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="save">
        @csrf
        <h1 class="font-bold text-lg mb-4">
          {{__('ui.new_f')}} {{__('ui.models.resiliencies')}}
        </h1>
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="resiliency.name" autofocus/>
        </div>
        <div class="mt-4">
            <x-jet-label for="type" value="{{__('Type')}}"/>
            <select wire:model="resiliency.type">
                <option value="crop">{{__('crop')}}</option>
                <option value="agribusiness">{{__('agribusiness')}}</option>
                <option value="model">{{__('model')}}</option>
                <option value="practice">{{__('practice')}}</option>
            </select>
        </div>
        <div class="mt-4" wire:ignore>
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <textarea id="description" class="block mt-1 w-full tinymce" type="text" name="description" wire:model="resiliency.description"></textarea>
        </div>
        <div class="mt-4">
            <x-jet-label for="image" value="{{ __('Image') }}" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" wire:model="image" autofocus/>
            @if($image)
                <img src="{{$image->temporaryUrl()}}">
            @endif
        </div>
        @livewire('relationship-search',['type'=>'Category'])
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
                         @this.set('resiliency.description', editor.getContent());
                         });
                      },
             smart_paste:true,
             default_link_target: '_blank'
           });
         </script>
    @endpush
@endonce