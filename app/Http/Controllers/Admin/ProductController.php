<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("verifyCategory")->only(['create']);
    }
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate('3');
        return view('admin.ProductDashboard', compact('products'));
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
        $stringImage = base64_encode("_" . time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImage . "." . $ext;
        $imageEncode = File::get($request->image);

        Storage::disk('local')->put('public/product_image/' . $imageName, $imageEncode);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'user_id' => auth()->user()->id,
        ]);

        Session()->flash('success', 'Save success');
        return redirect('/admin/ProductDashboard');

    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::All();
        return view('admin.ProductForm', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:5000',
            'category_id' => 'required',
            'price' => 'required|numeric',
        ]);
        $request->flash();

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->save();

        if ($request->hasFile('image')) { //Attach File ?
            $exists = Storage::disk('local')->exists("public/product_image/" . $product->image); //ค้นหาไฟล์ภาพ
            if ($exists) {
                Storage::delete("public/product_image/" . $product->image);
            }
            $request->image->storeAs("public/product_image/", $product->image);
        }

        return redirect('/admin/ProductDashboard');
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $exists = Storage::disk('local')->exists("public/product_image/" . $product->image); //ค้นหาไฟล์ภาพ
        if ($exists) {
            Storage::delete("public/product_image/" . $product->image);
        }

        Product::destroy($id);
        return redirect('/admin/ProductDashboard');
    }
}
