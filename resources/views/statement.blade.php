<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="prose">{!!$statement->statement!!}</div>
    @php
        $media=explode(",",$statement->media);
    @endphp
    <div class="flex gap-4">
    @foreach($media as $image)
      <a href="{{$image}}" target="_blank"><img src="{{$image}}" class="object-cover max-h-40 max-w-full rounded mb-4 sm:m-0"></a>
    @endforeach
    </div>
    @livewire('card-interests',['model'=>$statement,'type'=>'Statement'])
    <x-card-add-interests/>
  </div>
  @push('meta')
  <meta property="og:title" content="{{Str::limit(strip_tags($statement->statement),100)}}">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="og:type" content="article">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:description" content="{{Str::limit(strip_tags($statement->statement),300)}}">
  <meta property="og:image" content="{{$media[0]??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
  @endpush
</x-guest-layout>