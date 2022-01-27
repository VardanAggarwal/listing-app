<div class=" my-5 px-6 py-4 rounded-lg shadow border">
    <div class="border-b border-gray-200 mb-3">
        <span>
            @if($type=='story'||$type=='statement')
                {{__('ui.new_m')}}
            @else
                {{__('ui.new_f')}}
            @endif
            <a href="/{{Str::plural($type)}}/" class="underline">
            {{Str::ucfirst(__('ui.models.'.Str::plural($type)))}}</a>
        </span>
    </div>
    @php
        $component=$type.'-card';
    @endphp
    <x-dynamic-component :component="$component" :model="$item->feedable" :index="$index"/>
</div>