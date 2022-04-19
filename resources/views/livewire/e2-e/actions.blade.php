<div class="border-b" x-data="{allowed:@entangle('allowed'),show:false}">
    <div class="flex gap-4 justify-center overflow-auto p-4">
        @foreach($user_actions as $action=>$type)
        <div class="cursor-pointer grow grid px-4 py-2 rounded-xl {{$loop->index%2==0?'bg-primary text-black':'bg-brown text-white'}}" x-on:click="if(allowed){window.location.href='/e2e/bid-select/item/single/{{$type}}/{{$action}}'}else{show=true;}">
            <span class="text-xl font-semibold">{{__('e2e.actions.'.$role.'_'.$action.'_'.$type.'.label')}}</span>
            <span class="italic">{{__('e2e.actions.'.$role.'_'.$action.'_'.$type.'.description')}}</span>
        </div>
        @endforeach
    </div>
    <div class="z-10 fixed inset-0 grid place-items-center" x-show="show">
        <div class="bg-black opacity-50 fixed inset-0" x-on:click="show=false"></div>
        <div class="z-50 m-5 p-10 bg-white border border-brown rounded-xl grid justify-items-center gap-5 relative">
            <span class="absolute right-5 top-5" @click="show=false"><i class="fas fa-times text-xl text-red"></i></span>
            <span class="text-brown">{{__('e2e.actions.profile_completion.dialog')}}</span>
            <a href="/e2e/profile/edit"><button class="bg-brown text-white px-4 py-2 rounded-xl">{{__('e2e.actions.profile_completion.button')}}</button></a>
        </div>
    </div>
</div>