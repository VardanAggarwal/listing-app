<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <div class="prose">{!!$statement->statement!!}</div>
    @php
      $media=[];
      if($statement->media){
        $media=explode(",",$statement->media);
      }
    @endphp
    <div class="flex gap-4 flex-wrap justify-center">
    @foreach($media as $file)
        @php
          $type=get_headers($file,true)["Content-Type"]
        @endphp
        @switch($type)
          @case (str_contains($type,'image'))
            <div class="order-first"><a href="{{$file}}" target="_blank"><img src="{{$file}}" class="object-cover max-h-40 max-w-full rounded mb-4 sm:m-0"></a></div>
            @break
          @case (str_contains($type,'video'))
            <video src="{{$file}}" controls class="order-first max-w-full sm:w-1/3 sm:m-0"  preload="metadata"></video>
            @break
          @case (str_contains($type,'audio'))
            <audio src="{{$file}}" class="order-last" controls preload="none"></audio>
            @break
          @case (str_contains($type,'pdf'))
              <a href="{{$file}}" class="order-last" target="_blank"><x-jet-button>{{__("Download file")}}</x-jet-button></a>
            @break
        @endswitch
    @endforeach
    </div>
    @livewire('card-interests',['model'=>$statement,'type'=>'Statement'])
    @livewire('page-interests',['model'=>$statement,'type'=>'Statement'])
    @livewire('post-statement',['parent'=>$statement])
    @livewire('relationship-filtered-list',['relation'=>'statements','model'=>$statement])
    <x-card-add-interests/>
  </div>
  @push('meta')
  <meta property="og:title" content="{{Str::limit(strip_tags($statement->statement),100)}}">
  <meta property="og:url" content="{{url()->current()}}">
  <meta property="og:type" content="article">
  <meta property="fb:app_id" content="852906262106769">
  <meta property="og:description" content="{{Str::limit(strip_tags($statement->statement),300)}}">
  <meta property="og:image" content="{{$statement->image??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
  @endpush
</x-guest-layout>