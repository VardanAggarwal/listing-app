<div class="bg-white p-5 mx-auto max-w-min">
    <table>
    <tbody>
    @foreach($counts as $key=>$value)
    <tr><td>{{ucwords($key)}}</td><td> {{Str::limit($value,4)}}</td><td></td></tr>
    @endforeach
    @foreach($interests as $key=>$value)
    <tr class="text-lg"><th>{{ucwords($key)}}</td></th>
        @foreach($value as $item)
            <tr class="">
                <td class=""><a class="overflow-clip prose" href="\{{Str::lower(Str::plural(Str::replace('App\\Models\\','',$item->interestable_type)))}}\{{$item->interestable_id}}">{{$item->interestable->title}}{{$item->interestable->name}}{{$item->interestable->statement}}</a></td>
                @if($item->others)
                    <td class="">{{$item->others}}</td>
                @endif
                <td class="">{{$item->total}}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</div>
