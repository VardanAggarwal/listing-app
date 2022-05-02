<div>
    <table class="table-fixed">
        <thead>
            <tr>
                <th>Item</th>
                <th>Min. price</th>
                <th>Max. price</th>
                <th>Total quantity</th>
                <th>Traders</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trades as $trade)
                <tr>
                    <td><a href="/e2e/trade/{{$trade->id}}" class="underline text-blue">{{$trade->item->name}}</a></td>
                    <td>{{$trade->min}}</td>
                    <td>{{$trade->max}}</td>
                    <td>{{$trade->sum}}</td>
                    <td>{{$trade->count}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
