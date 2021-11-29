<div class="grid grid-cols-1 sm:grid-cols-8 gap-4">
    @if($resiliency->image)
    <div class="sm:col-span-1 justify-self-center"><img src="{{$resiliency->image}}" class="max-h-32" /></div>
    @endif
    <div class="sm:col-span-7">
        <span class="font-semibold text-xl text-green-900">{{$resiliency->name}}</span>
        <div class="flex">
          @foreach ($resiliency->categories as $category)
          <a href="/categories/{{$category->id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$category->name}}</a>
          @endforeach
        </div>
        <div class="overflow-ellipsis overflow-hidden h-12">{{$resiliency->description}}</div>
        <a href="/{{Str::plural($resiliency->resilient_type)}}/{{$resiliency->resilient_id}}" class="underline">{{__('See more')}}...</a>
    </div>
</div>