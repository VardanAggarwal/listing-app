<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$listing->profile->business_name}} {{__('wants to')}} {{__($listing->type)}} {{$listing->name}}</span>
    <div class="flex">
      @foreach ($listing->resiliencies as $resiliency)
      <a href="/{{Str::plural(Str::lower(Str::replace('App//Models//','',$resiliency->resilient_type)))}}/{{$resiliency->resilient_id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
      @endforeach
    </div>
    <div class="mt-4 grid grid-cols-2 sm:grid-cols-8 gap-4 items-center">
        @if($listing->image)
        <div class="col-span-2 sm:col-span-2 justify-self-center"><img src="{{$listing->image}}" class="max-h-32" /></div>
        @endif
        <div class="text-center col-span-1 sm:col-span-3">
            <span class="font-semibold text-lg">{{__('Type')}}: {{__($listing->item_type)}}</span><br>
            <span>{{__('Price')}}: {{$listing->price}} </span><br>
            <span>{{__('Total')}} {{__('quantity')}}: {{$listing->total_qty}}</span><br>
        </div>
        <div class="text-center col-span-1 sm:col-span-3">
            <span class="font-semibold text-lg">{{__('Address')}}: {{$listing->profile->address}}</span><br>
            <span>
              @if($listing->price_negotiable)
                {{__('Price negotiable')}}
              @endif
            </span><br>
            <span>{{__('Minimum')}} {{__('quantity')}}: {{$listing->min_qty}}</span><br>
        </div>
    </div>
    <div class="mt-4">
      <span class="font-semibold text-m">{{__('Transportation')}}</span>      
     <div class="">{{$listing->logistic_terms}}</div>
    </div>
    <div class="mt-4">
      <span class="font-semibold text-m">{{__('Payment')}}</span>      
     <div class="">{{$listing->payment_terms}}</div>
    </div>
    @if($listing->profile->contact_number)
      <div class="mt-4">
        <span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$listing->profile->user->name,'contact'=>$listing->profile->contact_number,'services'=>$listing->name])}}</span>         
      </div>
    @endif
  </div>

</x-guest-layout>