<?php
namespace App;

class Cart
{
    public $item;
    public $totalQty;
    public $totalPrice;

    public function __construct($preCart)
    {
        $this->item = [];
        $this->totalQty = 0;
        $this->totalPrice = 0;
    }

    public function addItem($id, $product)
    {
        $price = (int) $product->price;
        $productToAdd = ['qty' => 1, 'totalSinglePrice' => $price,'data'=>$product];

        $this->item[$id]=$productToAdd;
        $this->totalQty++;
        $this->totalPrice = $this->totalPrice+$price;
    }

}
