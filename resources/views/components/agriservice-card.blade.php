<div class="">
  <span class="font-semibold text-xl text-green-900">{{$model->profile->business_name}} {{__('is offering')}} {{$model->title}}</span>
  <div class="">
      <div class="overflow-clip overflow-hidden max-h-24 max-w-full">{{$model->description}}</div>
      <div class="grid grid-cols-2 sm:grid-cols-6">
        <span class="col-span-1">{{__('Charges')}}: {{$model->charges}}</span>
        <span class="col-span-1">{{__('Type')}}:  {{Str::ucfirst(Str::replace('_',' ',__($model->type)))}}</span>
      </div>
</div>
  <a href="/agriservices/{{$model->id}}" class="underline">{{__('See more')}}...</a>
</div>
