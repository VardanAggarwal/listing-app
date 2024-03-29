<div class="max-w-7xl sm:mx-auto" wire:loading.delay.class='opacity-50'>
    @foreach ($feed as $item)
        <div class=" my-5 px-4 py-4 rounded-lg {{$type=='statement'?'bg-gray-200':''}} shadow border">
        @if(str_contains($type,'resiliency'))
            <x-resiliency-card :model="$item" :index="$loop->index"/>
        @elseif(str_contains($type,'statement'))
            <x-comment-card :model="$item" :index="$loop->index"/>
        @else
            @php
            $component=$type.'-card';
            @endphp
            <x-dynamic-component :component="$component" :model="$item" :index="$loop->index"/>
        @endif    
        </div>
    @endforeach
  @if($feed->hasMorePages())
    <div class="grid justify-items-center">
      <x-jet-button wire:click.prevent="loadMore" class="text-center">{{__('Load More')}}</x-jet-button>
    </div>
  @endif
  @if($type=='resiliency')
      <x-card-add-interests/>
  @endif
  </div>
