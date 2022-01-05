<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between items-center">
      <div>
        <span class="font-semibold text-3xl text-green-900">{{$resiliency->name}}</span><br>
        <span class="font-semibold text-lg text-gray-600">{{__($resiliency->type)}}</span>
      </div>
      <div>
        <div class="rating text-yellow-400">
          {!! str_repeat('<span><i class="fas fa-star"></i></span>', intval($resiliency->stories->avg('rating'))) !!}{!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - intval($resiliency->stories->avg('rating'))) !!}
        </div>
        <p class="text-right">{{$resiliency->stories->count().' '.__('ui.models.stories')}}</p>
      </div>
    </div>
    <div>
        @livewire('card-interests',['model'=>$resiliency,'type'=>'Resiliency'])
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-8 gap-4 border-b py-4">
      @if($resiliency->image_url)
      <div class="sm:col-span-1 justify-self-center"><img src="{{$resiliency->image_url}}" class="rounded-lg h-24 w-24 object-cover" /></div>
      @endif
      <div class="sm:col-span-7">
          <div class="flex overflow-auto flex-nowrap">
            @foreach ($resiliency->categories as $category)
            <a href="/categories/{{$category->id}}" class="mr-4 inline-flex  whitespace-nowrap items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$category->name}}</a>
            @endforeach
          </div>
          <div class="prose">{!!$resiliency->description!!}</div>
          @if($resiliency->links)
            <a href="{{$resiliency->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
          @endif
      </div>
      @if($resiliency->description)
        <div class="sm:col-span-8">
            @livewire('card-interests',['model'=>$resiliency,'type'=>'Resiliency'])
        </div>
      @endif
    </div>
    @if($resiliency->stories_count)
      <div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
        <div class="flex justify-between items-center">
          <span class="font-semibold text-lg">{{__('Related')}} {{__('story')}}</span>
          <a href="\stories\new">
            <x-jet-button>{{__('Add new')}}</x-jet-button>
          </a>
        </div>
      @livewire('relationship-filtered-list',['relation'=>'stories','model'=>$resiliency])
      </div>
    @else
    <div class="mt-4 w-full grid justify-items-center">
      <a href="\stories\new">
        <x-jet-button>{{__('Share your experience')}}</x-jet-button>
      </a>
    </div>
    @endif

    @if($resiliency->listings_count)
      <div class="max-w-7xl sm:mx-auto mt-4 border-b  py-4">
        <div class="flex justify-between items-center">
          <span class="font-semibold text-lg">{{__('Related')}} {{__('listing')}}</span>
          <a href="\listings\new">
            <x-jet-button>{{__('Add new')}}</x-jet-button>
          </a>
        </div>
      @livewire('relationship-filtered-list',['relation'=>'listings','model'=>$resiliency])
      </div>
    @else
    <div class="mt-4 w-full grid justify-items-center">
      <a href="\listings\new">
        <x-jet-button>{{__('Add your listing')}}</x-jet-button>
      </a>
    </div>
    @endif
  </div>
  @push('meta')
  <meta property="og:title" content="{{$resiliency->name}}">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="og:type" content="article">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:description" content="{{Str::limit(strip_tags($resiliency->description),300)}}">
  <meta property="og:image" content="{{$resiliency->image_url??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
  @endpush
</x-guest-layout>