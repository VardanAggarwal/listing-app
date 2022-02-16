<div class="max-w-7xl mx-4 sm:mx-auto">
  @livewire('post-statement')
  <div class="flex justify-between">
    <h1 class="font-bold text-2xl">{{__('ui.models.feed')}}</h1>
  </div>
  @livewire('card-group',['index'=>0,'type'=>'Listing'],key('card-group-listing-recommended-0'))
  @livewire('card-group',['index'=>1,'type'=>'Story'],key('card-group-story-recommended-1'))
  @livewire('card-group',['index'=>2,'type'=>'Resiliency'],key('card-group-resiliency-recommended-2'))
  @livewire('card-group',['index'=>3,'type'=>'Profile','purpose'=>'latest'],key('card-group-profile-new-3'))
  @livewire('card-group',['index'=>4,'type'=>'Listing','purpose'=>'latest'],key('card-group-listing-new-4'))
  @livewire('card-group',['index'=>5,'type'=>'Statement','purpose'=>'latest'],key('card-group-statement-new-5'))
  @livewire('card-group',['index'=>6,'type'=>'Story','purpose'=>'latest'],key('card-group-story-new-6'))
  @livewire('card-group',['index'=>7,'type'=>'Resiliency','purpose'=>'latest'],key('card-group-resiliency-new-7'))
  @for($i=1;$i<=$cardCount;$i++)
    @if($resiliencies[$i])
      @livewire('card-group',['index'=>$i*4+7,'type'=>'Profile','purpose'=>'children','model'=>$resiliencies[$i]],key('card-group-profile-children-'.$i*4+7))
      @livewire('card-group',['index'=>$i*4+8,'type'=>'Listing','purpose'=>'children','model'=>$resiliencies[$i]],key('card-group-listing-children-'.$i*4+8))
      @livewire('card-group',['index'=>$i*4+9,'type'=>'Story','purpose'=>'children','model'=>$resiliencies[$i]],key('card-group-story-children-'.$i*4+9))
    @endif
    @if($categories[$i])
      @livewire('card-group',['index'=>$i*4+10,'type'=>'Resiliency','purpose'=>'children','model'=>$categories[$i]],key('card-group-resiliency-children-'.$i*4+10))
    @endif
  @endfor
  @if($resiliencies->hasMorePages()||$categories->hasMorePages())
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
  @foreach ($feed as $item)
    <x-feed-card :item="$item" :index="$loop->index"/>
    @switch($loop->index)
      @case(2)
        <x-card-add-interests/>
        @break
    @endswitch
  @endforeach
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
  <meta property="og:title" content="Seed Savers Club">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="og:type" content="article">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:image" content="https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png">
  @endpush
</div>
