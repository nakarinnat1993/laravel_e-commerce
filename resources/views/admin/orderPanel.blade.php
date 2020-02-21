@extends('layouts.admin')
@section('body')
<h2 class="my-3">Orders</h2>
<div class='table-responsive '>
    <table class="table table-striped table-bordered">
        <tr>
            <th>OrderID</th>
            <th>Date</th>
            <th>Delivery</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>User</th>
            <th>Order Details</th>
        </tr>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->create_date}}</td>
            <td>{{$order->del_date}}</td>
            <td>{{$order->price}}</td>
            <td>
                @if ($order->status=="Not paid")
                <span class="badge badge-danger">{{$order->status}}</span>
                @else
                <span class="badge badge-success">{{$order->status}}</span>
                @endif
            </td>
            <td>{{$order->user_id}}</td>
            <td><a href="/admin/showOrderItem/{{$order->id}}"class="btn btn-info">Detail</a></td>

        </tr>

        @endforeach
    </table>
    {{$orders->links()}}
</div>
@endsection
