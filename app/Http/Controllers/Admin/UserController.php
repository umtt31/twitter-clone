<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    //
    public function index()
    {
        Gate::authorize('admin');
        // dd(auth()->user()->is_admin);
        $users = User::latest()->paginate(5);
        return view('admin.users.index', compact('users'));
    }
}
