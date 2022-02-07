<div>
    @if($show)
        <div class="bg-gray-100 py-4 pl-3" wire:init="getFeed" wire:loading.class="opacity-20">
            <span class="text-lg">{{__($title)}}</span>
            <div class="flex items-center overflow-auto gap-4 pr-5">
                @forelse($feed as $item)
                    <div class="flex-none w-10/12 sm:w-96" x-on:click="mixpanel.track('Card Clicked',{'position':'{{$loop->index}}'})">@livewire('simple-card',['model'=>$item, 'index'=>$loop->index, 'group_index'=>$index,'type'=>'Resiliency'])</div>
                @empty
                    <div class="flex justify-center"><a class="underline" href="/resiliencies">{{__('Follow some resiliencies to get personalised information')}}</a></div>
                @endforelse
            </div>
            <div class="flex justify-center">
              <img  wire:loading loading="lazy" class="" src="https://listing-app.s3.ap-south-1.amazonaws.com/public/loader.gif">
            </div>
        </div>
    @endif
</div>
