<div class="mt-4">
  <div class="flex justify-between"><x-jet-label for="quantity" value="{{__('e2e.bid-form.quantity.'.$item_type.'.'.$type)}}" class="text-brown font-semibold text-xl" /></div>
  <div class="flex items-center">
    <input class="px-4 block rounded-xl border-brown w-full bg-white" {{$attributes}} type="text"autofocus placeholder="500"/>
    <span class="text-brown rounded-xl p-1 text-lg mr-2">Kg</span>
  </div>
</div>