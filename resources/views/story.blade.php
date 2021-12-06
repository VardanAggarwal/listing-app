<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$story->title}}</span><br>
    <div class="rating text-yellow-400">
        {!! str_repeat('<span><i class="fas fa-star"></i></span>', $story->rating) !!}
        {!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - $story->rating) !!}
    </div>
    <div class="my-4 grid grid-cols-1 sm:grid-cols-8 gap-4 items-center">
      @if($story->image_url)
        <div class="col-span-1 sm:col-span-2 justify-self-center">
          <img src="{{$story->image_url}}" class="rounded-lg h-24 w-24" />
        </div>
      @endif
      <div class="col-span-1 sm:col-span-6">
        <div class="">
          <div class="">{{$story->review}}</div>
        </div>
        @if($story->profile)
          @if($story->profile->contact_number)
          <div class="mt-4">
            <span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$story->profile->user->name,'contact'=>$story->profile->contact_number])}}</span>         
          </div>
          @endif
        @endif
    </div>
  </div>
  @if($story->links)
    <a href="{{$story->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
  @endif
  @if($story->resiliencies)
    <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b  py-4">
      {{__('Related')}} {{__('ui.models.resiliencies')}}
    @livewire('relationship-filtered-list',['relation'=>'resiliencies','model'=>$story])
    </div>
  @endif
  </div>

</x-guest-layout> 
