<div class="w-screen sm:max-w-3xl border-b">
    <div class="flex flex-nowrap gap-5 justify-left overflow-auto p-2">
        @foreach($user_actions as $action)
        <div id="" class="basis-12 flex flex-wrap justify-items-center items-center p-2">
            <div class="mx-auto">
                <img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/actions/{{$action}}.jpg" loading="lazy" class="rounded-full object-cover h-10 w-10">
            </div>
            <div class="w-12">
                <p class="leading-3 text-xs">{{__('e2e.actions.'.$action)}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>