@extends('layouts.admin')
@section('body')
<div class="table-responsive">
    <h2>{{isset($product)?'Edit Product':'Create New Product'}}</h2>
    <form action="{{isset($product)?'/admin/updateProduct/'.$product->id:'/admin/createProduct'}}" method="post"
        enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name"
                value="{{isset($product)?$product->name:old('name')}}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description"
                value="{{isset($product)?$product->description:old('description')}}">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id">
                <option value="">Select</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}"
                    @if (isset($product))
                        @if ($product->category_id==$category->id)
                            selected
                        @endif
                    @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price"
                value="{{isset($product)?$product->price:old('price')}}">
        </div>
        <button type="submit" name="submit" class="btn btn-success">{{isset($product)?'Update':'Add'}}</button>
    </form>
</div>
@endsection
