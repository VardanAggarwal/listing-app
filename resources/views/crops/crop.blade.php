<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between mb-4 items-center">
      <h1 class="flex-shrink font-semibold text-2xl">{{$crop->name}}</h1>
      <a href="{{route('addCrop')}}" class="flex-none">
        <x-jet-button>
          {{__('Add new Crop')}}
        </x-jet-button>
      </a>
    </div>  
      <div><p>{{$crop->description}}</p></div>
      @if($crop->links)
        <a href="{{$crop->links}}" target="_blank"class="underline">{{__('See more...')}}</a>
      @endif
  </div>
</x-guest-layout>