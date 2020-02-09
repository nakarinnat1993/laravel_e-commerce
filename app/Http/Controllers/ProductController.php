<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Cart;

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
    public function addToCart(Request $request,$id)
    {
        $product = Product::find($id);
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $cart->addItem($id,$product);

    }
}
