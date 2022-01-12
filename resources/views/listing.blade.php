<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$listing->name}}</span><br>
    <span class="font-semibold text-lg text-gray-600">{{__($listing->type)}}</span>
    <div class="mt-4 flex gap-4 items-center ">
        @if($listing->image_url)
        <div class=""><img src="{{$listing->image_url}}" class="object-cover h-24 w-24 rounded" /></div>
        @endif
        <div class="">
            <span class="font-semibold text-lg">{{__('Type')}}: {{__($listing->item_type)}}</span><br>
            <span class="font-semibold text-lg">{{__('Price')}}: {{$listing->price}} </span><br>
            <span class="font-semibold text-lg">{{__('Address')}}: {{$listing->location}}</span><br>
        </div>
    </div>
    <div class="mt-4">      
     <div class="prose">{!!$listing->description!!}</div>
    </div>
    @if($listing->profile)
      @if($listing->phone_number||$listing->profile->contact_number)
        <div class="mt-4">
          <a href="/profiles/{{$listing->profile->id}}" class="underline"><span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$listing->profile->name,'contact'=>$listing->phone_number?$listing->phone_number:$listing->profile->contact_number])}}</span></a>
        </div>
      @endif
      <x-profile-card :model="$listing->profile"></x-profile-card>
    @endif
    <div>
        @livewire('card-interests',['model'=>$listing,'type'=>'Listing'])
        @livewire('page-interests',['model'=>$listing,'type'=>'Listing'])
        @livewire('post-statement',['parent'=>$listing])
    </div>
    <div class="mt-4 w-full grid justify-items-center">
      <a href="\listings\new">
        <x-jet-button>{{__('Add your listing')}}</x-jet-button>
      </a>
    </div>
    @if($listing->profile->stories_count)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b  py-4">
        {{__('Related')}} {{__('ui.models.stories')}}
      @livewire('relationship-filtered-list',['relation'=>'stories','model'=>$listing->profile])
      </div>
    @endif
    @if($listing->resiliencies_count)
      <div class="font-semibold text-lg max-w-7xl sm:mx-auto mt-4 border-b  py-4">
        {{__('Related')}} {{__('ui.models.resiliencies')}}
      @livewire('relationship-filtered-list',['relation'=>'resiliencies','model'=>$listing])
      </div>
    @endif
</div>
@push('meta')
<meta property="og:title" content="{{$listing->name}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:description" content="{{Str::limit(strip_tags($listing->description),300)}}">
<meta property="og:image" content="{{$listing->image_url??'https://listing-app.s3.ap-south-1.amazonaws.com/public/ssc.png'}}">
@endpush
</x-guest-layout>