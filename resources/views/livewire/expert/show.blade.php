<div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
  <span class="font-semibold text-lg">{{__('ui.expert.services')}}</span>
  <div class="flex flex-wrap gap-4">
              @foreach ($profile->expert_resiliencies as $resiliency)
                <div class="border rounded-lg p-2">
                    @if($resiliency->image_url)
                        <img src="{{$resileincy->image_url}}" loading="lazy" class="h-8 w-8 rounded-full">
                    @endif
                    <span class="text-lg">{{$resiliency->name}}</span><br>
                    <div class="flex flex-nowrap gap-2">
                    @foreach($resiliency->pivot->data['services'] as $service)
                        <span class="bg-gray-900 text-white rounded-lg px-2 py-1">{{$service}}</span>
                    @endforeach
                    </div>
                </div>
              @endforeach
            </div>                
</div>
