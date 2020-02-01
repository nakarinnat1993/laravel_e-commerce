<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate('3');
        return view('admin.ProductDashboard',compact('products'));
    }
    public function create()
    {
        $categories = Category::All();
        return view('admin.ProductForm', compact('categories'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            'category_id' => 'required',
            'price' => 'required|numeric',
        ]);
        $request->flash();
        // Convert image name
        $stringImage = base64_encode("_".time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImage.".".$ext;
        $imageEncode=File::get($request->image);

        Storage::disk('local')->put('public/product_image/'.$imageName, $imageEncode);


        Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$imageName,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
        ]);

        Session()->flash('success', 'Save success');
        return redirect('/admin/createProduct');



    }
}
