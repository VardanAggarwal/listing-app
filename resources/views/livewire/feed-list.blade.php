<div class="max-w-7xl mx-4 sm:mx-auto">
  <div wire:key="post-statement">@livewire('post-statement',key('post-statement'))</div>
  <div class="flex justify-between">
    <h1 class="font-bold text-2xl">{{__('ui.models.feed')}}</h1>
  </div>
  <div wire:key="feed-list-pre-load">
  @livewire('card-group',['index'=>0,'type'=>'Profile','purpose'=>'latest'],key('card-group-profile-new-0'))
  @livewire('card-group',['index'=>1,'type'=>'Listing','purpose'=>'latest'],key('card-group-listing-new-1'))
  @livewire('card-group',['index'=>2,'type'=>'Statement','purpose'=>'latest'],key('card-group-statement-new-2'))
  </div>
  <div wire:key="feed-list-post-load">
  @if($load)
  @livewire('card-group',['index'=>3,'type'=>'Story','purpose'=>'latest'],key('card-group-story-new-3'))
  @livewire('card-group',['index'=>4,'type'=>'Listing'],key('card-group-listing-recommended-4'))
  @livewire('card-group',['index'=>5,'type'=>'Story'],key('card-group-story-recommended-5'))
  @livewire('card-group',['index'=>6,'type'=>'Resiliency'],key('card-group-resiliency-recommended-6'))
  <div>
  @foreach($resiliencies as $resiliency)
    @php
      $i=$loop->index;
    @endphp
    @livewire('card-group',['index'=>$i*3+7,'type'=>'Profile','purpose'=>'children','model'=>$resiliency],key('card-group-profile-children-'.$i*3+7))
    @livewire('card-group',['index'=>$i*3+8,'type'=>'Listing','purpose'=>'children','model'=>$resiliency],key('card-group-listing-children-'.$i*3+8))
    @livewire('card-group',['index'=>$i*3+9,'type'=>'Story','purpose'=>'children','model'=>$resiliency],key('card-group-story-children-'.$i*3+9))
  @endforeach
  </div>
  @endif
  </div>
  <div class="flex justify-center">
    <img  wire:loading loading="lazy" class="" src="https://listing-app.s3.ap-south-1.amazonaws.com/public/loader.gif">
  </div>
  @push('meta')
  <meta property="og:title" content="Seed Savers Club">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="og:type" content="article">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:image" content="https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png">
  @endpush
  <div wire:init="getFeed">
    @if($load)
    @if($resiliencies->hasMorePages())
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
    @endif
  </div>
</div>
