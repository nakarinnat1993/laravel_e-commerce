@extends('layouts.index')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dump($cartItems) --}}
                    @foreach ($cartItems->items as $item)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('storage')}}/product_image/{{$item['data']['image']}}" alt=""
                                    width="60"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item['data']['name']}}</a></h4>
                            <p>{{$item['data']['category']->name}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($item['data']['price'])}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="javascript:void(0)"
                                    onclick="incrementCart('{{$item['data']['id']}}')"> +
                                </a>
                                <input class="cart_quantity_input" type="text" name="quantity{{$item['data']['id']}}"
                                id="quantity{{$item['data']['id']}}" value="{{$item['qty']}}" autocomplete="off"
                                size="2" readonly>
                                <a class="cart_quantity_down" href="javascript:void(0)"
                                    onclick="decrementCart('{{$item['data']['id']}}')"> -
                                </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" id="totalSinglePrice{{$item['data']['id']}}">{{number_format($item['totalSinglePrice'])}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="/product/cart/deleteItemCart/{{$item['data']['id']}}"
                                onclick="return confirm('Are you sure ?')"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="total_area">
                    <ul>
                        <li>Total Q'ty <span id="totalQtyLi">{{$cartItems->totalQty}}</span></li>
                        <li>Total Price<span id="totalPrice">{{number_format($cartItems->totalPrice)}}</span></li>
                    </ul>
                    @if (count($cartItems->items)>0)
                    @endif
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="/product/checkout">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<script>
    $(document).ready(function(){

    });

    function incrementCart(id){
        // alert(id);
        $.ajax({
            url:"/product/incrementCart",
            method:'GET',
            data:{id:id},
            dataType:'json',
            success:function(data){
                $("#quantity"+id).val(data.items[id].qty);
                $("#totalSinglePrice"+id).html(data.items[id].totalSinglePrice);
                $("#totalQty").html(data.totalQty);
                $("#totalQtyLi").html(data.totalQty);
                $("#totalPrice").html(data.totalPrice);
            }
        })
    }
    function decrementCart(id){
        // alert(id);
        $.ajax({
            url:"/product/decrementCart",
            method:'GET',
            data:{id:id},
            dataType:'json',
            success:function(data){
                $("#quantity"+id).val(data.items[id].qty);
                $("#totalSinglePrice"+id).html(data.items[id].totalSinglePrice);
                $("#totalQty").html(data.totalQty);
                $("#totalQtyLi").html(data.totalQty);
                $("#totalPrice").html(data.totalPrice);
                if(data.error){
                    alert(data.error);
                }
            }
        })
    }
</script>
@endsection
