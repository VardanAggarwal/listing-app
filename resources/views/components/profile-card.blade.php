<div class="my-5 px-4 py-4 rounded-lg shadow border">
  <div class="flex gap-5 items-center">
      @if($model->user->profile_photo_url)
      <div class="flex-shrink-0 justify-self-center">
        <a href="/profiles/{{$model->id}}">
          <img src="{{$model->user->profile_photo_url}}" class="rounded-full h-16 w-16" />
        </a>
      </div>
      @endif
      <div class="flex-auto">
          <a href="/profiles/{{$model->id}}">
            <span class="font-semibold text-lg text-green-900">{{$model->name}}</span><br>
            <span class="">{{($model->address)}}, {{$model->pincode}}</span><br>
            <span>{{$model->contact_number}}</span><br>
        </a>
      </div>
  </div>
  <div class="mt-4"><x-contact-profile :profile="$model"></x-contact-profile></div>
</div>
