@extends('layouts.admin')
@section('body')
<h2 class="my-3">User</h2>
<div class='table-responsive '>
    <table class="table table-striped table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        </tr>

        @endforeach
    </table>
    {{$users->links()}}
</div>
@endsection
