<div class="">
  <span class="font-semibold text-xl text-green-900">{{$model->profile->business_name}} {{__('wants to')}} {{__($model->type)}} {{$model->name}}</span>
  <div class="grid grid-cols-2 sm:grid-cols-8 gap-4">
      @if($model->image)
      <div class="sm:col-span-1 justify-self-center"><img src="{{$model->image}}" class="max-h-32" /></div>
      @endif
      <div class="sm:col-span-7">
          <span class="font-semibold text-lg">{{__($model->item_type)}}</span><br>
          <span>{{$model->price}} </span><br>
          <span>{{$model->profile->address}}</span><br>
          <span>{{$model->total_qty}}</span><br>
          <a href="/listings/{{$model->id}}" class="underline">{{__('See more')}}...</a>
      </div>
  </div>
</div>
