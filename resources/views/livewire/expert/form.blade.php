<div class="max-w-7xl mx-4 sm:mx-auto">
	<x-jet-validation-errors class="mb-4" />
	<form wire:submit.prevent="save">
		@csrf
		@livewire('relationship-search',['type'=>'Resiliency','selected'=>$selected])
		<div class="mt-4">
	    <x-jet-label for="services" value="{{ __('Type') }}" />
	    	<div class="flex flex-wrap gap-2">
        @foreach($service_types as $type)
        <div  wire:click="toggleService('{{$type}}')" class="p-2 border rounded-md {{in_array($type,$services)?'bg-green-300':''}}">{{__($type)}}</div>
        @endforeach
        @if(in_array('others',$services))
       		<x-jet-input wire:model="other_services"/> 	
        @endif
        </div>
		</div>
		<div class="mt-4">
	    <x-jet-label for="contact" value="{{ __('contact_number') }}" />
      @foreach($contact as $type=>$number)
      	<div>
	      	<span>
		      <x-jet-input type="checkbox"  wire:click="toggleContact('{{$type}}')" checked="{{$type}}"/>
		      {{__($type)}}
	    		</span><br>
	    		@if($number)
	    		<x-jet-input type="text" wire:model="contact.{{$type}}"/>
	    		@endif
    		</div>
      @endforeach
		</div>
		<x-jet-validation-errors class="mb-4" />
		<div class="grid w-full mt-4 justify-items-center" wire:loading.class="opacity-20" wire:target="save">
		    <x-jet-button class="max-w-md justify-center" type="submit">
		        {{ __('Submit') }}
		    </x-jet-button>
		</div>
	</form>
</div>