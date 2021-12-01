<div class="py-8 max-w-7xl mx-4 sm:mx-auto">
    <input type="text" placeholder="Search" wire:model.debounce.250ms="query" wire:keydown="resetPage"class="w-full">
@if($results)
    @foreach($results as $result)
    <div class=" my-5 px-6 py-4 mx-4 rounded-lg shadow border" wire:loading.class="opacity-50">
        <div class="border-b border-gray-200 mb-3">
            <span>
                @php
                $item_type=Str::lower(Str::replace('App\\Models\\','',$result->resilient_type));
                @endphp
                <a href="/{{Str::plural($item_type)}}/" class="underline">
                {{Str::ucfirst(__($item_type))}}</a>
            </span>
        </div>    
        <x-resiliency-card :resiliency="$result"/>
    </div>
    @endforeach
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
    @if($results->hasMorePages())
      <x-jet-button wire:click.prevent="loadMore" class="text-center">{{__('Load More')}}</x-jet-button>
      @else
      <div class="text-center">{{__('No more records')}}</div>
    @endif
@endif
</div>