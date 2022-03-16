<div class="max-w-7xl mx-4 sm:mx-auto">
  <div class="flex justify-between">
    <h1 class="font-bold text-2xl">{{__('ui.models.feed')}}</h1>
  </div>
  <div wire:key="feed-list-pre-load">
  @livewire('leads.card')
  @php
    $i=0;
  @endphp
  @foreach($preLoad as $item)
    @php $i++; @endphp
    <div>@livewire('card-group',['index'=>$i,'type'=>$item["type"],'purpose'=>$item["purpose"],'view'],key('card-group-'.$item["type"].'-'.$item["purpose"].'-'.$i))</div>
  @endforeach
  <div wire:key="feed-list-post-load">
  @if($load)
  <div wire:key="feed-list-post-load-fixed">
    @foreach($postLoad as $item)
      @php $i++; @endphp
      <div>@livewire('card-group',['index'=>$i,'type'=>$item["type"],'purpose'=>$item["purpose"]],key('card-group-'.$item["type"].'-'.$item["purpose"].'-'.$i))</div>
    @endforeach
  </div>
  <div wire:key="feed-list-post-load-dynamic">
  @foreach($resiliencies as $resiliency)
    @foreach($children as $type)
      @php $i++; @endphp
      <div>@livewire('card-group',['index'=>$i,'type'=>$type,'purpose'=>'children','model'=>$resiliency],key('card-group-'.$type.'-children-'.$i))</div>
    @endforeach
  @endforeach
  </div>
  <div class="flex justify-center">
    <img  wire:loading loading="lazy" class="" src="https://listing-app.s3.ap-south-1.amazonaws.com/public/loader.gif">
  </div>
  <div wire:key="feed-list-post-load-dynamic-loader">
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
        x-init="$nextTick(()=>observe())"
    ><div class="w-full h-6"></div>
    </div>
  @endif
  </div> 
  @endif
  </div>
  <div wire:init="getFeed">
  </div>
  @push('meta')
  <meta property="og:title" content="Seed Savers Club">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="og:type" content="article">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:image" content="https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png">
  @endpush
</div>
