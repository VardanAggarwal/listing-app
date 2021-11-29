<div class="">
  <span class="font-semibold text-xl text-green-900">{{$model->profile->user->name}}{{__('\'s')}} {{__('experience')}}</span>
  <div class="rating text-yellow-400">
      {!! str_repeat('<span><i class="fas fa-star"></i></span>', $model->overall) !!}
      {!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - $model->overall) !!}
  </div>
  <div class="grid grid-cols-2 sm:grid-cols-6">
    <span class="col-span-1">{{__('Expenses')}}:  {{__('Rs.')}} {{$model->finances->where('type','expense')->sum('amount')}}</span>
    <span class="col-span-1">{{__('Earnings')}}:  {{__('Rs.')}} {{$model->finances->where('type','earning')->sum('amount')}}</span></div>
  <div class="">
    <div>
      <span class="font-semibold text-m text-green-900">{{__('Pros')}}</span>
      <div class="overflow-clip overflow-hidden max-h-12 max-w-full">{{$model->advantages}}</div>
    </div>
    <div>
      <span class="font-semibold text-m text-red-900">{{__('Cons')}}</span>      
     <div class="overflow-clip overflow-hidden max-h-12 max-w-full">{{$model->risks}}</div>
    </div>
</div>
  <a href="/stories/{{$model->id}}" class="underline">{{__('See more')}}...</a>
</div>
