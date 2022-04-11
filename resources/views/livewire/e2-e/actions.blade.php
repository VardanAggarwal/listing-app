<div class="w-screen sm:max-w-3xl">
    <h1 class="text-lg my-4">{{__('e2e.actions.title')}}</h1>
    <div class="flex flex-nowrap gap-5 justify-left overflow-auto p-2">
        @foreach($user_actions as $action)
        <div id="" class="flex flex-wrap items-center gap-2 border rounded-lg p-2 shadow">
            <div class="mx-auto">
                <img src="https://listing-app.s3.ap-south-1.amazonaws.com/public/actions/{{$action}}.jpg" loading="lazy" class="rounded-full object-cover h-16 w-16">
            </div>
            <div class="w-18">
                <span>{{__('e2e.actions.'.$action)}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>