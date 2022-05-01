<div class="rounded-t-xl border border-brown bg-white fixed bottom-0 inset-x-0 sm:max-w-3xl sm:mx-auto z-50">
    <div class="mx-auto p-10 grid grid-cols-2 justify-items-center">
        @if($href)
            <a href="{{$href}}" class="grid justify-items-center"><i class="text-primary text-3xl fab fa-whatsapp"></i><span class="text-brown underline">Whatsapp</span></a>
        @endif
        @if($call)
            <a href="{{$call}}" class="grid justify-items-center"><i class="text-primary text-3xl fas fa-phone"></i><span class="text-brown underline">Call</span></a>
        @endif
    </div>
</div>
