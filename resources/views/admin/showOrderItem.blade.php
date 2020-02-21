@extends('layouts.admin')
@section('body')
<h2 class="my-3">Orders Items</h2>
<div class='table-responsive '>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ItemID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Total Price</th>
        </tr>
        @foreach ($orderitems as $orderitem)
        <tr>
            <td>{{$orderitem->item_id}}</td>
            <td>{{$orderitem->item_name}}</td>
            <td>{{number_format($orderitem->item_price)}}</td>
            <td>{{number_format($orderitem->item_amount)}}</td>
            <td>{{number_format($orderitem->item_price*$orderitem->item_amount)}}</td>


        </tr>

        @endforeach
    </table>
</div>
@endsection
