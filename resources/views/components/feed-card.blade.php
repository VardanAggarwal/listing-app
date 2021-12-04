<div class=" my-5 px-6 py-4 mx-4 rounded-lg shadow border">
    <div class="border-b border-gray-200 mb-3">
        <span>
            @if($type=='reliable')
                @unless(App::isLocale('hi'))
                    {{__('for')}} 
                @endunless
                <a href="/resiliencies/{{$item->resiliency->id}}"  class="underline">{{Str::ucfirst($item->resiliency->name)}}</a>
                @if(App::isLocale('hi'))
                    {{__('for')}} 
                @endif
                ,
            @endif
            @if($item_type=='story'||$item_type=='agrimodel')
            {{__('ui.new_m')}}
            @else
            {{__('ui.new_f')}}
            @endif 
            <a href="/{{Str::plural($item_type)}}/" class="underline">
            {{Str::ucfirst(__($item_type))}}</a>
        </span>
    </div>
    @if($type=='resiliency')
        <x-resiliency-card :resiliency="$item->resiliency"/>
    @else
        @php
        $component=$item_type.'-card';
        @endphp
        <x-dynamic-component :component="$component" :model="$item->feedable"/>
    @endif
</div>