<div class="">
    @php
        $media=explode(",",$model->media);
    @endphp
    <div class="sm:flex sm:items-center">
        @if($media[0])
            <a href="/statements/{{$model->id}}"><img src="{{$media[0]}}" class="object-cover max-h-40 w-full sm:w-60 rounded mb-4 sm:m-0"></a>
        @endif
        <a href="/statements/{{$model->id}}"><div class="prose overflow-ellipsis overflow-hidden max-h-40 sm:ml-4">{!!$model->statement!!}</div></a>
    </div>
    @livewire('card-interests',['model'=>$model,'type'=>'Statement'], key('statement-'.$model->id))
</div>