<x-guest-layout>
  <div class="max-w-7xl mx-4 sm:mx-auto">
    @if(Auth::user())
      @if(Auth::user()->profile)
        @if($profile->id==Auth::user()->profile->id)
          <a href="/profile"><span class="float-right"><i class="fas fa-pen"></i></span></a>
        @endif
      @endif
    @endif

    <div class="text-center sm:text-left font-semibold text-2xl text-green-900">
      <span>{{$profile->name}}</span>
      @if($profile->status)
          <span class="p-2"><i class="text-green-500 fas fa-check-circle"></i></span>
      @endif
      <br>
    </div>
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-8 gap-4">
        @if($profile->user->profile_photo_url)
        <div class="relative col-span-1 sm:col-span-1 justify-self-center">
          <a href="{{$profile->user->profile_photo_url}}"><img loading="lazy" src="{{$profile->user->profile_photo_url}}" class="rounded-full h-24 w-24 object-cover object-center" /></a>
          @if(Auth::user())
            @if(Auth::user()->profile)
              @if($profile->id==Auth::user()->profile->id)
                <a href="{{route('profile.show')}}"><span class="absolute right-0 top-0"><i class="fas fa-pen"></i></span></a>
              @endif
            @endif
          @endif
        </div>
        @endif
        <div class="text-center sm:text-left col-span-1 sm:col-span-3">
            <div class="grid justify-items-center sm:justify-items-start">
            </div>
            <span class="font-semibold text-lg">
              {{$profile->address}}, {{$profile->pincode}}
            </span><br>
            <div x-data="{show:false}" @click="show=!show" @mouseleave="show=false">
              <span class="font-semibold text-lg"  @click="
              function(){
                mixpanel.track('Phone Number Clicked',{'profile_id':{{$profile->id}},'number':'{{$profile->contact_number}}'});
                if (!navigator.clipboard) {
                  alert('Use fallback');
                  var textArea = document.createElement('textarea');
                  textArea.value = {{$profile->contact_number}};
                  // Avoid scrolling to bottom
                  textArea.style.top = '0';
                  textArea.style.left = '0';
                  textArea.style.position = 'fixed';
                  document.body.appendChild(textArea);
                  textArea.focus();
                  textArea.select();
                  document.execCommand('copy');
                  return;
                }
                else{
                  navigator.clipboard.writeText('{{$profile->contact_number}}').then(function() {
                    console.log('Async: Copying to clipboard was successful!');
                  }, function(err) {
                    console.error('Async: Could not copy text: ', err);
                  });
                }
              }">
                {{$profile->contact_number}}
              </span><br>
              <div class="border rounded p-2 absolute bg-white" x-show="show">{{__('Long press to copy')}}</div>
            </div>
              <x-contact-profile :profile="$profile"/>
        </div>
    </div>
    @if(Auth::user())
      @if(Auth::user()->role_id==1)
      @unless($profile->status)
        <div class="relative flex justify-center" x-data={show:false}>
          <x-jet-button x-on:click="show=!show" >Verify</x-jet-button>
          <div x-show="show" class="bg-white absolute bottom-0 border p-4">
            <a href="/profiles/{{$profile->id}}/verify?role=farmer&status=verify" class="underline">Farmer</a><br>
            <a href="/profiles/{{$profile->id}}/verify?role=trader&status=verify" class="underline">Trader</a>    
          </div>
        </div>
      @else
      <div class="flex justify-center">  
        <a href="/profiles/{{$profile->id}}/verify?status=unverify"><x-jet-button x-on:click="show=!show" >Unverify</x-jet-button></a>
      </div>
      @endunless
      @endif
    @endif
    @if($profile->expert_resiliencies_count)
      @livewire('expert.show',['profile'=>$profile])
    @elseif($profile->interest_resiliencies_count)
      <div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
        <span class="font-semibold text-lg">{{__('ui.models.resiliencies')}}</span>
        <div class="flex overflow-auto flex-nowrap">
                    @foreach ($profile->interest_resiliencies as $resiliency)
                    <a href="/resiliencies/{{$resiliency->id}}" class="mr-4 inline-flex  whitespace-nowrap items-center py-1 px-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:ring focus:ring-gray-300">{{$resiliency->name}}</a>
                    @endforeach
                  </div>                
      </div>
    @endif

    @if($profile->listings_count)
      <div class="max-w-7xl  sm:mx-auto mt-4 border-b  py-4">
        <div class="flex justify-between items-center">
          <span class="font-semibold text-lg">{{__('listing')}}</span>
          <a href="\listings\new">
            <x-jet-button>{{__('Add new')}}</x-jet-button>
          </a>
        </div>
        <div id="listings" class="mt-4">@livewire('card-group',['index'=>1,'type'=>'Listing','purpose'=>'children','model'=>$profile],key('card-group-listing-children-listing-'.$profile->id))
        </div>
      </div>
    @else
          <div class="mt-4 w-full grid justify-items-center">
            <a href="\listings\new">
              <x-jet-button>{{__('Add your listing')}}</x-jet-button>
            </a>
          </div>
    @endif
    @if($profile->stories_count)
      <div class="max-w-7xl sm:mx-auto mt-4 border-b py-4">
        <div class="flex justify-between items-center">
          <span class="font-semibold text-lg">{{__('story')}}</span>
          <a href="\stories\new">
            <x-jet-button>{{__('Add new')}}</x-jet-button>
          </a>
        </div>
      <div id="stories"  class="mt-4">@livewire('card-group',['index'=>0,'type'=>'Story','purpose'=>'children','model'=>$profile],key('card-group-story-children-story-'.$profile->id))</div>
      </div>
    @else
          <div class="mt-4 w-full grid justify-items-center">
            <a href="\stories\new">
              <x-jet-button>{{__('Share your experience')}}</x-jet-button>
            </a>
          </div>
    @endif
    @if($profile->statements)
    <div id="stories"  class="mt-4">@livewire('card-group',['index'=>0,'type'=>'Statement','purpose'=>'children','model'=>$profile],key('card-group-statement-children-statement-'.$profile->id))</div>
    @endif


    @if($profile->expert_resiliencies_count)
      @foreach($profile->expert_resiliencies as $resiliency)
        <div>@livewire('card-group',['index'=>$loop->index+3,'type'=>'Profile','purpose'=>'children','model'=>$resiliency],key('card-group-listing-children-profile-'.$resiliency->id))</div>
      @endforeach
    @endif
  </div>
</x-guest-layout>