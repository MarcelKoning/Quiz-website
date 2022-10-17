<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quiz;

class HomeController extends Controller
{
    public function index(Request $request)
    {
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
