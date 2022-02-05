<div class="bg-white p-5 mx-auto max-w-min">
    @foreach($counts as $key=>$value)
    <span>{{ucwords($key)}}: {{$value}}</span><br>
    @endforeach
    <table class="mb-4 border-b">
    @foreach($interests as $key=>$value)
    <tr class="text-lg"><th>{{ucwords($key)}}</td></th>
        @foreach($value as $item)
            <tr class="">
                <td class="w-32"><a class="overflow-clip" href="\{{Str::lower(Str::plural(Str::replace('App\\Models\\','',$item->interestable_type)))}}\{{$item->interestable_id}}">{{$item->interestable->title}}{{$item->interestable->name}}{{$item->interestable->statement}}</a></td>
                @if($item->others)
                    <td class="col-span-1">{{$item->others}}</td>
                @endif
                <td class="col-span-1">{{$item->total}}</td>
            </tr>
        @endforeach
    @endforeach
</table>
</div>
