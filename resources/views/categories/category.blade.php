<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between mb-4 items-center">
      <h1 class="flex-shrink font-semibold text-2xl">{{$category->name}}</h1>
    </div>  
      <div><p>{{$category->description}}</p></div>
      @if($category->links)
        <a href="{{$category->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
      @endif
  </div>
  <div class="font-semibold text-lg max-w-7xl mx-6 sm:mx-auto">
    {{__('Related')}} {{__('items')}}
  </div>
  @livewire('relationship-filtered-list',['relation'=>'resiliencies','model'=>$category])
</x-guest-layout>