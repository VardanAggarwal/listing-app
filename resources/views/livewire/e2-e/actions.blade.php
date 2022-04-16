<div class="border-b">
    <div class="flex gap-4 justify-center overflow-auto p-4">
        @foreach($user_actions as $action)
        <div class="grow grid px-4 py-2 rounded-xl {{$loop->index%2==0?'bg-primary text-black':'bg-brown text-white'}}">
            <span class="text-xl font-semibold">{{__('e2e.actions.'.$action.'.label')}}</span>
            <span class="italic">{{__('e2e.actions.'.$action.'.description')}}</span>
        </div>
        @endforeach
    </div>
</div>