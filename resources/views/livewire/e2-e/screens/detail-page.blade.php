<div class="mt-4 px-4 flex flex-col">
      <h1 class="text-2xl font-semibold text-brown">{{ucfirst($trade->item->name)}}</h1>
      @if($media)
        <div class="relative" x-data="{id:0}">
            <div id="left" class="z-50 w-8 absolute grid items-center h-full left-0" x-on:click="if(id!=0){id=id-1}else{id={{count($media)}}-1}"><i class="opacity-100 text-2xl text-black pl-2 fas fa-angle-left"></i></div>
            <div id="right"  class="z-50 w-8 absolute flex justify-end items-center h-full right-0" x-on:click="if(id!={{count($media)-1}}){id=id+1}else{id=0}"><i class="text-2xl opacity-100 pr-2 text-black fas fa-angle-right"></i></div>
            @foreach($media as $key=>$file)
              <div class="w-full">
                @php
                  $type=get_headers($file,true)["Content-Type"]
                @endphp
                @switch($type)
                  @case (str_contains($type,'image'))
                    <img src="{{$file}}" class="w-full object-cover order-first" x-data="{height:$el.offsetWidth}" x-show="id=={{$loop->index}}" x-effect="$el.style.height=height+'px';console.log(height)">
                    @break
                  @case (str_contains($type,'video'))
                    <video src="{{$file}}" controls class="w-full order-first"  preload="metadata"  x-data="{height:$el.offsetWidth}" x-show="id=={{$loop->index}}" x-effect="$el.style.height=height+'px';console.log(height)"></video>
                    @break
                  @case (str_contains($type,'audio'))
                  <div class="grid items-center p-8" x-data="{height:$el.offsetWidth}" x-show="id=={{$loop->index}}" x-effect="$el.style.height=height+'px';console.log(height)">
                    <audio src="{{$file}}" class="order-last" controls preload="none"></audio></div>
                    @break
                  @case (str_contains($type,'pdf'))
                      <x-jet-button x-show="id=={{$loop->index}}">{{__("Download pdf file")}}</x-jet-button>
                    @break
                @endswitch
              </div>
            @endforeach
            <div class="absolute bottom-1 text-black w-full flex justify-center">
                @for($i=0;$i < count($media);$i++)
                <span class=""><i class="text-xs fa-circle" :class="id=={{$i}}?'fas':'far'"></i></span>
                @endfor
            </div>
        </div>
    @endif
    <h1 class="mt-4 text-2xl font-semibold text-black">Rs. {{$trade->price}}/kg, {{$trade->quantity}} Kg</h1>
    <p class="mt-4 text-lg font-semibold text-black">{{$trade->profile->name}}</p>
    <p class="text-lg opacity-50 text-black">{{$trade->profile->address}}</p>
    @if(isset($trade->additional_info['location']))
        <div class="mt-4">
            <p class="text-lg opacity-50 text-black">{{__('e2e.bid-form.location')}}</p>
            <p class="text-black">{{$trade->additional_info['location']}}</p>
        </div>
    @endif
    @if($trade->description)
        <div class="mt-4">
            <p class="text-lg opacity-50 text-black">{{__('e2e.bid-form.description_label.'.$trade->item->type.'.'.$trade->type)}}</p>
            <p class="text-black">{{$trade->description}}</p>
        </div>
    @endif
    @if(isset($trade->additional_info['details']))
        <div class="mt-4">
            <p class="text-lg opacity-50 text-black">{{__('e2e.bid-form.additional_info_label')}}</p>
            <p class="text-black">{{$trade->additional_info['details']}}</p>
        </div>
    @endif
    <button class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
        {{$button}}
        </button>
</div>
