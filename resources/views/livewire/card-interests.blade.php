<div class="flex justify-between mt-1 pt-2 border-t text-sm">
	<div>
		<span class="static" x-data={open:false} @mouseleave="open=false">
			<span class="" @mouseenter="open=!open">{{$model->interested_profiles_count}}</span>
			@unless ($type=="Listing"||$type=="Story")
				<div class="absolute border rounded p-2 bg-white max-w-xs" style="display: none;" x-show="open" x-on:click="open=false">
					<span x-init="setTimeout(() => open = false, 1000)">{{__('ui.interest_help')}}</span>
				</div>
			@endunless
		</span>
		<a class="cursor-pointer" href="#interest-{{$type}}-{{$model->id}}" wire:click="toggleInterest">
			@if(Auth::user())
				@if(Auth::user()->profile)
					@if(Auth::user()->profile->{"interest_".Str::plural($type)}->contains($model))
						<span class="text-green-500"><i class="fas {{($type=='Listing'||$type=='Story')?'fa-thumbs-up':'fa-bookmark'}}"></i></span>
					@else
						<span class="text-green-500"><i class="far {{($type=='Listing'||$type=='Story')?'fa-thumbs-up':'fa-bookmark'}}"></i></span>
					@endif
				@endif
			@else
				<span class="text-green-500"><i class="far {{($type=='Listing'||$type=='Story')?'fa-thumbs-up':'fa-bookmark'}}"></i></span>
			@endif
		</a>
	</div>
	<div class="static" x-data={open:false} @mouseleave="open=false">
		<a class="underline" href="#help-{{$type}}-{{$model->id}}" x-on:click="open=!open">{{__('I need help with this')}}</a>
		<div class="absolute border rounded p-4 bg-white inset-x-4 sm:inset-x-auto" style="display: none;" x-init={open:false} x-show="open">
			@unless ($interest_recorded)
				<form wire:submit.prevent="save_interest">
					@csrf
					<h1 class="text-md font-bold">{{__("ui.help.title")}}</h1>
					@if($type=='Resiliency'||$type=='Category')
						<div class="block mt-4">
							<label for="input" class="">
								<x-jet-checkbox id="input" name="interest" wire:model="interest" value="input"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.input') }}</span>
							</label>
						</div>
						<div class="block mt-4">
							<label for="market" class="">
								<x-jet-checkbox id="market" name="interest" wire:model="interest" value="market"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.market') }}</span>
							</label>
						</div>
						<div class="block mt-4">
							<label for="training" class="">
								<x-jet-checkbox id="training" name="interest" wire:model="interest" value="training"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.training') }}</span>
							</label>
						</div>
					@endif
					@if($type=='Listing')
						<div class="block mt-4">
							<label for="connect" class="">
								<x-jet-checkbox id="connect" name="interest" wire:model="interest" value="connect"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.connect') }}</span>
							</label>
						</div>
						<div class="block mt-4">
							<label for="payment" class="">
								<x-jet-checkbox id="payment" name="interest" wire:model="interest" value="payment"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.payment') }}</span>
							</label>
						</div>
						<div class="block mt-4">
							<label for="logistics" class="">
								<x-jet-checkbox id="logistics" name="interest" wire:model="interest" value="logistics"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.logistics') }}</span>
							</label>
						</div>
					@endif
					@if($type=='Story')
					<div class="block mt-4">
						<label for="connect" class="">
							<x-jet-checkbox id="connect" name="interest" wire:model="interest" value="connect"/>
							<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.connect') }}</span>
						</label>
					</div>
					@endif
					<div  x-data={others:false}>
						<div class="block mt-4">
							<label for="others" class="">
								<x-jet-checkbox id="others" name="interest"  x-on:click="others=!others" wire:model="interest" value="others"/>
								<span class="ml-2 text-sm text-gray-600">{{ __('ui.help.others') }}</span>
							</label>
						</div>
						<div class="mt-4"x-show="others">
							<x-jet-label for="others"/>
							<x-jet-input id="others" class="block mt-1 w-full" name="interest" wire:model="others" type="text" placeholder="{{ __('ui.help.others_placeholder') }}"/>
						</div>
					</div>
					<div class="mt-4 flex justify-center">
						<x-jet-button type="submit" class="bg-green-400">{{__("Submit")}}</x-jet-button>
					</div>
				</form>
			@else
				<span x-init="setTimeout(() => open = false, 2000)"x-on:click="open=false" class="text-green-700">{{__('ui.help.recorded_interest')}}</span>
			@endunless
		</div>
	</div>
</div>
