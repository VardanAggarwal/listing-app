<div class="max-w-7xl mx-4 sm:mx-auto" wire:loading.delay.class='opacity-50'>
  @livewire('post-statement')
  <div class="flex justify-between">
    <h1 class="font-bold text-2xl">{{__('ui.models.feed')}}</h1>
  </div>
  @foreach ($feed as $item)
    <x-feed-card :item="$item"/>
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
<meta property="og:title" content="Seed Savers Club">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:image" content="https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png">
@endpush