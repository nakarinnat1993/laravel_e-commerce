@extends('layouts.admin')
@section('body')
<div class="table-responsive">
    <h2>{{isset($category)?'Edit Category':'Create New Category'}}</h2>
    <form action="{{isset($category)?'/admin/updateCategory/'.$category->id:'/admin/createCategory'}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name"
                value="{{isset($category)?$category->name:''}}">
        </div>

        <button type="submit" name="submit" class="btn btn-success">{{isset($category)?'Update':'Add'}}</button>
    </form>
</div>
<div class='table-responsive my-5'>
    <table class="table table-striped table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Count Product</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->products->count()}}</td>
            <td>
                <a href="/admin/editCategory/{{$category->id}}" class="btn btn-warning">Edit</a>
            </td>
            <td>
                <a href="/admin/deleteCategory/{{$category->id}}" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete</a>
            </td>
        </tr>

        @endforeach
    </table>
    {{$categories->links()}}
</div>
@endsection
