<div class="flex gap-4 text-green-500">
    <a href="tel:{{$number}}" class="flex items-center gap-1"><i class="text-2xl fas fa-phone-alt"></i>{{__('Call')}}</a>
    <a href="intent://send/?phone={{Str::remove('+',$number)}}&text={{__('ui.contact_message')}}#Intent;scheme=whatsapp;package=com.whatsapp;end" class="ml-4 flex items-center gap-1"><i class="text-3xl fab fa-whatsapp"></i>{{__('Whatsapp')}}</a>
</div>