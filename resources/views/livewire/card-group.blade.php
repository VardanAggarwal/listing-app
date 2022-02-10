<div wire:init="getFeed">
    <div wire:loading class="mb-6 w-full rounded-lg shadow-md bg-gray-100 p-4">
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-full h-24 mb-4 animate-pulse"></div>
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-full h-6 mb-4 animate-pulse"></div>
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-3/4 h-6 mb-4 animate-pulse"></div>
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-3/4 h-6 mb-4 animate-pulse"></div>
    </div>
    @if($show)
        <div class="mb-6 rounded-lg shadow-md bg-gray-100 pt-4 pl-3" wire:loading.class="opacity-20" x-on:click="mixpanel.track('Card Group Shown',{'position':'{{$index}}'})">
            <span class="text-lg">{{$title}}</span>
            <div class="flex items-center overflow-auto gap-4 pr-5 py-4">
                @forelse($feed as $item)
                    <div class="flex-none w-10/12 sm:w-96" x-on:click="mixpanel.track('Card Clicked',{'position':'{{$loop->index}}'})">@livewire('simple-card',['model'=>$item, 'index'=>$loop->index, 'group_index'=>$index,'type'=>$type])</div>
                @empty
                    <div class="flex justify-center"><a class="underline" href="/resiliencies">{{__('Follow some resiliencies to get personalised information')}}</a></div>
                @endforelse
            </div>
        </div>
    @endif
</div>
