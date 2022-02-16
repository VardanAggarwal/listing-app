<div class="max-w-7xl mx-4 sm:mx-auto">
	<x-jet-validation-errors class="mb-4" />
	<form wire:submit.prevent="save">
		@csrf
		<h1 class="font-bold text-lg mb-0">
			{{__('ui.expert.form.title')}}
		</h1>
		@livewire('relationship-search',['type'=>'Resiliency','selected'=>$selected,'title'=>'ui.expert.form.resiliency'])
		<div class="mt-4">
	    <x-jet-label for="services" value="{{__('ui.expert.form.services')}}" />
	    	<div class="flex flex-wrap gap-2 mt-4">
        @foreach($service_types as $type)
        <div  wire:click="toggleService('{{$type}}')" class="p-1 px-2 border rounded-md {{in_array($type,$services)?'bg-green-300':''}}">{{__('ui.expert.services.'.$type)}}</div>
        @endforeach
        @if(in_array('others',$services))
       		<x-jet-input type="text" wire:model="other_services"/> 	
        @endif
        </div>
		</div>
		<div class="mt-4">
	    <x-jet-label for="contact" value="{{__('ui.expert.form.contact')}}" />
      @foreach($contact as $type=>$number)
      	<div>
	      	<span>
		      <input type="checkbox" class="rounded border-gray-400"  wire:click="toggleContact('{{$type}}')" {{$number?'checked':''}}/>
		      {{__('ui.expert.form.'.$type)}}
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