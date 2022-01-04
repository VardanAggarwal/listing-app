<div>
    <a class="cursor-pointer" wire:click="toggleInterest">
        @if(Auth::user())
            @if(Auth::user()->profile->interest_resiliencies->contains($model))
                <span class="text-green-500"><i class="fas fa-heart"></i></span>
            @else
                <span class="text-green-500"><i class="far fa-heart"></i></span>
                {{__('Show interest')}}
            @endif

        @else
            {{__('Show interest')}}
        @endif
    </a>
    <span class="static" x-data={open:false} @mouseleave="open=false">
        <span class="pl-2" @mouseenter="open=!open">{{$model->interested_profiles_count}} {{__('interested')}}</span>
        <div class="absolute border rounded p-2 bg-white max-w-xs" x-show="open" x-on:click="open=false">
            {{__('ui.interest_help')}}
        </div>
    </span>
</div>
