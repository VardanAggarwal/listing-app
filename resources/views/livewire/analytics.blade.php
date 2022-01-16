<div class="bg-white p-5 mx-auto max-w-min">
    @foreach($counts as $key=>$value)
    <span>{{ucwords($key)}}: {{$value}}</span><br>
    @endforeach
</div>
