<x-guest-layout>
  <div class="container py-8 max-w-7xl mx-auto">
    <div class=" my-5 px-6 py-4 mx-4 rounded shadow">
      <span class="font-semibold text-xl text-green-900">{{$crop->name}}</span>  
      <div><p>{{$crop->description}}</p></div>
      @if($crop->links)
        <a href="{{$crop->links}}" target="_blank"class="underline">{{__('See more...')}}</a>
      @endif
    </div>
  </div>
</x-guest-layout>