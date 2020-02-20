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
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p> Shipping/Bill To</p>
                        <div class="form-one">
                            <div class="total_area" style="padding:10px">
                                <ul>
                                    <li>
                                        Payment status
                                        @if ($payment_info['status']=='Not paid')
                                            <span>ยังไม่ชำระเงิน</span>
                                        @endif

                                    </li>
                                    <li>
                                        Total
                                        <span>{{number_format($payment_info['price'])}}</span>
                                    </li>
                                </ul>
                                <a class="btn btn-default update" href="">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
