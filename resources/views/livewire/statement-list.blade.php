<div class="max-w-7xl mx-4 sm:mx-auto" wire:loading.delay.class='opacity-50'>
    <div class="flex justify-between items-center">
      <h1 class="font-bold text-2xl">{{__('ui.models.statements')}}</h1>
      <div class="relative">
        <x-jet-input name="search" type="text" placeholder="{{__('Type to search')}}" wire:model="query" wire:keydown.enter="resetPage" class="w-full"></x-jet-input>
        @if($this->query)
        <span wire:click="$set('query','')"class="absolute right-2 top-2"><i class="fas fa-times"></i></span>
        @endif
      </div>
    </div>
    @livewire('post-statement')
    <div class="mt-4 relative">
    </div>
    @foreach ($feed as $item)
        <div class=" my-5 px-6 py-4 rounded-lg shadow border">
            <x-statement-card :model="$item"  :index="$loop->index"/>
        </div>
        @if ($loop->index==2)
          <x-card-add-interests/>
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
  @if($feed->hasMorePages())
    <x-jet-button wire:click.prevent="loadMore" class="text-center">{{__('Load More')}}</x-jet-button>
    @else
    <div class="text-center">{{__('No more records')}}</div>
  @endif
  </div>
@push('meta')
<meta property="og:title" content="Seed Savers Club - {{__('ui.models.statements')}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:image" content="{{$feed->first(function($value,$key){
  return $value->image_url;
})->image_url??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
@endpush