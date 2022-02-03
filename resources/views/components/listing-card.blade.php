<div class="">
  <x-inline-profile :model=$model/>
  <div class="flex justify-between">
    <a href="/listings/{{$model->id}}"><span class="font-semibold text-xl text-green-900">{{$model->name}}</span></a>
    <span class="text-sm text-gray-500">{{__($model->type)}}</span>
  </div>
  <div class="flex overflow-auto">
    @foreach ($model->resiliencies as $resiliency)
      <a href="/resiliencies/{{$resiliency->id}}" class="mr-4 whitespace-nowrap items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
    @endforeach
  </div>
  <div class="flex gap-5 items-center">
      @if($model->image_url)
      <div class="flex-initial justify-self-center">
        <a href="/listings/{{$model->id}}">
          <img src="{{$model->image_url}}" loading="lazy" class="object-cover rounded-lg h-24 w-24" />
        </a>
      </div>
      @endif
      <div class="flex-auto">
          <a href="/listings/{{$model->id}}">
            <span class="font-semibold text-lg">{{__($model->item_type)}}</span><br>
            <span>{{$model->price}} </span><br>
            <span>{{$model->location}}</span><br>
        </a>

          <a href="/listings/{{$model->id}}" class="underline">{{__('See more')}}...</a>
      </div>
  </div>
  <div>
      @livewire('card-interests',['model'=>$model,'type'=>'Listing'], key($index.'listing-'.$model->id))
  </div>
</div>
