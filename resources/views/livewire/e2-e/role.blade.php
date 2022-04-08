<div x-data="{selected: @entangle('selected').defer}">
    <h1 class="text-2xl my-4">{{__('e2e.role_selection.title')}}</h1>
    @foreach($roles as $role)
    <div id="" class="w-full border rounded shadow-lg my-4 p-4 justify-items-left grid grid-cols-3 gap-5" x-on:click="toggle(selected,'{{$role}}')" :class="selected.indexOf('{{$role}}')>=0?'bg-green-400':''">
        <div class="col-span-1">
            <img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/roles/{{$role}}.jpg" loading="lazy" class="rounded-t-lg object-cover h-24 w-24">
        </div>
        <div class="col-span-2">
            <h1 class="text-xl">{{__('e2e.roles.'.$role.'.label')}}</h1>
            <span class="text-md">{{__('e2e.roles.'.$role.'.activities')}}</span>
        </div>
    </div>
    @endforeach
    <template x-if="selected.length>0">
        <span>{{__('e2e.role_selection.selected_roles',["roles"=>$role_string])}}</span>
    </template>
    <div class="py-2 bg-white border-t flex justify-center fixed sm:static inset-x-0 bottom-0 sm:inset-auto sm:bottom-auto">
        <x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="submit">Continue</x-jet-button>
    </div>
    <div class="h-12"></div>
    <script type="text/javascript">
        function toggle(array,value){
            var index = array.indexOf(value);
            if (index == -1) {
                array.push(value);
            } 
            else {
                do {
                    array.splice(index, 1);
                    index = array.indexOf(value);
                    } while (index != -1);
            }
            @this.set_string();
        }
    </script>
</div>