<div class="w-full h-full relative grid rounded-xl justify-items-center shadow-lg bg-white">
    @if($type)
        <div class="absolute px-2 py-1 top-3 left-0 {{$type=='buy'?'bg-primary':'bg-red'}}"><span class="text-xs float-right {{$type=='buy'?'text-black':'text-white'}}">{{__('e2e.cards.trade_type.'.$type)}}</span></div>
    @endif
    <img src="{{$image}}" class="rounded-t-xl h-24 sm:h-36 object-cover w-full" loading="lazy"/>
    <div class="p-2 grid justify-items-center items-center text-center">
    <span class="text-brown font-semibold">{{ucwords($title)}}</span>
    @foreach($strings as $string)
        <span class="text-black text-sm">{{ucwords($string)}}</span>
    @endforeach
    @if($updated)
        <span class="text-xs text-black italic">{{__('e2e.cards.date')}}: {{$updated}}</span>
    @endif
    </div>
</div>
