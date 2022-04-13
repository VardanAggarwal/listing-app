<div>
    <div class="p-2 float-right">
        <img src="https://via.placeholder.com/100.jpg?text=profile" class="h-8 w-8 rounded-full">
    </div>
    <div class="mt-8">
        @livewire('e2-e.actions')
    </div>
    @livewire('e2-e.price-discovery')
    <div class="h-20 bg-white"></div>
    <div class="h-20 grid grid-cols-3 fixed bottom-0 w-screen sm:max-w-3xl bg-green-500">
        <div class="grid border text-center p-4">
            <span><i class="fas fa-home"></i></span>
            <span class="text-xs">Home</span>
        </div>
        <div class="grid border text-center p-4">
            <span><i class="fas fa-scale-balanced"></i></span>
            <span class="text-xs">Buy/Sell</span>
        </div>
        <div class="grid border text-center p-4">
            <span><i class="fas fa-users"></i></span>
            <span class="text-xs">People</span>
        </div>
    </div>
</div>
