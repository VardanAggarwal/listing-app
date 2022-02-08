<div class="mx-auto max-w-7xl">
    <select wire:model="model">
        @foreach($models as $value)
            <option value="{{$value}}" wire:click='updateModel'>{{$value}}</option>
        @endforeach
    </select>
    @livewire('relationship-search',['type'=>$model,'selected'=>$selected])
    <div class="grid justify-items-center mt-4">
    <button class="bg-gray-900 text-white border rounded-lg py-2 px-4" wire:click="save">Save</button>
    <span class="text-green-500">{{session('message')}}</span>
    </div>
</div>
