<div>
  <a href="/profiles/{{$profile->id}}"><div class="grid grid-cols-1 justify-items-center">
    @if($img=$profile->user->profile_photo_url)
        <img src="{{$img}}" class="w-12 h-12 rounded-full" loading="lazy">
    @endif
    <span class="text-xl">{{$profile->name}}</span>
  </div>
  <div class="mt-2 flex flex-wrap gap-2">
    @foreach($services as $service)
      <span><i class="fas fa-{{in_array($service,array_keys($service_types))?$service_types[$service]:$service_types['others']}}"></i> <span class="text-sm">{{__(in_array($service,array_keys($service_types))?'ui.expert.services.'.$service:$service)}}</span></span>
    @endforeach
  </div></a>
  <div class="mt-4 border-t pt-2">
    <x-contact-profile :profile=$profile/>
  </div>
</div>
