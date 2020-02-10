<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        $categories = Category::all()->sortBy('name');
        return view('product.welcome', compact('products', 'categories'));
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
    public function showCart()
    {
        $cart = Session::get('cart');
        if ($cart) {
            return view('product.showCart', ['cartItems' => $cart]);
        } else {
            return redirect('/');
        }
    }
    public function deleteItemCart($id)
    {
        $cart = Session::get('cart');
        if(array_key_exists($id,$cart->items)){
            unset($cart->items[$id]);
        }
        return redirect()->route('showCart');
    }
}
