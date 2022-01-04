<div class="mt-1 pt-2 border-t text-md">
    <a class="cursor-pointer" wire:click="toggleInterest">
        @if(Auth::user())
            @if(Auth::user()->profile)
                @if(Auth::user()->profile->interest_resiliencies->contains($model))
                    <span class="text-green-500"><i class="fas fa-bookmark"></i></span>
                @else
                    <span class="text-green-500"><i class="far fa-bookmark"></i></span>
                    {{__('Show interest')}}
                @endif
            @endif
        @else
            <span class="text-green-500"><i class="far fa-bookmark"></i></span>
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
