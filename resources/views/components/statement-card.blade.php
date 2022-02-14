<div class="">
    @if($parent_type && $model->stateable)
        @php
            if($parent_type=='statement'){
                $component='comment-card';
            }else{
                $component=$parent_type.'-card';
            }
        @endphp
        @if($parent_type=='statement')
            <x-comment-card :model="$model->stateable" :index="$index"/>
        @else
            @livewire('simple-card',['model'=>$model->stateable, 'index'=>$index, 'group_index'=>'statement-group','type'=>$parent_type])
        @endif
        <div class="bg-gray-200 p-2 mt-2 rounded-lg">
            <x-inline-profile :model=$model/>
            <a href="/statements/{{$model->id}}"><div class="overflow-ellipsis overflow-hidden max-h-12 sm:max-h-40 sm:ml-4">{!!strip_tags($model->statement)!!}</div></a>
        </div>
    @else
        <x-inline-profile :model=$model/>
        <div class="sm:flex sm:items-center">
            @if($model->image)
                <a href="/statements/{{$model->id}}"><img loading="lazy" src="{{$model->image}}" class="object-cover max-h-40 w-full sm:w-60 rounded mb-4 sm:m-0"></a>
            @endif
            <a href="/statements/{{$model->id}}"><div class="overflow-ellipsis overflow-hidden max-h-12 sm:max-h-40 sm:ml-4">{!!strip_tags($model->statement)!!}</div></a>
        </div>
        <div class="flex overflow-auto">
          @foreach ($model->attached_resiliencies as $resiliency)
            <a href="/resiliencies/{{$resiliency->id}}" class="mr-4 whitespace-nowrap items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
          @endforeach
        </div>
        @livewire('card-interests',['model'=>$model,'type'=>'Statement'], key($index.'statement-'.$model->id))
    @endif
</div>