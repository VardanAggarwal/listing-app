<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between mb-4 items-center">
      <h1 class="flex-shrink font-semibold text-2xl">{{$crop->resiliency->name}}</h1>
      <a href="{{route('addCrop')}}" class="flex-none">
        <x-jet-button>
          {{__('Add new Crop')}}
        </x-jet-button>
      </a>
    </div>
    <div class="flex">
      @foreach ($crop->resiliency->categories as $category)
      <a href="/categories/{{$category->id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$category->name}}</a>
      @endforeach
    </div>  
      <div><p>{{$crop->resiliency->description}}</p></div>
      @if($crop->resiliency->links)
        <a href="{{$crop->resiliency->links}}" target="_blank"class="underline">{{__('See more...')}}</a>
      @endif
  </div>
</x-guest-layout>