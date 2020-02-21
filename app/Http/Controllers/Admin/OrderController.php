<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderPanel()
    {
        $orders = DB::table('orders')->paginate(10);
        return view('admin.orderPanel', compact('orders'));
    }
    public function showOrderItem($id)
    {
        $orderitems=DB::table('orders')
        ->join('orderitems','orders.id','=','orderitems.order_id')
        ->where('orderitems.order_id',$id)
        ->get();
        // dd($orderitems);
        return view('admin.showOrderItem',compact('orderitems'));

    }
}
