<div>
  <x-e2-e.top-nav/>
  <div class="mt-4 px-4 flex flex-col">
    <div class="flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-brown">{{__('e2e.trade.title.'.$trade->type,["name"=>$trade->item->name])}}</h1>
    @if($button=="share")
    <div class="cursor-pointer flex gap-4 items-center">
    <a href="/e2e/bid-form/{{$trade->id}}"><span class="text-sm text-blue underline"><i class="fas fa-edit"></i> {{__('e2e.trade.edit')}}</span></a>
    <span class="text-sm text-red underline" wire:click="delete" ><i class="fas fa-trash"></i> {{__('e2e.trade.delete')}}</span></div>
    @endif
    </div>
    @if($media)
      <div class="relative grid justify-center" x-data="{id:0}">
        <div id="left" class="z-10 w-8 absolute grid items-center h-full left-0" x-on:click="if(id!=0){id=id-1}else{id={{count($media)}}-1}"><i class="opacity-100 text-2xl text-black pl-2 fas fa-angle-left"></i></div>
        <div id="right"  class="z-10 w-8 absolute flex justify-end items-center h-full right-0" x-on:click="if(id!={{count($media)-1}}){id=id+1}else{id=0}"><i class="text-2xl opacity-100 pr-2 text-black fas fa-angle-right"></i></div>
        @foreach($media as $key=>$file)
          <div class="w-full sm:max-w-xl sm:mx-auto">
            @php
              $type=get_headers($file,true)["Content-Type"];
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
                  <x-jet-button x-show="id=={{$loop->index}}">{{__("e2e.global.pdf")}}</x-jet-button>
                @break
            @endswitch
          </div>
        @endforeach
        <div class="absolute bottom-1 text-black w-full flex justify-center">
            @for($i=0;$i < count($media);$i++)
            <span class="ml-2" @click="id={{$i}}"><i class="text-xs fa-circle" :class="id=={{$i}}?'fas':'far'"></i></span>
            @endfor
        </div>
      </div>
    @else
      <div class="w-full sm:max-w-xl sm:mx-auto">
        <img src="{{$trade->item->image_url}}" class="w-full object-cover order-first" x-data="{height:$el.offsetWidth}" x-effect="$el.style.height=height+'px';console.log(height)">
      </div>
    @endif
    @if($title)
      <h1 class="mt-4 text-2xl font-semibold text-black">{{$title}}</h1>
    @elseif(!$requestSent && $button!="share" && $allowed)
      <button class="mt-4 bg-primary text-black p-2" wire:click="sendRequest">{{__('e2e.trade.request_details')}}</button>
    @endif
    @if($button=="share")
    <a href="/e2e/supplier-list/{{$trade->id}}"><span class="text-lg font-semibold text-blue underline"><i class="fas fa-truck"></i> {{__('e2e.trade.suppliers.'.$trade->type,['name'=>$trade->item->name])}}</span></a>
    @endif
    <a href="/e2e/profiles/{{$trade->profile_id}}" class="mt-4 text-lg font-semibold text-brown underline">{{$trade->profile->name}}</a>
    <p class="text-lg opacity-50 text-black">{{$trade->profile->address}}</p>
    @if(isset($trade->additional_info['location']))
      <div class="mt-4">
        <p class="text-lg opacity-50 text-black">{{__('e2e.bid-form.location_label')}}</p>
        <p class="text-black">{{$trade->additional_info['location']}}</p>
      </div>
    @endif
    @if(isset($trade->additional_info['quality']))
      <div class="mt-4">
        <p class="text-lg opacity-50 text-black">{{__('e2e.bid-form.quality_label')}}</p>
        <p class="text-black">{{$trade->additional_info['quality']}}</p>
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
    <div class="h-20"></div>
  </div>
  <div x-data="{allowed:@entangle('allowed'),show:false,drawer:false}">
    @if($href||$call)
    <button x-on:click="if(allowed){drawer=true}else{show=true;}" class="fixed bottom-0 w-screen sm:max-w-3xl bg-brown text-white text-xl font-semibold py-4" wire:loading.attr="disabled">
      {{__('e2e.trade.button.'.$button,["trader"=>__('e2e.trade.trader.'.$trade->type)])}}
    </button>
    @endif
    <div x-show='drawer' @click.outside="drawer=false" x-cloak>
      <livewire:e2-e.contact :href="$href" :call="$call"/>
    </div>
    <livewire:e2-e.profile-check/>
  </div>
  <x-e2-e.loader/>
  <x-slot name="title">{{__('e2e.trade.title.'.$trade->type,['name'=>$trade->item->name])}}</x-slot>
  @push('meta')
  <meta property="og:title" content="{{__('e2e.trade.title.'.$trade->type,['name'=>$trade->item->name])}}">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:description" content="{{__('e2e.trade.title.'.$trade->type,['name'=>$trade->item->name]).' - '.$title.'. '.substr($trade->description,0,300)}}">
  <meta property="og:image" content="{{isset($trade->additional_info['image_url'])?$trade->additional_info['image_url']:$trade->item->image_url}}">
  @endpush
</div>