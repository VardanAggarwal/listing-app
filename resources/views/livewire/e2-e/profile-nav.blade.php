<div class="float-right mr-4 mt-4" x-data="{show:false}">
    <a href={{$redirect}}>
        <div class="border overflow:hidden border-brown rounded-full w-12 h-12">
            @if(isset(Auth::user()->profile_photo_url))
              <img class="object-cover rounded-full" src="{{Auth::user()->profile_photo_url}}">
            @else
                <i class="fas fa-circle-user text-center text-primary text-3xl"></i>
            @endif
        </div>
    </a>
</div>