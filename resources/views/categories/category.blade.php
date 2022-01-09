<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="flex justify-between mb-4 items-center">
      <h1 class="flex-shrink font-semibold text-2xl">{{$category->name}}</h1>
    </div>  
      @if($category->links)
        <a href="{{$category->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
      @endif
    <div>
        @livewire('card-interests',['model'=>$category,'type'=>'Category'])
    </div>
  </div>
  @livewire('relationship-filtered-list',['relation'=>'resiliencies','model'=>$category])
@push('meta')
<meta property="og:title" content="{{$category->name}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:description" content="{{Str::limit(strip_tags($category->name),300)}}">
<meta property="og:image" content="https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png">
@endpush
</x-guest-layout>