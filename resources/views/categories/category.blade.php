<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between mb-4 items-center">
      <h1 class="flex-shrink font-semibold text-2xl">{{$category->name}}</h1>
      <a href="{{route('addCategory')}}" class="flex-none">
        <x-jet-button>
          {{__('Add new category')}}
        </x-jet-button>
      </a>
    </div>  
      <div><p>{{$category->description}}</p></div>
      @if($category->links)
        <a href="{{$category->links}}" target="_blank"class="underline">{{__('See more...')}}</a>
      @endif
  </div>
</x-guest-layout>