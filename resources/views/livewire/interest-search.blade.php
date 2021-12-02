<div class="">
    <input type="text" placeholder="Search" wire:model="query" wire:keydown="resetPage"class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
    @if($results)
    <div class="grid grid-cols-3 mt-5 gap-2">
        <div class="col-span-1">
            <span class="font-semibold text-md">{{__('Crops')}}</span>
            @foreach($results['App\Models\Crop'] as $result)
            <div class="mt-5  p-2 text-xs sm:text-sm rounded-lg shadow border break-all {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                    {{$result->name}}
                </div>
            @endforeach
        </div>
        <div class="col-span-1">
            <span class="font-semibold text-md">{{__('practice')}}</span>
            @foreach($results['App\Models\Practice'] as $result)
            <div class="mt-5  p-2 text-xs sm:text-sm rounded-lg shadow border break-all {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                    {{$result->name}}
                </div>
            @endforeach
        </div>
        <div class="col-span-1">
            <span class="font-semibold text-md">{{__('agrimodel')}}</span>
            @foreach($results['App\Models\Agrimodel'] as $result)
            <div class="mt-5  p-2 text-xs sm:text-sm rounded-lg shadow border break-all {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                    {{$result->name}}
                </div>
            @endforeach
        </div>
        <div
        x-data="{
            observe () {
                let observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            @this.call('loadMore')
                        }
                    })
                }, {
                    root: null
                })

                observer.observe(this.$el)
            }
        }"
        x-init="observe"
        ></div>
        @if($paginate->hasMorePages())
          <x-jet-button wire:click.prevent="loadMore" class="text-center">{{__('Load More')}}</x-jet-button>
          @else
          <div class="text-center">{{__('No more records')}}</div>
        @endif
    </div>
    @endif
    <div class="fixed py-3 bg-white inset-x-0 bottom-0 sm:bottom-10 align-items-center shadow-inner grid justify-items-center">
        <button wire:click.prevent="save" class="px-4 py-2 w-64 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300">{{__('Continue')}}</button>
    </div>

</div>