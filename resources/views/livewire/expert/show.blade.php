<div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
  <span class="font-semibold text-lg">{{__('ui.expert.show.resiliencies')}}
    @if(Auth::user())
      @if(Auth::user()->profile)
        @if($profile->id==Auth::user()->profile->id)
          <a href="/expert/form"><span class="float-right"><i class="fas fa-pen"></i></span></a>
        @endif
      @endif
    @endif
  </span>
  <div class="mb-4 overflow-auto flex flex-nowrap gap-4">
    @foreach ($profile->expert_resiliencies as $resiliency)
      <div class="flex-none border rounded-lg p-2">
          @if($resiliency->image_url)
              <img src="{{$resileincy->image_url}}" loading="lazy" class="h-8 w-8 rounded-full">
          @endif
          <span class="text-xl">{{$resiliency->name}}</span><br>
      </div>
    @endforeach
  </div>
    <span class="font-semibold text-lg">{{__('ui.expert.show.services')}}</span>
    <div class="mt-2 flex flex-wrap gap-2">
    @foreach($services as $service)
      <span class="bg-gray-900 text-white rounded-lg px-2 py-1">{{__('ui.expert.services.'.$service)}}</span>
    @endforeach
  </div>
                
</div>
