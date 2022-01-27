<div>
    <x-inline-profile :model=$model/>
    <div class="sm:flex sm:items-center">
        @if($model->image)
            <a href="/statements/{{$model->id}}"><img src="{{$model->image}}" class="object-cover max-h-40 w-full sm:w-60 rounded mb-4 sm:m-0"></a>
        @endif
        <a href="/statements/{{$model->id}}"><div class="overflow-ellipsis overflow-hidden max-h-12 sm:max-h-40 sm:ml-4">{{strip_tags($model->statement)}}</div></a>
    </div>
</div>