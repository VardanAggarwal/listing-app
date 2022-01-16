<x-guest-layout>
  <div class="py-8 max-w-7xl mx-4 sm:mx-auto">
				  <x-jet-validation-errors class="mb-4" />

		<form method="POST" action="/profiles">
			@csrf
			<input type="hidden" name="id" value="{{$profile?$profile->id:''}}">
			<h1 class="font-bold text-lg mb-4">
			  {{__('ui.welcome')}}
			</h1>
			<div class="mt-4">
				<x-jet-label for="name" value="{{ __('ui.name') }}" />
				<x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$profile?$profile->name:''" autofocus />
			</div>
			<div class="mt-4">
				<x-jet-label for="address" value="{{ __('ui.address') }}" />
				<x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$profile?$profile->address:''" autofocus />
			</div>
			<div class="mt-4">
				<x-jet-label for="pincode" value="{{ __('ui.pincode') }}" />
				<x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" :value="$profile?$profile->pincode:''" maxlength="6" autofocus />
			</div>
			<div class="mt-4">
				<x-jet-label for="contact_number" value="{{ __('ui.contact_number') }}" />
				<x-jet-input id="contact_number" class="block mt-1 w-full" type="text" maxlength="10" name="contact_number" :value="$profile?$profile->contact_number:''" autofocus />
			</div>
			<div class="grid w-full mt-4 justify-items-center">
				<x-jet-button class="max-w-md justify-center">
					{{ __('ui.onboarding_submit') }}
				</x-jet-button>
			</div>
		</form>

  </div>
</x-guest-layout>