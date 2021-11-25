<x-guest-layout>
  <div class="container py-8 max-w-7xl mx-auto">
    <h1 class="font-semibold mx-4 mb-4 text-2xl">Crops</h1>
  @foreach ($crops as $crop)
    <div class=" my-5 px-6 py-4 mx-4 rounded shadow">
      <span class="font-semibold text-xl text-green-900">{{$crop->name}}</span>  
      <div class="overflow-ellipsis overflow-hidden h-12">{{$crop->description}}</div>
      <a href="/crops/{{$crop->id}}" class="underline">See more...</a>
    </div>
  @endforeach
  </div>
</x-guest-layout>