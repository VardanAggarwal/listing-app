<div class="max-w-3xl sm:border sm:p-4 mx-4 sm:mx-auto">
	@if($stage=='services')
	<div id="services">
		<h1 class="text-2xl my-4">{{__('ui.onboarding.services.title')}}</h1>
		<div id="seed" class="w-full border rounded shadow-lg my-4 p-4 justify-items-center grid grid-cols-3 gap-5 {{isset($services['seed'])?$services['seed']=='user'?'bg-lime-200':'bg-sky-200':''}}">
			<div class="col-span-1">
				<img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/Seeds.png" loading="lazy" class="rounded-t-lg object-cover h-24 w-24">
			</div>
			<div class="col-span-2">
				<h1 class="text-xl mb-4">{{__('ui.onboarding.services.seeds')}}</h1>
				<div class="mt-2 flex justify-center gap-10">
					<x-jet-button class="border rounded-full p-2 bg-green-900 text-white" wire:click="setService('seed','user')">{{__('ui.onboarding.services.buy_button')}}</x-jet-button>
					<x-jet-button class="border rounded-full p-2 bg-sky-900 text-white" wire:click="setService('seed','expert')">{{__('ui.onboarding.services.sell_button')}}</x-jet-button>
				</div>
			</div>
		</div>
		<div id="other-input" class="w-full border rounded shadow-lg my-4 p-4 justify-items-center grid grid-cols-3 gap-5 {{isset($services['input'])?$services['input']=='user'?'bg-lime-200':'bg-sky-200':''}}">
			<div class="col-span-1">
				<img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/fertiliser.png" loading="lazy" class="rounded-t-lg object-cover h-24 w-24">
			</div>
			<div class="col-span-2">
				<h1 class="text-xl mb-4">{{__('ui.onboarding.services.other_inputs')}}</h1>
				<div class="mt-2 flex justify-center gap-10">
					<x-jet-button class="border rounded-full p-2 bg-green-900 text-white" wire:click="setService('input','user')">{{__('ui.onboarding.services.buy_button')}}</x-jet-button>
					<x-jet-button class="border rounded-full p-2 bg-sky-900 text-white" wire:click="setService('input','expert')">{{__('ui.onboarding.services.sell_button')}}</x-jet-button>
				</div>
			</div>
		</div>
		<div id="training" class="w-full border rounded shadow-lg my-4 p-4 justify-items-center grid grid-cols-3 gap-5 {{isset($services['training'])?$services['training']=='user'?'bg-lime-200':'bg-sky-200':''}}">
			<div class="col-span-1">
				<img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/training.png" loading="lazy" class="rounded-t-lg object-cover h-24 w-24">
			</div>
			<div class="col-span-2">
				<h1 class="text-xl mb-4">{{__('ui.onboarding.services.training')}}</h1>
				<div class="mt-2 flex justify-center gap-10">
					<x-jet-button class="border rounded-full p-2 bg-green-900 text-white" wire:click="setService('training','user')">{{__('ui.onboarding.services.get_button')}}</x-jet-button>
					<x-jet-button class="border rounded-full p-2 bg-sky-900 text-white" wire:click="setService('training','expert')">{{__('ui.onboarding.services.give_button')}}</x-jet-button>
				</div>
			</div>
		</div>
		<div id="produce" class="w-full border rounded shadow-lg my-4 p-4 justify-items-center grid grid-cols-3 gap-5 {{isset($services['marketing'])?$services['marketing']=='user'?'bg-lime-200':'bg-sky-200':''}}">
			<div class="col-span-1">
				<img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/market.png" loading="lazy" class="rounded-t-lg object-cover h-24 w-24">
			</div>
			<div class="col-span-2">
				<h1 class="text-xl mb-4">{{__('ui.onboarding.services.produce')}}</h1>
				<div class="mt-2 flex justify-center gap-10">
					<x-jet-button class="border rounded-full p-2 bg-green-900 text-white" wire:click="setService('marketing','user')">{{__('ui.onboarding.services.sell_button')}}</x-jet-button>
					<x-jet-button class="border rounded-full p-2 bg-sky-900 text-white" wire:click="setService('marketing','expert')">{{__('ui.onboarding.services.buy_button')}}</x-jet-button>
				</div>
			</div>
		</div>
		<div id="advice" class="w-full border rounded shadow-lg my-4 p-4 justify-items-center grid grid-cols-3 gap-5 mb-20 {{isset($services['advice'])?$services['advice']=='user'?'bg-lime-200':'bg-sky-200':''}}">
			<div class="col-span-1">
				<img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/advice.png" loading="lazy" class="rounded-t-lg object-cover h-24 w-24">
			</div>
			<div class="col-span-2">
				<h1 class="text-xl mb-4">{{__('ui.onboarding.services.advice')}}</h1>
				<div class="mt-2 flex justify-center">
					<x-jet-button class="border rounded-full p-2 bg-green-900 text-white" wire:click="setService('advice','user')">{{__('ui.onboarding.services.get_button')}}</x-jet-button>
				</div>
			</div>
		</div>
		<div class="py-2 bg-white border-t flex justify-center fixed sm:static inset-x-0 bottom-0 sm:inset-auto sm:bottom-auto">
			<x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="$set('stage','vcs')">{{__('ui.onboarding.services.continue')}}</x-jet-button>
		</div>
		<div class="h-10"></div>
	</div>
	@endif
	@if($stage=="vcs")
	<div id="value-chains">
		<h1 class="text-2xl my-4">{{__('ui.onboarding.vcs.title')}}</h1>
		<div class="grid grid-cols-3 sm:grid-cols-8 gap-5">
			@foreach ($resiliencies as $resiliency)
			  <div class="w-24 border grid justify-items-center rounded-lg {{in_array($resiliency['id'],$selected)?'bg-green-300':''}}" wire:click="toggleSelected({{$resiliency['id']}})">
			      @if($resiliency['image_url'])
			          <img src="{{$resiliency['image_url']}}" loading="lazy" class="rounded-t-lg object-cover h-24 w-24"/>
			      @endif
			      <span class="m-2">{{$resiliency['name']}}</span>
			  </div>
			@endforeach
		</div>
		@livewire('relationship-search',['type'=>'Resiliency','selected'=>$selected,'title'=>__('ui.onboarding.vcs.others')])
		<div class="py-2 bg-white border-t flex justify-center fixed sm:static inset-x-0 bottom-0 sm:inset-auto sm:bottom-auto">
			<x-jet-button class="border rounded-full p-2 bg-gray-900 text-white" wire:click="submit">{{__('ui.onboarding.vcs.submit')}}</x-jet-button>
		</div>
		<div class="h-20"></div>
	</div>
	@endif
</div>