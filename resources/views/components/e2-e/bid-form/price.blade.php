<div class="mt-4">
  <div class="flex justify-between">
    <x-jet-label for="price" value="{{__('e2e.bid-form.price.'.$item_type)}}" class="text-brown font-semibold text-xl" />
    @if($prices)
      <span class="float-right text-blue">{{__('e2e.global.units.rupees').' '}}{{$prices->min}} - {{$prices->max}}/{{__('e2e.global.units.kg')}}</span>
    @else
    <span class="float-right text-blue underline" wire:click="checkPrice">{{__('e2e.bid-form.check_price')}}</span>
    @endif
  </div>
  <div class="flex items-center">
    <span class="text-brown rounded-xl p-1 text-lg mr-2">{{__('e2e.global.units.rupees')}}</span>
    <input class="px-4 block rounded-xl border-brown w-full bg-white" {{$attributes}} type="text"autofocus placeholder="500"/>
    <span class="text-brown rounded-xl p-1 text-lg mr-2">/{{__('e2e.global.units.kg')}}</span>
  </div>
</div>