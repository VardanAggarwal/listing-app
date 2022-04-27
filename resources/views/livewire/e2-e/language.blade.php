<div class="float-right mr-4 mt-4 relative" x-data="{show:false}">
    <button class="text-brown border border-brown rounded p-1" x-on:click="show=!show">{{$locale}} <i class="fas fa-globe text-center text-primary"></i></button>
    <div x-cloak x-show="show" class="absolute right-0 py-2 px-4 cursor-pointer grid text-brown shadow">
        <span wire:click="setLocale('en')" x-on:click="show=false">English</span>
        <span wire:click="setLocale('hi')" x-on:click="show=false">हिन्दी</span>
    </div>
</div>