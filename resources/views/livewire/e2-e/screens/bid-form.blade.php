<div class="mt-4 px-4">
        <h1 class="text-2xl font-semibold text-black">{{ucfirst($trade->type)}} {{ucfirst($trade->item->name)}}</h1>
        @if($trade->item->type=="input")
          <x-e2-e.bid-form.price :item-type="$trade->item->type" :type="$trade->type" wire:model="trade.price"/>
          <x-e2-e.bid-form.quantity :item-type="$trade->item->type" :type="$trade->type" wire:model="trade.quantity"/>
        @else
          <x-e2-e.bid-form.quantity :item-type="$trade->item->type" :type="$trade->type" wire:model="trade.quantity"/>
          <x-e2-e.bid-form.price :item-type="$trade->item->type" :type="$trade->type" wire:model="trade.price"/>
        @endif
        @if($trade->type=="buy" && $trade->item->type=="produce")
          <div class="mt-4">
            <x-jet-label for="location" value="{{__('e2e.bid-form.location')}}" class="text-brown font-semibold text-xl" />
            <div class="flex items-center">
              <input class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="trade.additional_info.location" type="text" placeholder="Noida"/>
            </div>
          </div>
        @endif
        <div class="mt-4">
          <x-jet-label for="description" value="{{__('e2e.bid-form.description_label.'.$trade->item->type.'.'.$trade->type)}}" class="text-brown font-semibold text-xl" />
          <div class="flex items-center">
            <textarea class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="trade.description" type="text" placeholder="{{__('e2e.bid-form.description_placeholder.'.$trade->item->type.'.'.$trade->type)}}"></textarea>
          </div>
        </div>
        @if($trade->type=="sell")
          <div class="mt-4 grid">
            <span class="text-brown font-semibold text-xl">{{__('e2e.bid-form.media.label')}}</span>
            <label class="">
              <span class="items-center flex gap-2 px-4 py-2 w-full bg-white border border-brown rounded-xl"><i class="text-2xl text-brown fas fa-image"></i> {{__('e2e.bid-form.media.button')}}</span>
              <input id="media" class="hidden" wire:model="media" type="file" multiple/>
            </label>
            @error('media') <div class="error text-red">{{ $message }}</div> @enderror
            <div class="flex mt-4 gap-2">
              @if($media)
                @foreach ($media as $key=>$file)
                    @if(str_contains($file->getMimeType(),"image"))
                    <img src="{{ $file->temporaryUrl() }}" width="100px" height="100px" class="mx-2" wire:click="removeFile({{$key}})">
                    @endif
                    @if(str_contains($file->getMimeType(),"video"))
                    <video src="{{ $file->temporaryUrl() }}" width="100px" height="100px" class="mx-2" wire:click="removeFile({{$key}})">
                    @endif
                    @if(str_contains($file->getMimeType(),"audio"))
                    <a class="underline mx-2" wire:click="removeFile({{$key}})">{{$file->getClientOriginalName()}}</a>
                    @endif
                    @if(str_contains($file->getMimeType(),"pdf"))
                    <a class="underline mx-2" wire:click="removeFile({{$key}})">{{$file->getClientOriginalName()}}</a>
                    @endif
                @endforeach
              @endif
              @if($old_media)
                @foreach($old_media as $key=>$file)
                  <div wire:click="removeMedia({{$key}})">
                    @php
                      $type=get_headers($file,true)["Content-Type"]
                    @endphp
                    @switch($type)
                      @case (str_contains($type,'image'))
                        <img src="{{$file}}" class="object-cover rounded mb-4 sm:m-0" width="100px" height="100px">
                        @break
                      @case (str_contains($type,'video'))
                        <video src="{{$file}}" controls class="order-first max-w-full sm:w-1/3 sm:m-0"  preload="metadata"></video>
                        @break
                      @case (str_contains($type,'audio'))
                        <audio src="{{$file}}" class="order-last" controls preload="none"></audio>
                        @break
                      @case (str_contains($type,'pdf'))
                          <x-jet-button>{{__("Download pdf file")}}</x-jet-button>
                        @break
                    @endswitch
                  </div>
                @endforeach
            @endif
            </div>
          </div>
        @endif
        <div class="mt-4">
          <x-jet-label for="additional_info" value="{{__('e2e.bid-form.additional_info_label')}}" class="text-brown font-semibold text-xl" />
          <div class="flex items-center">
            <textarea class="px-4 block rounded-xl border-brown w-full bg-white" wire:model="trade.additional_info.details" type="text" placeholder="{{__('e2e.bid-form.additional_info_placeholder.'.$trade->item->type.'.'.$trade->type)}}"></textarea>
          </div>
        </div>
        <div class="grid justify-items-center"><button class="bg-brown text-white text-xl font-semibold px-20 py-4 rounded-xl my-16" wire:click="save" wire:loading.attr="disabled">
                {{__('e2e.bid-form.button.'.$trade->item->type.'.'.$trade->type)}}
            </button></div>
</div>
