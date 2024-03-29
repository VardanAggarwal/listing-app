<x-guest-layout>
  <div class="max-w-7xl mx-4 sm:mx-auto">
    <span class="font-semibold text-2xl text-green-900">{{$story->title}}</span>
    @if(Auth::user())
      @if(Auth::user()->role_id==1 || Auth::user()->profile->id==$story->profile_id)
      <a href="/stories/{{$story->id}}/edit"><i class="fas fa-pen"></i></a>
      <a href="/stories/{{$story->id}}/delete"><i class="fas fa-trash-alt"></i></a>
      @endif
    @endif
    <br>
    <div class="rating text-yellow-400">
        {!! str_repeat('<span><i class="fas fa-star"></i></span>', $story->rating) !!}
        {!! str_repeat('<span><i class="far fa-star"></i></span>', 5 - $story->rating) !!}
    </div>
    <div class="my-4 grid grid-cols-1 sm:grid-cols-8 gap-4 items-center">
      @if($story->image_url)
        <div class="col-span-1 sm:col-span-2 justify-self-center">
          <a href="{{$story->image_url}}"><img src="{{$story->image_url}}" class="rounded-lg h-36 w-screen sm:w-36 object-center object-cover" /></a>
        </div>
      @endif
      <div class="col-span-1 sm:col-span-6">
        <div class="">
          <div class="prose">{!!$story->review!!}</div>
        </div>
      </div>
    </div>
    @if($story->links)
      <a href="{{$story->links}}" target="_blank"class="underline">{{__('See more')}}...</a>
    @endif
    @if($story->profile)
      @if($story->profile->contact_number)
      <div class="mt-4">
        <a href="/profiles/{{$story->profile->id}}" class="underline"><span class="font-semibold text-md">{{__('ui.contact_for_services',['name'=>$story->profile->name,'contact'=>$story->profile->contact_number])}}</span></a>         
      </div>
      @endif
      <x-profile-card :model="$story->profile"></x-profile-card>
    @endif
    <div>
      @livewire('card-interests',['model'=>$story,'type'=>'Story'])
      @livewire('page-interests',['model'=>$story,'type'=>'Story'])
    </div>
    <div class="mt-4 w-full grid justify-items-center">
      <a href="\stories\new">
        <x-jet-button>{{__('Share your experience')}}</x-jet-button>
      </a>
    </div>
    <div class="mt-4">
      @livewire('onboarding.card')
      @livewire('card-group',['index'=>-3,'type'=>'Resiliency','purpose'=>'children','model'=>$story],key('card-group-resiliency-children'.$story->id))
      @livewire('card-group',['index'=>-2,'type'=>'Listing','purpose'=>'children','model'=>$story->profile],key('card-group-listing-children-profile-'.$story->profile_id))
      @livewire('card-group',['index'=>-1,'type'=>'Story','purpose'=>'children','model'=>$story->profile],key('card-group-story-children-profile-'.$story->profile_id))
      @foreach($story->resiliencies as $resiliency)
          @livewire('card-group',['index'=>$loop->index,'type'=>'Profile','purpose'=>'children','model'=>$resiliency],key('card-group-listing-children-profile-'.$resiliency->id.'-'.$loop->index))
          @livewire('card-group',['index'=>$loop->index,'type'=>'Listing','purpose'=>'children','model'=>$resiliency],key('card-group-listing-children-'.$loop->index))
          @livewire('card-group',['index'=>$loop->index,'type'=>'Story','purpose'=>'children','model'=>$resiliency],key('card-group-story-children-'.$loop->index))
      @endforeach
    </div>
  </div>
@push('meta')
<meta property="og:title" content="{{$story->title}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="article">
<meta property="fb:app_id" content="852906262106769">
<meta property="og:description" content="{{Str::limit(strip_tags($story->review),300)}}">
<meta property="og:image" content="{{$story->image_url??'https://listing-app.s3.ap-south-1.amazonaws.com/public/story_card.png'}}">
@endpush
</x-guest-layout>

