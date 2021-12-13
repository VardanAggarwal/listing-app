<div class="py-8 max-w-7xl mx-4 sm:mx-auto" wire:loading.delay.class='opacity-50'>
  <div class="flex justify-between">
    <h1 class="font-bold text-2xl">{{__('ui.models.feed')}}</h1>
  </div>
  @foreach ($feed as $item)
    <x-feed-card :item="$item"/>
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
