<div class="py-8 max-w-7xl mx-4 sm:mx-auto" wire:loading.delay.class='opacity-50'>
    <div class="mx-4 flex justify-between">
      <h1 class="font-bold text-2xl">{{__('ui.models.stories')}}</h1>
    <a href="\story\new">
      <x-jet-button>{{__('Add new')}}</x-jet-button>
    </a>
    </div>
    @foreach ($feed as $item)
        <div class=" my-5 px-6 py-4 mx-4 rounded-lg shadow border">    
            <x-story-card :model="$item"/>
        </div>
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
