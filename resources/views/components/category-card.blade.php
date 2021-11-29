<div class="">
  <span class="font-semibold text-xl text-green-900">{{$item->resiliency->name}}</span>
  <div class="overflow-ellipsis overflow-hidden h-12">{{$item->feedable}}</div>
  <a href="/{{Str::plural($item->type)}}/{{$item->feedable_id}}" class="underline">{{__('See more...')}}</a>
</div>
