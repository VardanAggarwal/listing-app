<div class="">
    <div class="flex justify-between">
        <a href="/resiliencies/{{$model->id}}"><span class="font-semibold text-xl text-green-900">{{$model->name}}</span></a>
        <span class="text-sm text-gray-500">{{__($model->type)}}</span>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-8 gap-4 items-center">
        @if($model->image_url)
        <div class="sm:col-span-1 justify-self-center">
            <a href="/resiliencies/{{$model->id}}"><img src="{{$model->image_url}}" class="rounded-lg h-24 w-24" /></a>
        </div>
        @endif
        <div class="sm:col-span-7">
            <div class="flex overflow-auto">
              @foreach ($model->categories as $category)
              <a href="/categories/{{$category->id}}" class="mr-4 inline-flex  whitespace-nowrap items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$category->name}}</a>
              @endforeach
            </div>
            <div class="rating text-yellow-400">
              {!! str_repeat('<span><i class="fas fa-star"></i></span>', intval($model->stories->avg('rating'))) !!}{!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - intval($model->stories->avg('rating'))) !!}
            </div>
            <a href="/resiliencies/{{$model->id}}">
                <div class="overflow-ellipsis overflow-hidden h-12">{!!strip_tags($model->description)!!}</div>
            </a>
            <a href="/resiliencies/{{$model->id}}" class="underline">{{__('See more')}}...</a>
        </div>
    </div>
    <div>
        @livewire('card-interests',['model'=>$model,'type'=>'Resiliency'], key('resiliency-'.$model->id))
    </div>
</div>