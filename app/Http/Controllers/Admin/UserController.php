<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate('3');
        return view('admin.showUser', compact('users'));
    }
}
