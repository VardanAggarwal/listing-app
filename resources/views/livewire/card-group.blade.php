<div>
<div wire:init="getFeed">
    <div wire:loading class="mb-6 w-full rounded-lg shadow-md bg-gray-100 p-4">
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-full h-24 mb-4 animate-pulse"></div>
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-full h-6 mb-4 animate-pulse"></div>
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-3/4 h-6 mb-4 animate-pulse"></div>
        <div class="bg-gradient-to-l from-gray-200 to-gray-500 w-3/4 h-6 mb-4 animate-pulse"></div>
    </div>
    @if($show)
        @php
            $parent=$model?str_replace("App\\Models\\","",get_class($model)):null;
            $parent_id=$model?(isset($model->id)?$model->id:null):null
        @endphp
        <div class="mb-6 rounded-lg shadow-md bg-gray-100 pt-4 pl-3" wire:loading.class="opacity-20" x-init="mixpanel.track('Card Group Shown',{'position':'{{$index}}','type':'{{$type}}','purpose':'{{$purpose}}','parent':'{{$model?$parent:null}}','parent_id':'{{$parent_id}}'})">
            <div class="flex justify-start gap-4">
                @if($image)
                    <img src="{{$image}}" loading="lazy" class="h-8 w-8 rounded-full">
                @endif
                <span class="text-lg">{{$title}}</span>
            </div>
            <div class="flex items-center overflow-auto gap-4 pr-5 py-4">
                @forelse($feed as $item)
                    <div class="flex-none {{$type=='Profile'?'w-64':'w-10/12 sm:w-96'}}" x-on:click="mixpanel.track('Card Clicked',{'position':'{{$loop->index}}','group_position':'{{$index}}','type':'{{$type}}','id':'{{$item->id}}','purpose':'{{$purpose}}','parent':'{{$model?$parent:null}}','parent_id':'{{$parent_id}}'})">
                        <div class="border p-4 bg-white shadow-md rounded-lg">
                            @switch($type)
                            @case('Statement')
                                <x-statement-card :model='$item' :index='$loop->index'/>
                                @break
                            @case('Profile')
                                @livewire('expert.card',['profile'=>$item,'index'=>$loop->index])
                                @break
                            @default
                                @livewire('simple-card',['model'=>$item, 'index'=>$loop->index, 'group_index'=>$index,'type'=>$type])
                                @break
                            @endswitch
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center"><a class="underline" href="/resiliencies">{{__('Follow some resiliencies to get personalised information')}}</a></div>
                @endforelse
            </div>
        </div>
    @endif
</div>
</div>