<div class="float-right mr-4 mt-4" x-data="{show:false}">
    <button class="" x-on:click="show=!show"><i class="fas fa-circle-user text-center text-primary text-3xl"></i></button>
    <div x-show="show" class="px-4 py-2 absolute right-4 cursor-pointer grid text-brown shadow">
        <span>Profile</span>
        <span>Settings</span>
        <span>Help</span>
    </div>
</div>