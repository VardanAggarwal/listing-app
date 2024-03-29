<div class="max-w-7xl mx-4 sm:mx-auto">
  <div class="relative">
  <x-jet-input type="text" placeholder="{{__('Type to search')}}" wire:model="query" wire:keydown.enter="resetPage" class="w-full"></x-jet-input>
  @if($query)
    <span wire:click="$set('query','')"class="absolute top-2.5 right-2"><i class="fas fa-times"></i></span>
  @endif
  </div>
  @if($results)
    <div class="flex gap-4 mt-2 border-b items-center">
      <span class="font-bold px-2 py-1 {{$search_type=='Profile'?'bg-green-50 border-b-4 border-green-500':''}} cursor-pointer" wire:click="$set('search_type','Profile')">{{__('ui.models.profiles')}}</span>
      <span class="font-bold px-2 py-1 {{$search_type=='Resiliency'?'bg-green-50 border-b-4 border-green-500':''}} cursor-pointer" wire:click="$set('search_type','Resiliency')">{{__('ui.models.resiliencies')}}</span>
      <span class="font-bold px-2 py-1 {{$search_type=='Listing'?'bg-green-50 border-b-4 border-green-500':''}} cursor-pointer" wire:click="$set('search_type','Listing')">{{__('ui.models.listings')}}</span>
      <span class="font-bold px-2 py-1 {{$search_type=='Story'?'bg-green-50 border-b-4 border-green-500':''}} cursor-pointer" wire:click="$set('search_type','Story')">{{__('ui.models.stories')}}</span>
    </div>
    @foreach($results as $item)
    <div class=" my-5 px-6 py-4 rounded-lg shadow border" >
      @if(str_contains($search_type,'Profile'))
          @livewire('expert.card',['profile'=>$item,'index'=>$loop->index],key('expert-'.$loop->index))
      @else
          @php
          $component=$search_type.'-card';
          @endphp
          <x-dynamic-component :component="$component" :model="$item" :index="$loop->index"/>
      @endif    
      </div>
    @endforeach
    @if($results->hasMorePages())
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
      <x-jet-button wire:loading.remove wire:click.prevent="loadMore" class="text-center">{{__('Load More')}}</x-jet-button>
      @else
      <div class="text-center">{{__('No more records')}}</div>
    @endif
@endif
</div>