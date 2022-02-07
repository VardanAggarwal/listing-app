<div class="border p-4 bg-white">
    @if($image)
        <a href="{{$url}}" class="text-xl"><img src="{{$image}}" class="h-24 object-cover w-64" loading="lazy"/></a>
        @if($title)
            <a href="{{$url}}" class="text-xl"><div class="max-h-12 overflow-hidden text-ellipsis text-xl">{{$title}}</div></a>
        @else
            <a href="{{$url}}" class=""><div class="max-h-12 overflow-hidden text-ellipsis">{{$subtitle}}</div></a>    
        @endif
    @elseif($title)
        <a href="{{$url}}" class="text-xl"><div class="max-h-12 overflow-hidden text-ellipsis text-xl">{{$title}}</div></a>
        <a href="{{$url}}" class=""><div class="max-h-20 overflow-hidden text-ellipsis">{{$subtitle}}</div></a>
    @else
        <a href="{{$url}}"><div class="max-h-36 overflow-hidden text-ellipsis text-xl">{{$subtitle}}</div></a>
    @endif
    <x-inline-profile :model='$model'/>
</div>
