<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('user.index', compact('user'));
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function create()
    {

        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->uncompromised()],
        ]);

        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role_id = 2;
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::loginUsingId($user->id);

        return redirect('home');
    }


    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
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
        $user->save();


        return redirect('user.index');
    }

    public function delete()
    {

    }
}
