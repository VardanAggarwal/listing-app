<div class="relative grid rounded-xl justify-items-center shadow-lg bg-white">
    @if($type)
        <div class="absolute px-2 py-1 top-2 left-0 {{$type=='buy'?'bg-primary':'bg-red'}}"><span class="text-xs float-right {{$type=='buy'?'text-black':'text-white'}}">{{__('e2e.cards.trade_type.'.$type)}}</span></div>
    @endif
    @if($image)
        <img src="{{$image}}" class="h-24 sm:h-36 object-cover w-full" loading="lazy"/>
    @endif
    <div class="p-4 grid justify-items-center">
    <span class="text-brown text-lg font-semibold">{{ucwords($title)}}</span>
    @foreach($strings as $string)
        <span class="text-black">{{ucwords($string)}}</span>
    @endforeach
    @if($updated)
        <span class="text-xs text-black italic">{{__('e2e.cards.date')}}: {{$updated}}</span>
    @endif
    </div>
</div>
