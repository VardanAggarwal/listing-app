<div class="max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between">
      <h1 class="font-bold text-2xl">{{__('ui.models.stories')}}</h1>
    <a href="\stories\new">
      <x-jet-button>{{__('Add new')}}</x-jet-button>
    </a>
    </div>
    <div class="mt-4 relative">
      <x-jet-input name="search" type="text" placeholder="{{__('Type to search')}}" wire:model="query" wire:keydown.enter="resetPage" class="w-full"></x-jet-input>
      @if($this->query)
      <span wire:click="$set('query','')"class="absolute top-2.5 right-2"><i class="fas fa-times"></i></span>
      <div class="mt-2">{{__('Results for')}}: {{$this->query}}</div>
      @endif
    </div>
    @foreach ($feed as $item)
        <div class=" my-5 px-6 py-4 rounded-lg shadow border">    
            <x-story-card :model="$item"  :index="$loop->index"/>
        </div>
        @if ($loop->index==2)
          <x-card-add-interests :type="'story'"/>
        @endif
    @endforeach
  <div
      x-data="{
          observe () {
              let observer = new IntersectionObserver((entries) => {
                  entries.forEach(entry => {
                      if (entry.isIntersecting) {
                          @this.call('loadMore')
                      }
                  })
              }, {
                  root: null
              })

              observer.observe(this.$el)
          }
      }"
      x-init="observe"
  ></div>
  <div class="flex justify-center">
    <img  wire:loading loading="lazy" class="" src="https://listing-app.s3.ap-south-1.amazonaws.com/public/loader.gif">
  </div>
  @if($feed->hasMorePages())
    <x-jet-button wire:loading.remove wire:click.prevent="loadMore" class="text-center">{{__('Load More')}}</x-jet-button>
    @else
    <div class="text-center">{{__('No more records')}}</div>
  @endif
@push('meta')
<meta property="og:title" content="Seed Savers Club - {{__('ui.models.stories')}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:image" content="{{$feed->first(function($value,$key){
  return $value->image_url;
})->image_url??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
@endpush
</div>