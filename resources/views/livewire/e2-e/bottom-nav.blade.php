<div class="flex gap-0 fixed bottom-0 w-screen sm:max-w-3xl border-t bg-white shadow-t shadow-lg" x-data="{nav:@entangle('action')}">
    @if(count($nav_items)>1)
    @foreach($nav_items as $action=>$icon)
        <div class="grow grid justify-items-center py-2 border-none font-bold" :class="nav=='{{$action}}'?'text-brown':'text-black opacity-50'" x-on:click="nav='{{$action}}'" wire:click="navigate('{{$action}}')">
            <span><i class="fas fa-{{$icon}}"></i></span>
            <span>{{__('e2e.navigation.'.$role.'.'.$action)}}</span>
        </div>
    @endforeach
    @endif
</div>
