<?php
namespace App;

class Cart
{
    public $items;
    public $totalQty;
    public $totalPrice;

    public function __construct($prevCart)
    {
        if ($prevCart != null) {
            $this->items = $prevCart->items;
            $this->totalQty = $prevCart->totalQty;
            $this->totalPrice = $prevCart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function addItem($id, $product)
    {
        $price = (int) $product->price;
        if(array_key_exists($id,$this->items)){
            $productToAdd = $this->items[$id];
            $productToAdd['qty']++;
            $productToAdd['totalSinglePrice']=$productToAdd['qty']*$price;
        }else{
            $productToAdd = ['qty' => 1, 'totalSinglePrice' => $price, 'data' => $product];
        }

        $this->items[$id] = $productToAdd;
        $this->totalQty++;
        $this->totalPrice = $this->totalPrice + $price;
    }

}
