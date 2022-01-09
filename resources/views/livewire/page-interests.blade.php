<div>
    @foreach($interests as $key=>$interest)
        @if($key && $key!="others")
            <div class="border rounded p-4 my-2 bg-white">
                @if(in_array($key,['input','market','training','connect','payment','logistics']))
                    {{__('ui.help.'.$key)}}
                @else
                {{$key}}
                @endif
                <span class="text-sm float-right">
                    <a href="#help-{{$type}}-{{$model->id}}-{{$key}}"wire:click="toggleInterest('{{$key}}')">
                        @if($user_interests)
                        <i class="{{$user_interests->contains($key)?'fas':'far'}} fa-star"></i>
                        @else
                        <i class="far fa-star"></i>
                        @endif
                    </a>
                    <span>{{$interest}} {{__('interested')}}</span>
                </span>
            </div>
        @endif
    @endforeach
</div>
