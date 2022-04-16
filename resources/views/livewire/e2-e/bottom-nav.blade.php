<div class="flex gap-0 fixed bottom-0 w-screen sm:max-w-3xl border-t bg-white shadow-t shadow-lg" x-data="{nav:'{{isset($nav_items[0])?$nav_items[0]:''}}'}">
    @foreach($nav_items as $nav)
        <div class="grow grid justify-items-center py-2 border-none font-bold" :class="nav=='{{$nav}}'?'text-brown':'text-gray-500'" x-on:click="nav='{{$nav}}'" wire:click="navigate('{{$nav}}')">
            <span><i class="fas fa-{{$icons[$nav]}}"></i></span>
            <span>{{ucwords($nav)}}</span>
        </div>
    @endforeach
</div>
