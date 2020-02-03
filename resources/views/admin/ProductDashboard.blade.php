@extends('layouts.admin')
@section('body')
<h2 class="my-3">Product</h2>
<div class='table-responsive '>
    <table class="table table-striped table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td><img src="{{asset('storage')}}/product_image/{{$product->image}}" alt="" srcset="" width="80px"></td>
            <td>{{$product->name}}</td>
            <td>{{$product->category->name}}</td>
            <td>{{Str::limit($product->description,20)}}</td>
            <td>{{number_format($product->price,2)}}</td>
            <td>
                <a href="/admin/editProduct/{{$product->id}}" class="btn btn-warning">Edit</a>
            </td>
            <td>
                <a href="/admin/deleteProduct/{{$product->id}}" class="btn btn-danger"
                    onclick="return confirm('Are you sure ?')">Delete</a>
            </td>
        </tr>

        @endforeach
    </table>
    {{$products->links()}}
</div>
@endsection
