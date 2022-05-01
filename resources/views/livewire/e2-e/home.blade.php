<div class="flex flex-col">
    <div>@livewire('e2-e.profile-nav')</div>
    <div>
        @livewire('e2-e.actions')
    </div>
    <div>@livewire('e2-e.screens.card-group',['role'=>$role,'action'=>$action])</div>
    @livewire('e2-e.bottom-nav',['role'=>$role,'action'=>$action])
    <x-slot name="title">Herbal Mandi-Home</x-slot>
    @push('meta')
    <meta property="og:title" content="Herbal Mandi-Home">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="fb:app_id" content="852906262106769">
    <meta property="og:description" content="{{__('e2e.global.app_description')}}">
    @endpush
</div>
