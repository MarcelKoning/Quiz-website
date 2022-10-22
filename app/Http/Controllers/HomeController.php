<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Remove this when the login system works
        // Uncomment if you have a user in db;
//        $user = User::where('id', 1)->first();
//        Auth::login($user);

       if(!empty($request->input('search')))
       {
           $quizzes = Quiz::searchquiz($request->input('search'))->get();
       }
       else {
           $quizzes = Quiz::all();
       }

        return view('home', compact('quizzes'));
    }
}
