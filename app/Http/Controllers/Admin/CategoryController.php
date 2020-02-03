<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(3);
        return view('admin.CategoryForm', compact('categories'));
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        Category::create([
            'name' => $request->name,
        ]);

        Session()->flash('success', 'Save success');
        return redirect('/admin/createCategory');

    }
    public function edit($id)
    {
        $categories = Category::All();
        $category = Category::find($id);
        return view('admin.CategoryForm', compact('categories', 'category'));
    }
    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        Session()->flash('success', 'Update success');
        return redirect('/admin/createCategory');
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if($category->products->count()>0){
            session()->flash('error','Can not delete because product was created');
            return redirect()->back();
        }

        Category::destroy($id);

        Session()->flash('success', 'Delete success');
        return redirect('/admin/createCategory');

    }
}
