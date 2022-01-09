<div class="">
  <span class="font-semibold text-xl text-green-900">{{$model->name}}</span>
  <div class="flex overflow-auto">
    @foreach ($model->resiliencies as $resiliency)
      <a href="/resiliencies/{{$resiliency->id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
    @endforeach
  </div>
  <a href="/categories/{{$model->id}}" class="underline">{{__('See more...')}}</a>
  <div>
      @livewire('card-interests',['model'=>$model,'type'=>'Category'],, key('category-'.$model->id))
  </div>
</div>
