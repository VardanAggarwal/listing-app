<div>
    @php
    $agent=request()->header('User-Agent');
    if(($pos=strpos($agent,'Seed Savers Club')!==FALSE)){
      if(($pos=strpos($agent,'Seed Savers Club-')!==FALSE)){
        $version= str_replace('Seed Savers Club-','',request()->header('User-Agent')); 
        request()->session()->put('version', $version);
      }else{
        $version='0';
      }
    }else{
      $version='1';
    }
    @endphp
    @unless($version==0)
      @if($profile->contact_number)
        <div class="flex gap-4 text-green-500" x-init="">
            <a href="tel:{{$number}}" x-on:click="                mixpanel.track('Call Clicked',{'profile_id':{{$profile->id}},'number':'{{$profile->contact_number}}'})" class="flex items-center gap-1"><i class="text-2xl fas fa-phone-alt"></i>{{__('Call')}}</a>
            <a href="https://wa.me/{{Str::remove('+',$number)}}?text={{__('ui.contact_message',['url'=>'https://app.seedsaversclub.com/profiles/'.$profile->id])}}" x-on:click="                mixpanel.track('Whatsapp Clicked',{'profile_id':{{$profile->id}},'number':'{{$profile->contact_number}}'})" class="ml-4 flex items-center gap-1"><i class="text-3xl fab fa-whatsapp"></i>{{__('Whatsapp')}}</a>
        </div>
      @endif
    @endunless
</div>