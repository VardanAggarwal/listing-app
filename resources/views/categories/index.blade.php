<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between mx-4 mb-4 items-center">
      <h1 class="flex-shrink font-semibold text-2xl">{{__('Categories')}}</h1>
      <a href="{{route('addCategory')}}" class="flex-none">
        <x-jet-button>
          {{__('Add new Category')}}
        </x-jet-button>
      </a>
    </div>
  @foreach ($categories as $category)
    <div class=" my-5 px-6 py-4 mx-4 rounded shadow">
      <span class="font-semibold text-xl text-green-900">{{$category->name}}</span>  
      <div class="overflow-ellipsis overflow-hidden h-12">{{$category->description}}</div>
      <a href="/categories/{{$category->id}}" class="underline">{{__('See more...')}}</a>
    </div>
  @endforeach
  </div>
</x-guest-layout>