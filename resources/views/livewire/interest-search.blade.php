<div class="max-w-7xl mx-4 sm:mx-auto">
    <h1 class="text-xl">{{__('ui.interest_title')}}</h1>
    <div class="flex flex-wrap my-2 gap-2 overflow-auto max-h-40">
        @foreach($resiliencies as $result)
            <div class="p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                {{$result->name}}
            </div>
        @endforeach
    </div>
    <input type="text" placeholder="{{__('Type to search')}}" wire:model="query" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
    @if($results)
    <div class="flex flex-wrap mt-5 gap-2">
        @foreach($results as $result)
            <div class="p-2 text-xs sm:text-sm rounded-lg shadow border {{in_array($result->id,$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$result->id}})">
                {{$result->name}}
            </div>
        @endforeach
        @if($this->query && !$this->results->contains('name',$this->query))
            <div class="cursor-pointer p-2 text-xs sm:text-sm rounded-lg shadow border" wire:click="newResiliency">
                {{$this->query}}+</div>
        @endif
    </div>
        <div>
        @if($results->hasMorePages())
          <x-jet-button wire:click.prevent="loadMore" class="mt-4 mb-10 text-center">{{__('Load More')}}</x-jet-button>
        @endif
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
    @endif
    <div class="fixed py-3 bg-white inset-x-0 bottom-0 sm:bottom-10 align-items-center shadow-inner grid justify-items-center">
        <button wire:click.prevent="save" class="px-4 py-2 w-64 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300">{{__('Continue')}}</button>
    </div>
</div>