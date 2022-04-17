<div class="p-4 grid rounded-xl justify-items-center shadow-lg bg-white">
    @if($image)
        <img src="{{$image}}" class="h-24 sm:h-36 mb-2 object-cover w-full" loading="lazy"/>
    @endif
    <span class="text-brown text-lg font-semibold">{{ucwords($title)}}</span>
    @foreach($data as $string)
        <span class="text-black">{{ucwords($string)}}</span>
    @endforeach
    @if($updated)
        <span class="text-xs text-black italic">Last updated: {{$updated}}</span>
    @endif
</div>
