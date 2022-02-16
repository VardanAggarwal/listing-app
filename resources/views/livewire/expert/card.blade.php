<div>
  <a href="/profiles/{{$profile->id}}"><div class="grid grid-cols-1 justify-items-center">
    @if($img=$profile->user->profile_photo_url)
        <img src="{{$img}}" class="w-12 h-12 rounded-full" loading="lazy">
    @endif
    <span class="text-lg max-h-12 overflow-hidden">{{$profile->name}}</span>
  </div>
  <div class="flex overflow-auto flex-nowrap">
    @foreach ($profile->expert_resiliencies as $resiliency)
    <a href="/resiliencies/{{$resiliency->id}}" class="mr-2 border rounded-md py-1 px-2 whitespace-nowrap tracking-widest">{{$resiliency->name}}</a>
    @endforeach
  </div>
  <div class="mt-2 flex flex-wrap gap-2">
    @foreach($services as $service)
      <span><i class="fas fa-{{in_array($service,array_keys($service_types))?$service_types[$service]:$service_types['others']}}"></i> <span class="text-xs">{{__(in_array($service,array_keys($service_types))?'ui.expert.services.'.$service:$service)}}</span></span>
    @endforeach
  </div></a>
  <div class="mt-4 border-t pt-2">
    <x-contact-profile :profile=$profile/>
  </div>
</div>
