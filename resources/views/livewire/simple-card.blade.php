<div>
    @if($image)
        <a href="{{$url}}" class="text-xl"><img src="{{$image}}" class="h-24 sm:h-36 mb-2 object-cover w-full" loading="lazy"/></a>
        @if($title)
            <a href="{{$url}}" class="text-xl"><div class="leading-6 max-h-12 overflow-hidden text-ellipsis text-xl">{{$title}}</div></a>
        @else
            <a href="{{$url}}" class=""><div class="leading-6 max-h-12 overflow-hidden text-ellipsis">{{$subtitle}}</div></a>    
        @endif
    @elseif($title)
        <a href="{{$url}}" class="text-xl"><div class="leading-6 max-h-12 overflow-hidden text-ellipsis text-xl mb-2">{{$title}}</div></a>
        <a href="{{$url}}" class=""><div class="max-h-24 overflow-hidden text-ellipsis">{{$subtitle}}</div></a>
    @else
        <a href="{{$url}}"><div class="max-h-36 overflow-hidden text-ellipsis text-xl">{{$subtitle}}</div></a>
    @endif
    <x-inline-profile :model='$model'/>
    @livewire('card-interests',['model'=>$model,'type'=>$type], key('card-group-'.$group_index.'-card_pos-'.$index.'-'.$type.'-'.$model->id))
</div>
