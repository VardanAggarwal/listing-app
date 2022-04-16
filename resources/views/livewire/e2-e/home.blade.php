<div class="grid">
    <div>@livewire('e2-e.profile-nav')</div>
    <div>
        @livewire('e2-e.actions')
    </div>
    @if($screen=='price-discovery')
        @livewire('e2-e.price-discovery')
    @elseif($screen=='trades')
        @livewire('e2-e.trades')    
    @elseif($screen=='people')
        @livewire('e2-e.people')
    @else
        @livewire('e2-e.price-discovery')
    @endif
    @livewire('e2-e.bottom-nav')
</div>
