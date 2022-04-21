<div class="border-b" x-data="{allowed:@entangle('allowed'),show:false}">
    <div class="flex gap-4 justify-center overflow-auto p-4">
        @foreach($user_actions as $action=>$type)
        <div class="cursor-pointer grow grid px-4 py-2 rounded-xl {{$loop->index%2==0?'bg-primary text-black':'bg-brown text-white'}}" x-on:click="if(allowed){window.location.href='/e2e/bid-select/single/{{$type}}/{{$action}}'}else{show=true;}">
            <span class="text-xl font-semibold">{{__('e2e.actions.'.$role.'_'.$action.'_'.$type.'.label')}}</span>
            <span class="italic">{{__('e2e.actions.'.$role.'_'.$action.'_'.$type.'.description')}}</span>
        </div>
        @endforeach
    </div>
    <livewire:e2-e.profile-check/>
</div>