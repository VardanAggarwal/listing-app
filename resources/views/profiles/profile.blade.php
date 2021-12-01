<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="text-center sm:text-left font-semibold text-2xl text-green-900">
      <span>{{$profile->user->name}},</span><br>
      <span>{{$profile->business_name}}</span>
    </div>
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-8 gap-4">
        @if($profile->user->profile_photo_url)
        <div class="col-span-1 sm:col-span-1 justify-self-center"><img src="{{$profile->user->profile_photo_url}}" class="max-h-32" /></div>
        @endif
        <div class="text-center sm:text-left col-span-1 sm:col-span-3">
            <div class="grid justify-items-center sm:justify-items-start">
              @foreach ($profile->userTypes as $role)
              <span class="mr-4 inline-flex items-center py-1 px-2 bg-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest focus:ring focus:ring-gray-300 border">{{$role->name}}</span>
              @endforeach
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

    @if($profile->profiles_count)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b  py-4">
      {{__('profile')}}
      @livewire('relationship-filtered-list',['relation'=>'profiles','model'=>$profile])
      </div>
    @endif
    @if($profile->agriservices_count)
      <div class="font-semibold text-lg max-w-7xl  sm:mx-auto mt-4 border-b  py-4">
      {{__('agriservice')}}
      @livewire('relationship-filtered-list',['relation'=>'agriservices','model'=>$profile])
      </div>
    @endif
  </div>
</x-guest-layout>