<div x-data="{selected: @entangle('selected').defer}" class="grid">
    <div>@livewire('e2-e.language')</div>
    <div class="grid justify-items-center p-4 my-10">
        <x-jet-application-logo  class="w-24 h-24"/>
        <h1 class="text-2xl font-semibold text-black">{{__('e2e.global.app_name')}}</h1>
        <span class="text-lg text-center text-brown italic">{{__('e2e.global.app_description')}}</span>
    </div>
    <div class="grid px-4 gap-5">
        @foreach($roles as $role)
        <div id="" class="w-full border rounded-xl p-4 bg-primary text-black justify-items-left grid" wire:click="submit('{{$role}}')"x-on:click="selected='{{$role}}'" :class="selected=='{{$role}}'?'border-brown':''">
            <div class="">
                <h1 class="text-xl font-semibold">{{__('e2e.roles.'.$role.'.label')}}</h1>
                <span class="text-md italic">{{__('e2e.roles.'.$role.'.activities')}}</span>
            </div>
        </div>
        @endforeach
    </div>
    <span class="text-center grid justify-items-center text-brown my-10">{{__('e2e.role_selection.alert')}}</span>
    <x-e2-e.loader/>
    <x-slot name="title">Herbal Mandi</x-slot>
    @push('meta')
    <meta property="og:title" content="Herbal Mandi">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="fb:app_id" content="852906262106769">
    <meta property="og:description" content="{{__('e2e.global.app_description')}}">
    @endpush
</div>