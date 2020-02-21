<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $cartItems = Session::get('cart');
        $products = Product::paginate(6);
        $minPrice = Product::min('price');
        $categories = Category::all()->sortBy('name');
        return view('product.welcome', compact('products', 'categories', 'cartItems', 'minPrice'));
    }
    public function findCategory($id)
    {
        $categories = Category::all();
        $category_clicked = Category::find($id);
        $products = $category_clicked->products()->paginate(6);
        return view('product.findProduct', compact('categories', 'category_clicked', 'products'));
    }
    public function detail($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.showPorductDetail', compact('product', 'categories'));
    }
    public function addToCart($id)
    {
        // session()->forget('cart');
        $product = Product::find($id);
        $prevCart = session()->get('cart');
        $cart = new Cart($prevCart);
        $cart->addItem($id, $product);
        session()->put('cart', $cart);
        return redirect('/');
    }
    public function addQtyToCart(Request $request)
    {
        $id = $request->_id;
        $qty = $request->qty;
        // dd($request->all());
        $product = Product::find($id);
        $prevCart = session()->get('cart');
        $cart = new Cart($prevCart);
        $cart->addQtyitem($id, $product, $qty);
        session()->put('cart', $cart);
        return redirect()->route('showCart');
    }
    public function showCart()
    {
        $cartItems = Session::get('cart');
        if ($cartItems) {
            // $cartItems = $cart;
            return view('product.showCart', compact('cartItems'));
            // return view('product.showCart')->with('cartItems',$cart);
        } else {
            return redirect('/');
        }
    }
    public function deleteItemCart($id)
    {
        $cart = Session::get('cart');
        if (array_key_exists($id, $cart->items)) {
            unset($cart->items[$id]);
        }
        $afterCart = Session::get('cart');
        $updateCart = new Cart($afterCart);
        $updateCart->updatePriceQty();
        Session::put('cart', $updateCart);
        return redirect()->route('showCart');
    }
    public function incrementCart($id)
    {
        $product = Product::find($id);
        $prevCart = session()->get('cart');
        $cart = new Cart($prevCart);
        $cart->addItem($id, $product);
        session()->put('cart', $cart);
        return redirect()->route('showCart');
    }
    public function decrementCart($id)
    {
        $product = Product::find($id);
        $prevCart = session()->get('cart');
        $cart = new Cart($prevCart);
        if ($cart->items[$id]['qty'] > 1) {
            $cart->items[$id]['qty'] = $cart->items[$id]['qty'] - 1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['qty'] * $product['price'];
            $cart->updatePriceQty();
            session()->put('cart', $cart);
        } else {
            Session()->flash('error', 'Please select at least one item.');
        }
        return redirect()->route('showCart');
    }

    public function searchProduct(Request $request)
    {
        $cartItems = Session::get('cart');
        $search = $request->search;
        $products = Product::where("name", "like", "%{$search}%")->paginate(6);
        $categories = Category::all()->sortBy('name');
        $minPrice = Product::min('price');
        return view('product.welcome', compact('products', 'categories', 'cartItems', 'minPrice'));
    }
    public function searchProductPrice(Request $request)
    {
        $cartItems = Session::get('cart');
        $arrPrice = explode(",", $request->price);
        $products = Product::whereBetween('price', $arrPrice)->orderBy('price')->paginate(2);
        $categories = Category::all()->sortBy('name');
        $minPrice = Product::min('price');
        return view('product.welcome', compact('products', 'categories', 'cartItems', 'minPrice'));
    }
    public function checkout()
    {
        return view('product.checkoutPage');
    }
    public function createOrder(Request $request)
    {
        $cartItems = Session::get('cart');
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $address = $request->address;
        $zip = $request->zip;
        $phone = $request->phone;
        $user_id = Auth::id();

        if ($cartItems) {
            $create_date = date("Y-m-d H:i:s");
            $newOrder = array(
                "create_date" => $create_date,
                "price" => $cartItems->totalPrice,
                "status" => "Not paid",
                "del_date" => $create_date,
                "fname" => $fname,
                "lname" => $lname,
                "address" => $address,
                "email" => $email,
                "zip" => $zip,
                "phone" => $phone,
                "user_id" => $user_id,
            );

            $create_order = DB::table('orders')->insert($newOrder);
            $order_id = DB::getPDO()->lastInsertId();
            foreach ($cartItems->items as $item) {
                $item_id = $item['data']['id'];
                $item_name = $item['data']['name'];
                $item_price = $item['data']['price'];
                $item_amount = $item['qty'];
                $newOrderItem = array(
                    "item_id" => $item_id,
                    "order_id" => $order_id,
                    "item_name" => $item_name,
                    "item_price" => $item_price,
                    "item_amount" => $item_amount,
                );
                $create_orderItem = DB::table('orderitems')->insert($newOrderItem);

            }
            Session::forget('cart');
            $payment_info = $newOrder;
            $payment_info["order_id"] = $order_id;
            session()->put('payment_info',$payment_info);
            return \redirect('/product/showPayment');
        }else{
            return redirect('/');
        }

    }
    function showPayment(){
        $payment_info = Session::get('payment_info');
        // dd($payment_info);
        if($payment_info['status']=="Not paid"){
            return view("payment.paymentPage",compact('payment_info'));
        }else{
            return \redirect('/');
        }
    }
}
