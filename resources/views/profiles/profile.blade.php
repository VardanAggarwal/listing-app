<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="text-center sm:text-left font-semibold text-2xl text-green-900">
      <span>{{$profile->user->name}}</span><br>
    </div>
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-8 gap-4">
        @if($profile->user->profile_photo_url)
        <div class="col-span-1 sm:col-span-1 justify-self-center"><img src="{{$profile->user->profile_photo_url}}" class="max-h-32" /></div>
        @endif
        <div class="text-center sm:text-left col-span-1 sm:col-span-3">
            <div class="grid justify-items-center sm:justify-items-start">
            </div>
            <span class="font-semibold text-lg">
              {{$profile->pincode}}, {{$profile->address}}
            </span><br>
            <span>
              {{$profile->contact_number}}
            </span><br>
        </div>
    </div>
    @if($profile->stories_count)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b py-4">
         {{__('story')}}
      @livewire('relationship-filtered-list',['relation'=>'stories','model'=>$profile])
      </div>
    @endif

    @if($profile->listings_count)
      <div class="font-semibold text-lg max-w-7xl  sm:mx-auto mt-4 border-b  py-4">
      {{__('listing')}}
      @livewire('relationship-filtered-list',['relation'=>'listings','model'=>$profile])
      </div>
    @endif
  </div>
</x-guest-layout>