<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    @if($profile->id==Auth::user()->profile->id)
      <a href="/profile"><span class="float-right"><i class="fas fa-pen"></i></span></a>
    @endif
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
              {{$profile->address}}, {{$profile->pincode}}
            </span><br>
            <span>
              {{$profile->contact_number}}
            </span><br>
        </div>
    </div>
    @if($profile->interest_resiliencies_count)
      <div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
        <span class="font-semibold text-lg">{{__('ui.models.resiliencies')}}</span>
        <div class="flex overflow-auto flex-nowrap">
                    @foreach ($profile->interest_resiliencies as $resiliency)
                    <a href="/resiliencies/{{$resiliency->id}}" class="mr-4 inline-flex  whitespace-nowrap items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
                    @endforeach
                  </div>                
      </div>
    @endif
    @if($profile->stories_count)
      <div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
        <div class="flex justify-between items-center">
          <span class="font-semibold text-lg">{{__('story')}}</span>
          <a href="\stories\new">
            <x-jet-button>{{__('Add new')}}</x-jet-button>
          </a>
        </div>
      @livewire('relationship-filtered-list',['relation'=>'stories','model'=>$profile])
      </div>
    @else
      @if($profile->id==Auth::user()->profile->id)
        <div class="mt-4 w-full grid justify-items-center">
          <a href="\stories\new">
            <x-jet-button>{{__('Share your experience')}}</x-jet-button>
          </a>
        </div>
      @endif
    @endif

    @if($profile->listings_count)
      <div class="max-w-7xl  sm:mx-auto mt-4 border-b  py-4">
        <div class="flex justify-between items-center">
          <span class="font-semibold text-lg">{{__('listing')}}</span>
          <a href="\listings\new">
            <x-jet-button>{{__('Add new')}}</x-jet-button>
          </a>
        </div>
        @livewire('relationship-filtered-list',['relation'=>'listings','model'=>$profile])
      </div>
    @else
      @if($profile->id==Auth::user()->profile->id)
        <div class="mt-4 w-full grid justify-items-center">
          <a href="\listings\new">
            <x-jet-button>{{__('Add your listing')}}</x-jet-button>
          </a>
        </div>
      @endif
    @endif
  </div>
</x-guest-layout>