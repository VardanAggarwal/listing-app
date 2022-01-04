<div>
<span>{{$model->interested_profiles_count}} {{__('interested')}}</span>
<a class="underline cursor-pointer" wire:click="toggleInterest">
    @if(Auth::user())
        @if(Auth::user()->profile->interest_resiliencies->contains($model))
        {{__('Remove interest')}}
        @else
        {{__('Show interest')}}
        @endif

    @else
    {{__('Show interest')}}
    @endif
</a>
</div>
