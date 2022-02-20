<div class="max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between">
      <h1 class="font-bold text-2xl">{{__('ui.models.resiliencies')}}</h1>
    <a href="\resiliencies\new">
      <x-jet-button>{{__('Add new')}}</x-jet-button>
    </a>
    </div>
    <div class="mt-4 relative">
      <x-jet-input name="search" type="text" placeholder="{{__('Type to search')}}" wire:model="query" wire:keydown.enter="resetPage" class="w-full"></x-jet-input>
      @if($this->query)
      <span wire:click="$set('query','')" class="absolute top-2.5 right-2"><i class="fas fa-times"></i></span>
      <div wire:click="$set('query','')" class="mt-2">{{__('Results for')}}: {{$this->query}}</div>
      @endif
    </div>
    @unless($query)
      <div class="mt-4 mb-4 bg-white">
        <div>@livewire('card-group',['index'=>-3,'type'=>'Resiliency', 'purpose'=>'recommended'],key('card-group-resiliency-recommended-0'))</div>
        <div>@livewire('card-group',['index'=>-2,'type'=>'Resiliency', 'purpose'=>'popular'],key('card-group-resiliency-popular-0'))</div>
        <div>@livewire('card-group',['index'=>-1,'type'=>'Resiliency', 'purpose'=>'latest'],key('card-group-resiliency-latest-0'))</div>
        @foreach($categories as $category)
            <div>@livewire('card-group',['index'=>$loop->index,'type'=>'Resiliency','purpose'=>'children','model'=>$category],key('card-group-resiliency-children-'.$loop->index))</div>
        @endforeach
        @if($categories->hasMorePages())
          <div class="flex justify-center">
            <img  wire:loading loading="lazy" class="" src="https://listing-app.s3.ap-south-1.amazonaws.com/public/loader.gif">
          </div>
          <div 
              x-data="{
                  observe () {
                      let observer = new IntersectionObserver((entries) => {
                          entries.forEach(entry => {
                              if (entry.isIntersecting) {
                                  @this.call('loadMore','cardCount')
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
        @endif
        <div>@livewire('card-group',['index'=>-4,'type'=>'Resiliency', 'purpose'=>'others','model'=>$others],key('card-group-resiliency-others-0'))</div>
      </div>    
    @endunless
    @if($query || !$categories->hasMorePages())
      @foreach ($feed as $item)
          <div class=" my-5 px-6 py-4 rounded-lg shadow border">
              <x-resiliency-card :model="$item" :index="$loop->index"/>
          </div>
          @if ($loop->index==2)
            <x-card-add-interests/>
          @endif
      @endforeach
    @endif
  <div
      x-data="{
          observe () {
              let observer = new IntersectionObserver((entries) => {
                  entries.forEach(entry => {
                      if (entry.isIntersecting) {
                          @this.call('loadMore','perPage')
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
<meta property="og:title" content="Seed Savers Club - {{__('ui.models.resiliencies')}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:image" content="{{$feed->first(function($value,$key){
  return $value->image_url;
})->image_url??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
@endpush
</div>
