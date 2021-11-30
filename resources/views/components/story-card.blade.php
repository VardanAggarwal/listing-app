<div class="">
  <span class="font-semibold text-xl text-green-900">{{$model->profile->user->name}}{{__('\'s')}} {{__('experience')}}</span>
  <div class="flex">
    @foreach ($model->resiliencies as $resiliency)
    <a href="/{{Str::plural(Str::lower(Str::replace('App//Models//','',$resiliency->resilient_type)))}}/{{$resiliency->resilient_id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
    @endforeach
  </div>
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
