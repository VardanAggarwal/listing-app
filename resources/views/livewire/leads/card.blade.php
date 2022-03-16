<div class="w-full border rounded shadow-lg my-4 p-4 bg-gradient-to-br from-amber-300 to-yellow-200 justify-items-center grid grid-cols-1" x-init="mixpanel.track('Order Card Shown',{'position':'{{$index}}','title':'{{__('ui.leads.card.title')}}','subtitle':'{{__('ui.leads.card.subtitle')}}','button':'{{__('ui.leads.card.button')}}'})">
    <h1 class="text-2xl mb-4">{{__('ui.leads.card.title')}}</h1>
    <span class="font-medium">{{__('ui.leads.card.subtitle')}}</span>
    <div class="mt-2 flex justify-center">
    <a href="order"><x-jet-button class="border rounded p-2 bg-gray-900 text-white" x-on:click="mixpanel.track('Order Card Clicked',{'position':'{{$index}}','title':'{{__('ui.leads.card.title')}}','subtitle':'{{__('ui.leads.card.subtitle')}}','button':'{{__('ui.leads.card.button')}}'})">{{__('ui.leads.card.button')}}</x-jet-button></a>
    </div>
</div>
