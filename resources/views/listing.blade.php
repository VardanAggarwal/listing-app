<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$listing->name}}</span><br>
    <span class="font-semibold text-lg text-gray-600">{{__($listing->type)}}</span>
    <div class="mt-4 flex gap-4 items-center ">
        @if($listing->image_url)
        <div class=""><img src="{{$listing->image_url}}" class="h-24 w-24 rounded" /></div>
        @endif
        <div class="">
            <span class="font-semibold text-lg">{{__('Type')}}: {{__($listing->item_type)}}</span><br>
            <span class="font-semibold text-lg">{{__('Price')}}: {{$listing->price}} </span><br>
            <span class="font-semibold text-lg">{{__('Address')}}: {{$listing->location}}</span><br>
        </div>
    </div>
    <div class="mt-4">      
     <div class="">{{$listing->description}}</div>
    </div>
    @if($listing->profile)
      @if($listing->profile->contact_number)
        <div class="mt-4">
          <span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$listing->profile->user->name,'contact'=>$listing->profile->contact_number])}}</span>
        </div>
      @endif
    @endif
    @if($listing->resiliencies)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b  py-4">
        {{__('Related')}} {{__('ui.models.resiliencies')}}
      @livewire('relationship-filtered-list',['relation'=>'resiliencies','model'=>$listing])
      </div>
    @endif
</div>

</x-guest-layout>