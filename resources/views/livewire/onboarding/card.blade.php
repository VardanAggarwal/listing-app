<div>
    @if($show)
    <div class="w-full border rounded shadow-lg my-4 p-4 bg-gradient-to-br from-amber-300 to-yellow-200 justify-items-center grid grid-cols-1" x-init="mixpanel.track('Onboarding Card Shown',{'position':'{{$index}}','title':'{{__('ui.onboarding.card.title')}}','subtitle':'{{__('ui.onboarding.card.subtitle')}}','button':'{{__('ui.onboarding.card.button')}}'})">
        <h1 class="text-2xl mb-4">{{__('ui.onboarding.card.title')}}</h1>
        <span class="font-medium">{{__('ui.onboarding.card.subtitle')}}</span>
        <div class="mt-2 flex justify-center gap-5">
        <a href="/onboarding"><x-jet-button class="border rounded-full p-2 bg-green-900 text-white text-md" x-on:click="mixpanel.track('Onboarding Card Clicked',{'position':'{{$index}}','title':'{{__('ui.onboarding.card.title')}}','subtitle':'{{__('ui.onboarding.card.subtitle')}}','button':'{{__('ui.onboarding.card.farmer_button')}}','role':'farmer'})">{{__('ui.onboarding.card.farmer_button')}}</x-jet-button></a>
        <a href="/expert/form"><x-jet-button class="border rounded-full p-2 bg-sky-900 text-white text-md" x-on:click="mixpanel.track('Onboarding Card Clicked',{'position':'{{$index}}','title':'{{__('ui.onboarding.card.title')}}','subtitle':'{{__('ui.onboarding.card.subtitle')}}','button':'{{__('ui.onboarding.card.expert_button')}}','role':'expert'})">{{__('ui.onboarding.card.expert_button')}}</x-jet-button></a>
        </div>
    </div>
    @endif
</div>