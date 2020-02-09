<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

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
        return view('product.showPorductDetail',compact('product','categories'));
    }
}
