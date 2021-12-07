<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-3xl text-green-900">{{$resiliency->name}}</span><br>
    <span class="font-semibold text-lg text-gray-600">{{__($resiliency->type)}}</span>
    <div class="grid grid-cols-1 sm:grid-cols-8 gap-4 border-b py-4">
      @if($resiliency->image_url)
      <div class="sm:col-span-1 justify-self-center"><img src="{{$resiliency->image_url}}" class="rounded-lg h-24 w-24" /></div>
      @endif
      <div class="sm:col-span-7">
          <div class="flex overflow-auto">
            @foreach ($resiliency->categories as $category)
            <a href="/categories/{{$category->id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$category->name}}</a>
            @endforeach
          </div>
          <div class="prose">{!!$resiliency->description!!}</div>
          @if($resiliency->links)
            <a href="{{$resiliency->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
          @endif
      </div>
    </div>
    @if($resiliency->stories_count)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b py-4">
        {{__('Related')}} {{__('story')}}
      @livewire('relationship-filtered-list',['relation'=>'stories','model'=>$resiliency])
      </div>
    @endif

    @if($resiliency->listings_count)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b  py-4">
        {{__('Related')}} {{__('listing')}}
      @livewire('relationship-filtered-list',['relation'=>'listings','model'=>$resiliency])
      </div>
    @endif
  </div>
</x-guest-layout>