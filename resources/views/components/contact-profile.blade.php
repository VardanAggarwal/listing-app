<div class="flex gap-4 text-green-500">
    <!--<a href="tel:{{$number}}" class="flex items-center gap-1"><i class="text-2xl fas fa-phone-alt"></i>{{__('Call')}}</a>-->
    <a href="https://wa.me/{{Str::remove('+',$number)}}?text={{__('ui.contact_message')}}" class="ml-4 flex items-center gap-1"><i class="text-3xl fab fa-whatsapp"></i>{{__('Whatsapp')}}</a>
</div>