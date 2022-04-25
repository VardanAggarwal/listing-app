<div class="mt-4 px-4">
    <h1 class="text-2xl font-semibold text-black">{{__('e2e.item.title')}}</h1>
    <div class="mt-4">
      <x-jet-label for="name" value="{{__('e2e.item.name.label')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="item.name" type="text" placeholder="{{__('e2e.item.name.placeholder')}}"/>
      </div>
    </div>
    <div class="mt-4">
      <x-jet-label for="scientific_name" value="{{__('e2e.item.scientific_name.label')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="item.additional_info.scientific_name" type="text" placeholder="{{__('e2e.item.scientific_name.placeholder')}}"/>
      </div>
    </div>
    <div class="mt-4">
      <x-jet-label for="type" value="{{__('e2e.item.type.label')}}" class="text-brown font-semibold text-xl" />
      <div class="flex items-center">
        <select class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="item.type" >
            <option value="produce" {{$item->type=='produce'?'selected':''}}>{{__('e2e.item.type.produce')}}</option>
            <option value="input" {{$item->type=='input'?'selected':''}}>{{__('e2e.item.type.input')}}</option>
        </select>
      </div>
    </div>
    <div class="mt-4 grid">
      <span class="text-brown font-semibold text-xl">{{__('e2e.item.image.label')}}</span>
      <label class="">
        <span class="items-center flex gap-2 px-4 py-2 w-full bg-white border border-brown rounded-xl"><i class="text-2xl text-brown fas fa-image"></i> {{__('e2e.item.image.button')}}</span>
        <input id="media" class="hidden" wire:model="image" type="file"/>
      </label>
      @if($image)
        <img src="{{$image->temporaryUrl() }}" width="100px" height="100px" class="mx-2">
      @endif
    </div>
    <x-jet-validation-errors/>
    <div class="grid justify-items-center"><button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" wire:click="save" wire:loading.attr="disabled">
            {{__('e2e.item.button')}}
        </button></div>
</div>
