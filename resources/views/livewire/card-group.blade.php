<div class="bg-gray-100 py-4 pl-3">
    <span class="text-lg">{{__($title)}}</span>
<div class="flex items-center overflow-auto gap-4">
    @foreach($feed as $item)
        <div class="flex-none w-64">@livewire('simple-card',['model'=>$item, 'index'=>$loop->index, 'group_index'=>$index,'type'=>'Statement'])</div>
    @endforeach
</div>
</div>
