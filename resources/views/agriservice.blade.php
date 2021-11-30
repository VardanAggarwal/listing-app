<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$agriservice->profile->business_name}} {{__('is offering')}} {{$agriservice->title}}</span>
    <div class="flex">
      @foreach ($agriservice->resiliencies as $resiliency)
      <a href="/{{Str::plural(Str::lower(Str::replace('App//Models//','',$resiliency->resilient_type)))}}/{{$resiliency->resilient_id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
      @endforeach
    </div>
    <div class="grid grid-cols-3">
      <span class="font-medium text-xl">{{$agriservice->profile->address}}</span>
      <span class="col-span-1">{{__('Type')}}:  {{Str::ucfirst(Str::replace('_',' ',__($agriservice->type)))}}</span>
      <span class="col-span-1">{{__('Charges')}}: {{$agriservice->charges}}</span>
    </div>
    <div class="mt-4">
      <span class="font-semibold text-m text-green-900">{{__('Description')}}</span>
      <div>{{$agriservice->description}}</div>
    </div>
    <div class="mt-4">
      <span class="font-semibold text-m text-green-900">{{__('Terms')}}</span>
      <div>{{$agriservice->terms}}</div>
    </div>
    <div class="mt-4">
      <span class="font-semibold text-m text-green-900">{{__('How to avail')}}</span>
      <div>{{$agriservice->how_to}}</div>
    </div>
    <div class="mt-4">
      <span class="font-semibold text-m text-green-900">{{__('Who can benefit')}}</span>
      <div>{{__('locations')}}: {{$agriservice->serviceable_locations}}</div>
      <div>
        @php
        if($agriservice->target_audience=='farmers'){
          $requirement=$agriservice->min_audience.' '.__('acres');
        }
        else{
          $requirement=$agriservice->min_audience.' '.__('farmers');
        }
        @endphp

        <span>{{__('ui.serviceable_audience',[
        'audience'=>__($agriservice->target_audience),'requirement'=>$requirement])}}</span>
      </div>
    </div>
    @if($agriservice->profile->contact_number)
      <div class="mt-4">
        <span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$agriservice->profile->user->name,'contact'=>$agriservice->profile->contact_number,'services'=>$agriservice->title])}}</span>         
      </div>
    @endif
  </div>
</x-guest-layout>