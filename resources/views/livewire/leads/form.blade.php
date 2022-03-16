<div class="">
    @unless($form||$success)
    <div>
      <div class="w-full pt-12 px-4 pb-4 bg-gradient-to-br from-lime-100 to-zinc-50">
        <h1 class="text-3xl mb-4">{{__('ui.leads.form.title')}}</h1>
        <span class="text-gray-700">{{__('ui.leads.form.purpose')}}</span>
        <div class="mt-2 p-2 flex justify-center">
        <x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="$set('form',true)">{{__('ui.leads.form.button1')}}</x-jet-button>
        </div>
      </div>
      <div class="mt-8 px-4">
        <h1 class="text-3xl">{{__('ui.leads.form.advantage_title')}}</h1>
        <ul class="sm:flex sm:gap-5">
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.advantage1')}}</li>
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.advantage2')}}</li>
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.advantage3')}}</li>
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.advantage4')}}</li>
        </ul>
        <div class="mt-2 p-2 flex justify-center">
        <x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="$set('form',true)">{{__('ui.leads.form.button1')}}</x-jet-button>
        </div>
      </div>
      <div class="mt-8 px-4">
        <h1 class="text-3xl">{{__('ui.leads.form.how_title')}}</h1>
        <ul class="sm:flex sm:gap-5">
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.how1')}}</li>
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.how2')}}</li>
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.how3')}}</li>
            <li class="border rounded-lg border-gray-100 bg-gray-100 p-4 my-4">{{__('ui.leads.form.how4')}}</li>
        </ul>
        <div class="mt-2 p-2 flex justify-center">
        <x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="$set('form',true)">{{__('ui.leads.form.button1')}}</x-jet-button>
        </div>
      </div>
    </div>
    @endunless
    @if($form)
    <div class="px-4" x-init="window.scrollTo(0, 0);">
        <h1 class="text-xl">{{__('ui.leads.form.select_vc_title')}}</h1>
        <splan class="font-medium">{{__('ui.leads.form.select_vc_subtitle')}}</h1>
        <div class="mb-4 overflow-auto flex flex-wrap gap-4 py-4">
          @foreach ($resiliencies as $resiliency)
            <div class="w-24 border grid justify-items-center rounded-lg {{in_array($resiliency['id'],$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$resiliency['id']}})">
                @if($resiliency['image_url'])
                    <img src="{{$resiliency['image_url']}}" loading="lazy" class="rounded-t-lg object-cover h-24 w-24"/>
                @endif
                <span class="text-sm m-2">{{$resiliency['name']}}</span>
            </div>
          @endforeach
        </div>
        <span class="text-xl">{{__('ui.leads.form.comments_label')}}</span>
        <textarea class="w-full rounded border-gray-400" wire:model="comments" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' placeholder="{{__('ui.leads.form.comments_placeholder')}}"></textarea>
        <div>
          <div>
              <x-jet-label for="phone_number" value="{{ __('ui.contact_number') }}" />
              <div class="flex items-center">
                <span class="text-lg mr-2">+91</span>
                <x-jet-input id="phone_number" class="block mt-1 w-full" wire:model="profile.contact_number" type="text" name="phone_number" maxlength="10" required />
              </div>
          </div>
          <div class="mt-4">
              <x-jet-label for="name" value="{{ __('ui.name') }}" />
              <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="profile.name"/>
          </div>
          <div class="mt-4">
              <x-jet-label for="address" value="{{ __('ui.address') }}" />
              <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model="profile.address"/>
          </div>
          <div class="mt-4">
              <x-jet-label for="pincode" value="{{ __('ui.pincode') }}" />
              <x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" wire:model="profile.pincode"/>
          </div>
        </div>
        <div class="my-4">
          <x-jet-validation-errors/>
        </div>
        <div class="mt-2 flex justify-center">
        <x-jet-button class="border rounded p-2 bg-gray-900 text-white" wire:click="submit">{{__('ui.leads.form.submit_button')}}</x-jet-button>
        </div>
    </div>
    @endif
    @if($success)
    <div class="grid grid-cols-1 justify-items-center" x-init="setTimeout(() => {window.location.href='/'}, 1000)">
      <span class="text-xl text-green-500">{{__('ui.leads.form.submit_message')}}</span>
      <div class="mt-2 flex justify-center">
      <a href="/"><x-jet-button class="border rounded p-2 bg-gray-900 text-white">{{__('ui.leads.form.redirect_button')}}</x-jet-button></a>
      </div>
    </div>
    @endif
</div>