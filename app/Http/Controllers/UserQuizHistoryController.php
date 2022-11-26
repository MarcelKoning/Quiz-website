<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizType;
use App\Models\Room;
use App\Models\UserRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuizHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!empty($request->input('search')) && !empty($request->input('category'))) {
            $search = $request->input('search');
            $category = $request->input('category');
            $userRooms = UserRoom::with('room.quiz', 'answers')->where('user_id', $user->id)
                ->whereHas('room.quiz.category', function ($q) use ($category) {
                    $q->where('id', $category);
                })->whereHas('room.quiz', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(15);
            $userRooms->appends(['category_id' => $category, 'search' => $search]);
        } elseif (!empty($request->input('search'))) {
            $search = $request->input('search');
            $userRooms = UserRoom::with('room.quiz', 'answers')->where('user_id', $user->id)
                ->whereHas('room.quiz', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->paginate(15);
            $userRooms->appends(['search' => $search]);
        } elseif (!empty($request->input('category'))) {
            $category = $request->input('category');
            $userRooms = UserRoom::with('room.quiz', 'answers')->where('user_id', $user->id)
                ->whereHas('room.quiz.category', function ($query) use ($category) {
                    $query->where('category_id', 'like', '%' . $category . '%');
                })
                ->paginate(15);
            $userRooms->appends(['search' => $category]);
        } else {
            $userRooms = UserRoom::with('room.quiz', 'answers')->where('user_id', $user->id)->paginate(15);
        }

        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();

        return view('user.history.index', compact('user', 'userRooms', 'quizTypes', 'quizCategories'));
    }

    public function show(UserRoom $userRoom)
    {
        $user = Auth::user();

        $userRooms = UserRoom::with('room.quiz', 'answers')->whereHas('room.quiz.category')->where('id', $userRoom->id)->where('user_id', $user->id)->get();

        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();

        return view('user.history.show', compact('user', 'userRooms', 'quizTypes', 'quizCategories'));
    }
}
