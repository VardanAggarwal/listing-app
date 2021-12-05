<div class="">
  <a href="/stories/{{$model->id}}"><span class="font-semibold text-xl text-green-900">{{$model->title}}</span></a>
  <div class="grid grid-cols-1 sm:grid-cols-8 gap-4 items-center">
      @if($model->image_url)
      <div class="sm:col-span-1 justify-self-center">
        <a href="/stories/{{$model->id}}"><img src="{{$model->image_url}}" class="rounded-lg h-24 w-24" /></a>
      </div>
      @endif
      <div class="sm:col-span-7">
        <div class="flex overflow-auto">
          @foreach ($model->resiliencies as $resiliency)
            <a href="/resiliencies/{{$resiliency->id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
          @endforeach
        </div>
        <div class="rating text-yellow-400">
          {!! str_repeat('<span><i class="fas fa-star"></i></span>', $model->rating) !!}
          {!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - $model->rating) !!}
        </div>
        <div>
          <a href="/stories/{{$model->id}}">
            <div class="overflow-clip overflow-hidden max-h-12 max-w-full">{{$model->review}}</div>
          </a>
          <a href="/stories/{{$model->id}}" class="underline">{{__('See more')}}...</a>
        </div>
      </div>
  </div>
</div>