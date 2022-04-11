<div class="w-screen sm:max-w-3xl">
    <div class="flex flex-nowrap gap-5 justify-left overflow-auto p-2">
      @foreach ($resiliencies as $resiliency)
        <div class="grid basis-20 border rounded-xl p-2 justify-items-center shrink-0">
                @if($resiliency->image_url)
                    <img src="{{$resiliency->image_url}}" loading="lazy" class="h-16 w-16 rounded-full"/>
                @endif
            <span class="w-18">{{$resiliency->name}}</span>
        </div>
      @endforeach
    </div>
    <div class="grid gap-4 py-5">
        <div class="grid grid-cols-2 items-center justify-between border p-4">
            <div class="flex gap-2 rounded items-center">
                <img src="https://via.placeholder.com/100.png" class="w-12 h-12" />
                <span class="text-lg">Roots</span>
            </div>
            <div>
                <span class="float-right">Rs. 200-350/Kg</span>
            </div>
        </div>
        <div class="grid grid-cols-2 items-center justify-between border p-4">
            <div class="flex gap-2 rounded items-center">
                <img src="https://via.placeholder.com/100.png" class="w-12 h-12" />
                <span class="text-lg">Seeds</span>
            </div>
            <div>
                <span class="float-right">Rs. 2000-3000/Kg</span>
            </div>
        </div>
    </div>
</div>
