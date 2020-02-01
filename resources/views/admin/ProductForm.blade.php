@extends('layouts.admin')
@section('body')
<div class="table-responsive">
    <h2>Create New Product</h2>
    <form action="/admin/createProduct" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id">
                <option value="">Select</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" required>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
