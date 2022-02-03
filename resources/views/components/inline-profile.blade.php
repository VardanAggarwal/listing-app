<div>
    @if($model->profile)
        <div class="py-2 flex items-center">
            <a href="/profiles/{{$model->profile_id}}"><img loading="lazy" class="cursor-pointer rounded-full w-8 h-8" src="{{$model->profile->user->profile_photo_url}}"></a>
            <a href="/profiles/{{$model->profile_id}}"><span class="ml-4 cursor-pointer">{{$model->profile->name}}</span></a>
        </div>
    @endif
</div>