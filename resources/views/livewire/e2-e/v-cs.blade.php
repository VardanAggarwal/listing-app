<div>
    <h1 class="text-2xl my-4">Select which value chains you deal in</h1>
    <div class="grid grid-cols-3 sm:grid-cols-6 gap-4">
        @foreach ($resiliencies as $resiliency)
          <div class="w-24 border grid justify-items-center rounded-lg">
              @if($resiliency['image_url'])
                  <img src="{{$resiliency['image_url']}}" loading="lazy" class="rounded-t-lg object-cover h-24 w-24"/>
              @endif
              <span class="m-2">{{$resiliency['name']}}</span>
          </div>
        @endforeach
        <div class="w-24 border grid justify-items-center rounded-lg">
            <span class="text-7xl"><i class="fas fa-plus"></i></span>
            <span class="m-2">Search more</span>
        </div>
    </div>
    <div class="my-4">
      <x-jet-validation-errors/>
    </div>
    <div class="py-2 bg-white border-t flex justify-center fixed sm:static inset-x-0 bottom-0 sm:inset-auto sm:bottom-auto">
        <x-jet-button class="border rounded-full p-2 bg-gray-900 text-white">Continue</x-jet-button>
    </div>
    <div class="h-12"></div>
</div>