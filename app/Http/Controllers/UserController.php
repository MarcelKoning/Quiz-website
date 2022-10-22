<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->input('search')))
        {
            $users = User::searchquiz($request->input('search'))->get();
        }
        else {
            $users = User::all();
        }

        return view('admin.user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->uncompromised()],
        ]);

        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('admin/user');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|max:255|unique:users,email,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required',
        ]);

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role');
        $user->save();


        return redirect('admin/user');
    }

    public function delete()
    {

    }
}
