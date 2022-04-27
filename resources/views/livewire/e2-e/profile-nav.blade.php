<div class="float-right mr-4 mt-4 relative" x-data="{show:false}">
        <div class="border overflow:hidden border-brown rounded-full w-12 h-12" @click="show=!show">
            @if(isset(Auth::user()->profile_photo_url))
              <img class="object-cover w-12 h-12 rounded-full" src="{{Auth::user()->profile_photo_url}}">
            @else
                <i class="fas fa-circle-user text-center text-primary text-3xl"></i>
            @endif
        </div>
        <div x-cloak x-show="show" @click.outside="show=false"class="text-brown absolute bg-white shadow gap-2 z-50 w-32 right-0 top-12 p-4 grid cursor-pointer">
            <a href="{{$redirect}}"><i class="fas fa-user"></i> {{__('e2e.profile_nav.profile')}}</a>
            <a href="/e2e/role"><i class="fas fa-user-group"></i> {{__('e2e.profile_nav.role')}}</a>
            <a href="https://wa.me/919667696536"><i class="fab fa-whatsapp text-lg"></i> {{__('e2e.profile_nav.contact')}}</a>
            <a wire:click="logout"><i class="fas fa-power-off"></i> {{__('e2e.profile_nav.logout')}}</a>
        </div>
</div>