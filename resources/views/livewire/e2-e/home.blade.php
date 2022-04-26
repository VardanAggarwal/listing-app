<div class="flex flex-col">
    <div>@livewire('e2-e.profile-nav')</div>
    <div>
        @livewire('e2-e.actions')
    </div>
    <div>@livewire('e2-e.screens.card-group',['role'=>$role,'action'=>$action])</div>
    @livewire('e2-e.bottom-nav',['role'=>$role,'action'=>$action])
</div>
