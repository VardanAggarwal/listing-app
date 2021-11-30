<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$story->profile->user->name}}{{__('\'s')}} {{__('experience')}}</span><br>
    <div class="flex">
      @foreach ($story->resiliencies as $resiliency)
      <a href="/{{Str::plural(Str::lower(Str::replace('App//Models//','',$resiliency->resilient_type)))}}/{{$resiliency->resilient_id}}" class="mr-4 inline-flex items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
      @endforeach
    </div>
    <div class="grid grid-cols-3">
      <span class="font-medium text-xl">{{$story->profile->address}}</span>
      <span class="font-medium text-xl">{{__('Season')}}: {{$story->season}}</span>
      <span class="font-medium text-xl">{{__('Lifetime')}}: {{$story->lifetime}}</span>
    </div>
    <div class="rating text-yellow-400">
        {!! str_repeat('<span><i class="fas fa-star"></i></span>', $story->overall) !!}
        {!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - $story->overall) !!}
    </div>
    <div class="grid grid-cols-2">
      <div class="col-span-1">
        <span class="font-semibold text-m text-red-900">{{__('Expenses')}}: </span><span> {{__('Rs.')}} {{$story->finances->where('type','expense')->sum('amount')}}</span><br>
        @foreach($story->finances->where('type','expense') as $finance)  
        <span>
          {{__('$finance->item')}}, {{__('$finance->item_type')}}: {{__('Rs.')}} {{$finance->amount}} {{__('every')}} {{$finance->frequency}}
        </span><br>
        @endforeach
      </div>
      <div class="col-span-1">
        <span class="font-semibold text-m text-green-900">{{__('Earnings')}}: </span><span> {{__('Rs.')}} {{$story->finances->where('type','earning')->sum('amount')}}</span><br>
        @foreach($story->finances->where('type','earning') as $finance)  
        <span>
          {{__($finance->item)}}, {{__($finance->item_type)}}: {{__('Rs.')}} {{$finance->amount}} {{__('every')}} {{$finance->frequency}}
        </span><br>
        @endforeach
      </div>
    </div>
    <div class="">
      <div class="mt-4">
        <span class="font-semibold text-m text-green-900">{{__('Pros')}}</span>
        <div class="">{{$story->advantages}}</div>
      </div>
      <div class="mt-4">
        <span class="font-semibold text-m text-red-900">{{__('Cons')}}</span>      
       <div class="">{{$story->risks}}</div>
      </div>
      <div class="mt-4">
        <span class="font-semibold text-m">{{__('Best practices')}}</span>      
       <div class="">{{$story->best_practices}}</div>
      </div>
      <div class="mt-4">
        <span class="font-semibold text-m">{{__('Climate & soil conditions')}}</span>      
       <div class="">{{$story->climate_conditions}}</div>
      </div>
      <div class="mt-4">
        <span class="font-semibold text-m">{{__('Setup/Land')}}</span>      
       <div class="">{{$story->infra}}</div>
      </div>
      @if($story->profile->contact_number && $story->services)
        <div class="mt-4">
          <span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$story->profile->user->name,'contact'=>$story->profile->contact_number,'services'=>$story->services])}}</span>         
        </div>
      @endif
  </div>
  @if($story->links)
    <a href="{{$story->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
  @endif
  </div>

</x-guest-layout> 

