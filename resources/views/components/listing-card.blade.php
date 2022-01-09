<div class="">
  <div class="flex justify-between">
    <a href="/listings/{{$model->id}}"><span class="font-semibold text-xl text-green-900">{{$model->name}}</span></a>
    <span class="text-sm text-gray-500">{{__($model->type)}}</span>
  </div>
  <div class="flex gap-5 items-center">
      @if($model->image_url)
      <div class="flex-initial justify-self-center">
        <a href="/listings/{{$model->id}}">
          <img src="{{$model->image_url}}" class="object-cover rounded-lg h-24 w-24" />
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
      @livewire('card-interests',['model'=>$model,'type'=>'Listing'])
  </div>
</div>
